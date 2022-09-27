<?php

namespace Modules\Academic\Entities;

use Modules\Account\Entities\Student;
use Modules\Account\Entities\Payment;
use Modules\Account\Entities\AccountSetting;

class StudentAvailableCourse {

    /**
     * student object
     * @var type Student
     */
    private $student = null;

    /**
     * query of course
     * @var type
     */
    private $query = null;

    /**
     * academic settings
     * @var type Array
     */
    private $settings = null;

    /**
     * courses
     * @var Array
     */
    private $courses = [];

    /**
     * current academic year
     * @var Array
     */
    private $year = [];

    public function __construct(Student $student) {
        $this->student = $student;
        $this->course = Course::with(['prequsitesCourse']);
        $this->settings = AcademicSetting::query();
		$this->year = AccountSetting::getCurrentAcademicYear();
        $this->courses = Course::with('section')->get();
    }

    public function levelFilter() {
        if (optional($this->settings->find(6))->value != 1) {
            $newCourses = [];
            foreach ($this->courses as $course) {
                if ($course->level_id == $this->student->level_id && $course->division_id == $this->student->division_id)
                    $newCourses[] = $course;
            }
            $this->courses = $newCourses;
        }
    }

    public function prequsitesFilter() {
        if (optional(AcademicSetting::find(7))->value != 1) {
            $newCourses = [];
            foreach ($this->courses as $course) {
                if ($course->prequsitesCourse()->count() > 0) {
                    $valid = true;
                    foreach ($course->prequsites()->get() as $item) {
                        if (!$item->isRegistered($this->student->id)) {
                            $valid = false;
                        }
                      
                    }
                    //
                    if ($valid) {
                        $newCourses[] = $course;
                    }
                } else {
                    $newCourses[] = $course;
                }
            }
            $this->courses = $newCourses;
        }
    }

    public function openCourseFilter() {
        $newCourses = [];
        foreach ($this->courses as $course) {
             if ($course->isOpen() || $course->is_not_credit_hour) {
                 $newCourses[] = $course;
             }
        }
        $this->courses = $newCourses;
    }
    
    public function passedCourseFilter() {
        $newCourses = [];
        foreach ($this->courses as $course) {
             if (!$course->isRegistered($this->student->id))
                   $newCourses[] = $course;
        }
        $this->courses = $newCourses;
    }

	public function filterPaidService() {
        $newCourses = [];
		foreach($this->courses as $course) {
			// check if paid
			if ($course->service_id > 0) {
				$paid = Payment::where('model_type', 'service')
				->where('student_id', $this->student->id)
				->where('model_id', $course->service_id)
				->where('academic_year_id', $this->year->id)
				->exists();
				if ($paid) {
					$newCourses[] = $course;
				}
			} else {
				$newCourses[] = $course;
			}
		}
        $this->courses = $newCourses;
	}

    public function checkIfPayHisInstallment()
    {
        $sumVal =0;
        // find Account Payment of student //
        $student = Student::find($this->student->id);
        $accounts = Payment::where('student_id',$student->id)
        ->where('model_type','1')
        ->where('academic_year_id',$this->year->id)->get();
        foreach($accounts as $account )
        {
            $sumVal+=$account->value;
        }

        // find value of specfic level 
        $accadmicAdvising =  AcademicAdvisingPaymentDetails::where('acadimic_year_id',$this->year->id)->where('level_id',$student->level_id)->first();
        if($sumVal >= $accadmicAdvising->value)
        {
            return false;
        }
        else{
            return true;
        }
    }
    public function getCourses() {
        // $this->checkIfPayHisInstallment();
        if($this->checkIfPayHisInstallment() == false)
        {
            return response()->json( [
                'status' => 0,
                'msg' => 'لم يتم سداد المصاريف كامله',
            ],403);
            
        }
        else{
            $this->levelFilter();
            $this->openCourseFilter();
            $this->prequsitesFilter();
		    $this->filterPaidService();
		    $this->passedCourseFilter();
            return $this->courses;
        }
        
    }

}
