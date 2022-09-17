<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class CommissionType extends Model
{
    protected $table = 'commission_types';
    protected $fillable = ['name','notes'];
}
