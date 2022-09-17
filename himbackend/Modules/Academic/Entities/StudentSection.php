<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Academic\Entities\StudentRegisterCourse;
// use Modules\Academic\Entities\StudentSection;

class StudentSection extends Model
{
    // table of student_groups
    protected $table = "student_sections";
    
    protected $fillable = [
  	 	 'name',
  	 	 'group_id',
  	 	 'course_id',
  	 	 'division_id',
  	 	 'level_id',
  	 	 'term_id',
  	 	 'year_id',
  	 	 'std_num',
  	 	 'created_at',
  	 	 'updated_at'
    ];
     protected $appends = [
        'register',
    ];
    
    public function getRegisterAttribute() {
          $num = StudentRegisterCourse::where('section_id',$this->id)->count();
        return $num ? $num : 0;
    }
    
    public function division() {
        return $this->belongsTo("Modules\Divisions\Entities\Division", "division_id");
    }
    public function term() {
        return $this->belongsTo("Modules\Settings\Entities\Term", "term_id");
    }
     public function group() {
        return $this->belongsTo("Modules\Academic\Entities\StudentGroup", "group_id");
    }
    
    public function course() {
        return $this->belongsTo("Modules\Academic\Entities\Course", "course_id");
    }

    public function level() {
        return $this->belongsTo("Modules\Divisions\Entities\Level", "level_id");
    }
      
}