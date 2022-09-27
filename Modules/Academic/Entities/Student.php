<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Student as StudentOrigin;
use Modules\Account\Entities\AccountSetting;
use Modules\Divisions\Entities\Level;
use App\Term;
use Modules\Settings\Entities\AcademicYear;
use Modules\Academic\Entities\StudentGpa;

use DB;

class Student extends StudentOrigin
{

    protected $appends = [
        'register_hours',
        'actual_register_hours',
        'gpa',
        'gpa_word',
        'image',
        'current_register_courses',
        'academic_document',
        'warning',
        'max_set_number'
    ];

    public function getMaxSetNumberAttribute()
    {
        $max_number = DB::table('students')->where('division_id', $this->division_id)->max('set_number');
        return $max_number;
    }

    public function getGpaAttribute()
    {
        $CGPA = $this->getCGPA();
        $numberParts = explode('.', $CGPA);
        $CGPA = $numberParts[0];
        if (count($numberParts) > 1 && 2 > 0) {
            $CGPA .= '.';
            $CGPA .= substr($numberParts[1], 0, 2);
        }
        return $CGPA ? $CGPA : 0;
    }
    public function getGpaWordAttribute()
    {
        $gpa = $this->getCGPA();
        $degreeMap = "";
        if ($gpa >= 4)
            $degreeMap = "A+";
        if ($gpa < 4 && $gpa >= 3.7)
            $degreeMap = "A";
        if ($gpa < 3.7 && $gpa >= 3.4)
            $degreeMap = "B+";
        if ($gpa < 3.4 && $gpa >= 3)
            $degreeMap = "B";
        if ($gpa < 3 && $gpa >= 2.7)
            $degreeMap = "C+";
        if ($gpa < 2.7 && $gpa >= 2.3)
            $degreeMap = "C";
        if ($gpa < 2.3 && $gpa >= 2)
            $degreeMap = "C-";
        if ($gpa < 2 && $gpa >= 1.7)
            $degreeMap = "D+";
        if ($gpa < 1.7 && $gpa >= 1.3)
            $degreeMap = "D";
        if ($gpa < 1.3 && $gpa >= 1)
            $degreeMap = "D-";

        return $degreeMap ? $degreeMap : "";
    }

    public function getWarningAttribute()
    {
        $requiredGpa = optional(AcademicSetting::find(2))->value;
        $times = StudentGpa::where('student_id', $this->id)->where('gpa', '<', $requiredGpa)->count();

        $warning = "الطالب حصل على معدل تراكمى اقل من " . $requiredGpa . " لعدد " . $times . " مرات ";

        return $times > 0 ? $warning : null;
    }


    public function getRepeatCourses()
    {
        $ids = StudentRegisterCourse::query()
            ->select('course_id', DB::raw('count(course_id) as count'))
            ->where('student_id', $this->id)
            ->groupBy('course_id')
            ->having('count', '>', 1)
            ->pluck('course_id')
            ->toArray();
        return Course::whereIn('id', $ids);
    }

    public function getAcademicDocumentAttribute()
    {
        $levelIds = $this->registerCourses()->pluck('level_id')->toArray();
        $levels = Level::whereIn('id', $levelIds)->get();

        foreach ($levels as $level) {
            $termIds = $this->registerCourses()->where('level_id', $level->id)->pluck('term_id')->toArray();
            $academic_year_id = $this->registerCourses()->where('level_id', $level->id)->first()->academic_year_id;
            $academic_year = AcademicYear::find($academic_year_id);
            $terms = Term::whereIn('id', $termIds)->get();
            foreach ($terms as $term) {
                // dd($term->id);
                $term->academic_year = $academic_year->name;
                $gpa_fasly = StudentGpa::where('student_id', $this->id)->where('academic_year_id', $academic_year->id)->where('term_id', $term->id)->first();

                try {
                    $numberParts = explode('.', $gpa_fasly->gpa ?? '0');
                    $gpa_fasly = $numberParts[0];
                    if (count($numberParts) > 1 && 2 > 0) {
                        $gpa_fasly .= '.';
                        $gpa_fasly .= substr($numberParts[1], 0, 2);
                    }
                } catch (ModelNotFoundException $exception) {
                }


                $term->gpa_fasly = $gpa_fasly ?? '';

                $courseids = $this->registerCourses()->where('level_id', $level->id)
                    ->where('term_id', $term->id)->pluck('course_id')->toArray();
                $term->courses = $this->registerCourses()
                    ->with(['division'])
                    ->join('academic_courses', 'academic_courses.id', '=', 'course_id')
                    ->where('academic_student_register_courses.level_id', $level->id)
                    ->where('term_id', $term->id)
                    ->select('*', 'academic_student_register_courses.id as id', 'academic_student_register_courses.created_at as created_at')
                    ->get();
                //Course::whereIn('id', $courseids)->get();
                //

            }
            $level->terms = $terms;
            // dd($level->terms);
        }



        return $levels;
    }

    public function getCurrentRegisterCourseQuery()
    {
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        //
        return StudentRegisterCourse::with('section')
            ->where('student_id', $this->id)
            ->where('academic_year_id', $year->id)
            ->where('term_id', $term->id)
            ->select(
                '*',
                'academic_courses.id as id',
                'academic_student_register_courses.created_at as register_date',
                DB::raw('(select name from student_groups where student_groups.id = academic_student_register_courses.group_id) as group_name'),
                DB::raw('(select name from student_sections where student_sections.id = academic_student_register_courses.section_id) as section_name'),
                DB::raw('(select name from theaters where student_schedule.theater_id = theaters.id) as theater_name'),
                DB::raw('(select name from theaters where student_schedule.section_theater_id = theaters.id) as section_theater_name'),
                DB::raw('(select day from academic_courses where academic_student_register_courses.course_id = academic_courses.id) as exam_day')
            )

            ->join('academic_courses', 'academic_courses.id', '=', 'course_id')
            ->leftjoin('student_schedule', 'student_schedule.section_id', '=', 'academic_student_register_courses.section_id')
            ->orderby('student_schedule.day');
    }

    public function getActualRegisterCourses() {
        $successGpa = optional(AcademicSetting::find(2))->value;
        return StudentRegisterCourse::with('section')
                        ->where('student_id', $this->id)
                        ->where('gpa', '>', $successGpa)
                        ->select('*', 'academic_courses.id as id', 'academic_student_register_courses.created_at as register_date')
                        ->join('academic_courses', 'academic_courses.id', '=', 'course_id');
    }

    public function getCurrentRegisterCoursesAttribute()
    {
        return $this->getCurrentRegisterCourseQuery()->get();
    }

    public function getRegisterHoursAttribute()
    {
        $successGpa = optional(AcademicSetting::find(2))->value;
        $ids = $this->registerCourses()->where('gpa', '>=', $successGpa)->pluck('course_id')->toArray();
        return Course::whereIn('id', $ids)->sum('credit_hour');
    }

    public function getActualRegisterHoursAttribute()
    {
        return StudentRegisterCourse::with('section')
            ->where('student_id', $this->id)
            ->select('*', 'academic_courses.id as id', 'academic_student_register_courses.created_at as register_date')
            ->join('academic_courses', 'academic_courses.id', '=', 'course_id')->sum('credit_hour');
    }

    public function registerCourses()
    {
        return $this->hasMany("Modules\Academic\Entities\StudentRegisterCourse", 'student_id');
    }

    public function courses()
    {
        return $this->hasManyThrough("Modules\Academic\Entities\Course", 'Modules\Academic\Entities\StudentRegisterCourse', 'student_id', 'id', 'id', 'course_id');
    }
    public function studentGpa()
    {
        return $this->hasOne("Modules\Academic\Entities\StudentGpa", 'student_id');
    }

    public function doctorGroup()
    {
        return DoctorLevel::where('level_id', $this->level_id)->first();
    }

    public function group()
    {
        return StudentGroup::where('student_id', $this->id)->latest()->first();
    }

    public function startCalculateGpa($term_id)
    {

        $year = AccountSetting::getCurrentAcademicYear();
        // $term = AccountSetting::getCurrentTerm();
        $term = Term::find($term_id);
        $gpaCalculator = new GpaCalculator($this, $year->id, $term->id);

        $studentGpa = StudentGpa::where('term_id', $term->id)->where('academic_year_id', $year->id)->where('student_id', $this->id)->first();

        if (!$studentGpa) {
            $studentGpa = StudentGpa::create([
                "term_id" => $term->id,
                "academic_year_id" => $year->id,
                "student_id" => $this->id,
                "gpa" => $gpaCalculator->getGPA()
            ]);
        } else {
            $studentGpa->update([
                "gpa" => $gpaCalculator->getGPA()
            ]);
        }
    }

    /**
     * calculate gpa of all acadmic year of the student and it's terms
     * and cache it in db
     */
    public function getAllGpa()
    {
        $academicYears = StudentRegisterCourse::query()
            ->where('student_id', $this->id)
            ->select('academic_year_id')
            ->distinct('academic_year_id')
            ->pluck('academic_year_id')
            ->toArray();


        foreach ($academicYears as $item) {
            $terms = StudentRegisterCourse::query()
                ->where('student_id', $this->id)
                ->where('academic_year_id', $item)
                ->select('term_id')
                ->distinct('term_id')
                ->pluck('term_id')
                ->toArray();

            foreach ($terms as $term) {
                $gpaCalculator = new GpaCalculator($this, $item, $term);
                $gpa = $gpaCalculator->getGPA();
                $this->storeGpa($this->id, $item, $term, $gpa);
            }
        }
    }

    public function storeGpa($studentId, $academicYearId, $termId, $gpa)
    {
        $row = StudentGpa::where('student_id', $studentId)
            ->where('academic_year_id', $academicYearId)
            ->where('term_id', $termId)
            ->first();

        if (!$row) {
            $row = StudentGpa::create([
                "student_id" => $studentId,
                "academic_year_id" => $academicYearId,
                "term_id" => $termId,
                "gpa" => $gpa
            ]);
        }
        return $row;
    }
    public function getCGPA()
    {
        $gpSum = 0;

        $student_courses = StudentRegisterCourse::query()
            ->join('academic_courses', 'academic_courses.id', '=', 'course_id')
            ->where('student_id', $this->id)
            ->where('gpa', '!=', null)
            ->select('*', 'academic_student_register_courses.id as id');

        $courses = $student_courses->get();
        $registerHours = $student_courses->sum('credit_hour');


        foreach ($courses as $course) {
            $gpSum += $course->getGP() * $course->credit_hour;
        }
        if ($registerHours > 0)
            $total = $gpSum / $registerHours;
        else
            $total = 0;

        //  if($this->id == 568)
        //     dd($total);

        return $total;
    }

    public function getGpa()
    {
        // $gpa = StudentGpa::query()
        //         ->where('student_id', $this->id)
        //         ->avg("gpa");
        $CGPA = $this->getCGPA();
        $numberParts = explode('.', $CGPA);
        $CGPA = $numberParts[0];
        if (count($numberParts) > 1 && 2 > 0) {
            $CGPA .= '.';
            $CGPA .= substr($numberParts[1], 0, 2);
        }
        return $CGPA ? $CGPA : 0;
    }

    public function getGpaByYearAndTerm($year_id, $term_id)
    {

        $gpa = 0;
        if (!$term_id) {
            $gpa = $this->getYearCGPA($year_id);
        } else {
            $gpaCalculator = new GpaCalculator($this, $year_id, $term_id);
            $gpa = $gpaCalculator->getGPA();
        }

        return $gpa;
    }

    public function getYearCGPA($year_id)
    {
        $gpSum = 0;

        $student_courses = StudentRegisterCourse::query()
            ->join('academic_courses', 'academic_courses.id', '=', 'course_id')
            ->where('student_id', $this->id)
            ->where('academic_year_id', $year_id)
            ->select('*', 'academic_student_register_courses.id as id');

        $courses = $student_courses->get();
        $registerHours = $student_courses->sum('credit_hour');


        foreach ($courses as $course) {
            $gpSum += $course->getGP() * $course->credit_hour;
        }
        if ($registerHours > 0)
            $total = $gpSum / $registerHours;
        else
            $total = 0;

        //  if($this->id == 568)
        //     dd($total);

        return $total;
    }
}
