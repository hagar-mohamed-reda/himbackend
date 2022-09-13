<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\AccountSetting;
use Illuminate\Http\Request;

class StudentRegisterCourse extends Model {

    // table of bank
    protected $table = "academic_student_register_courses";
     protected $fillable = [
        'course_id',
        'gpa',
        'gpa_word',
        'term_id',
        'academic_year_id',
        'student_id',
        'level_id',
        'division_id',
        'degree_map_id',
        'user_id',
        'group_id',
        'section_id',
        'student_degree',
        'success'
    ];

    public function course() {
        return $this->belongsTo("Modules\Academic\Entities\Course", "course_id");
    }
    public function group() {
        return $this->belongsTo("Modules\Academic\Entities\StudentGroup", "group_id");
    }
    public function sectionOne() {
        return $this->belongsTo("Modules\Academic\Entities\StudentSection", "section_id");
    }
    public function section() {
        return $this->hasMany("Modules\Academic\Entities\StudentSection", "course_id");
    }

    public function academicYear() {
        return $this->belongsTo("Modules\Divisions\Entities\AcademicYear", "academic_year_id");
    }

    public function student() {
        return $this->belongsTo("Modules\Account\Entities\Student", "student_id");
    }

    public function division() {
        return $this->belongsTo("Modules\Divisions\Entities\Division", "division_id");
    }

    public function level() {
        return $this->belongsTo("Modules\Divisions\Entities\Level", "level_id");
    }

    public function term() {
        return $this->belongsTo("App\Term", "term_id");
    }

    public function user() {
        return $this->belongsTo("App\User", "user_id");
    }

    public function studentResult() {
        return StudentResult::query()
            ->where('student_id', $this->student_id)
            ->where('academic_year_id', $this->academic_year_id)
            ->where('term_id', $this->term_id)
            ->where('course_id', $this->course_id)
            ->where('level_id', $this->level_id)
            ->first();
    }

    public function getGP() {
        return $this->gpa;//optional($this->course)->credit_hour * optional($this->course)->gpa;;
    }

    public static function updateRegisterCourses(Request $request) {
        $student = Student::find($request->student_id);
        $courses = $request->courses;
        $year = AccountSetting::getCurrentAcademicYear();
        $term = AccountSetting::getCurrentTerm();
        
        try {
            // delete old
            StudentRegisterCourse::query()
                    ->where('student_id', $student->id)
                    ->where('academic_year_id', $year->id)
                    ->where('term_id', $term->id)
                    ->delete();

            // add new
            foreach($courses as $course) {
                
                StudentRegisterCourse::create([
                    "student_id" => $student->id,
                    "academic_year_id" => $year->id,
                    "term_id" => $term->id,
                    "level_id" => $student->level_id,
                    "division_id" => $student->division_id,
                    "course_id" => $course['id'],
                    "user_id" => $request->user->id,
                    "group_id" => $course['group_id'],
                    "section_id" => $course['section_id'],
                ]);
            }

            // add student to group
            // $group = StudentGroup::where('student_id', $student->id)
            //         ->first();
            // if (!$group) {
            //     StudentGroup::addStudentToGroup($student);
            // }

            return responseJson(1, __('done'));
        } catch (\Exception $exc) {
            return responseJson(0, $exc->getMessage());
        }
    }


}
