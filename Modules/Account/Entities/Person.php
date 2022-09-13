<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // table of bank
    protected $table = "account_persons";
    
    protected $fillable = [
        'name',
        'phone',
        'address',
        'notes',
        'created_at',
        'updated_at'
    ];
    
    protected $appends = ['can_delete'];
    
    public function getCanDeleteAttribute() {
        return true;
    }
     
    public function checks() {
        return $this->hasMany("Modules\Account\Entities\Check", "person_id");
    }

    
    public function canDelete() {
        return !($this->checks()->count() > 0)? true : false;
    }
    
}
