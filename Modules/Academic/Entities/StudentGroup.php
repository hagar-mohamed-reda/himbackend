<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    // table of student_groups
    protected $table = "student_groups";
    
    protected $fillable = [
  	 	 'name','level_id','year_id', 'term_id', 'division_id', 'created_at','updated_at'
    ];
    
    public function level() {
        return $this->belongsTo("Modules\Divisions\Entities\Level", "level_id");
    }
    public function year() {
        return $this->belongsTo("Modules\Settings\Entities\AcademicYear", "year_id");
    }
    public function term() {
        return $this->belongsTo("Modules\Settings\Entities\Term", "term_id");
    }
    
    public function division() {
        return $this->belongsTo("Modules\Divisions\Entities\Division", "division_id");
    }
      
     
}
