<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceTemplate extends Model {

    // table of bank
    protected $table = "service_templates";
    protected $fillable = [
        'name', 'path'
    ];

}
