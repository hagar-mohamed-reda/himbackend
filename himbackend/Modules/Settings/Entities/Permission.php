<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'group_id'];
}
