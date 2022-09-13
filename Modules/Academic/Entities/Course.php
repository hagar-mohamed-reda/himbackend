<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // table of bank
    protected $table = "academic_courses";
    
    protected $fillable = [
        'name',    
        'code',       
        'term',       
        'year_work_degree',    
        'practical_degree',    
        'academic_degree', 
        'small_degree',    
        'large_degree',    
        'has_project', 
        'division_id', 
        'credit_hour', 
        'notes',
        'subject_category_id', 
        'is_required', 
        'book_price',  
        'level_id',
        'service_id',
        'is_not_credit_hour',
        'failed_degree'
    ];

    protected $appends = [
        'can_delete', 'prerequsites', 'prerequsites_names', 'prerequsite_length', 'times'
    ];
 
    public function getTimesAttribute() {
        return StudentRegisterCourse::where('student_id', request()->student_id)->where('course_id', $this->id)->count();
    }

    public function getPrerequsiteLengthAttribute() {
        return $this->prequsitesCourse()->count();
    }
	
    public function getPrerequsitesAttribute() {
        return implode(", ", $this->prequsitesCourse()->pluck('related_course_id')->toArray());
    }

    public function getPrerequsitesNamesAttribute() {
        return implode(", ", $this->prequsites()->pluck('name')->toArray());
    }

    public function getCanDeleteAttribute(){
        $valid = true;
        if ($this->registerStudents()->count() > 0)
            $valid = false;
        
        return $valid;
    }

     
    public function service() {
        return $this->belongsTo("Modules\Account\Entities\Service", "service_id");
    }
   
    public function category() {
        return $this->belongsTo("Modules\Academic\Entities\CourseCategory", "subject_category_id");
    }

    public function division() {
        return $this->belongsTo("Modules\Divisions\Entities\Division", "division_id");
    }
    
    public function group() {
        return $this->belongsTo("Modules\Academic\Entities\StudentGroup", "group_id");
    }
    
    public function section() {
        return $this->hasMany("Modules\Academic\Entities\StudentSection", "course_id");
    }
    

    public function level() {
        return $this->belongsTo("Modules\Divisions\Entities\Level", "level_id");
    }

    public function registerStudents() {
        return $this->hasMany("Modules\Academic\Entities\StudentRegisterCourse", "course_id");
    }

    public function prequsites() {
        $ids = $this->prequsitesCourse()->pluck('related_course_id')->toArray();

        return Course::whereIn('id', $ids); 
    } 

    public function prequsitesCourse() {
        return $this->hasMany("Modules\Academic\Entities\CoursePrerequsite", "course_id");
    }
    
    public function isRegistered($student_id) {
		$requiredGpa = optional(AcademicSetting::find(2))->value;
        return StudentRegisterCourse::where('course_id', $this->id)->where('gpa', '>=', $requiredGpa)
		->where('student_id', $student_id)->exists()? true : false;
    }
  
    
    public function isOpen() {
        return OpenCourse::currentOpenCourses()->where('course_id', $this->id)->exists()? true : false;
    }
     
}
