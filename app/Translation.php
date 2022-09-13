<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translations';
    protected $fillable = ['key', 'name_ar', 'name_en'];

    protected $appends = [
    	'value'
    ];

    public function getValueAttribute() {
    	return [
    		"id" => $this->id,
    		"name_ar" => $this->name_ar,
    		"name_en" => $this->name_en,
    	];
    }

    public function getKeyAttribute() {
        return str_replace(' ', '_', $this->attributes['key']);
    }

}
