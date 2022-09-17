<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class RegisterationStatusDocument extends Model
{
    protected $table = 'registeration_status_document';
    protected $fillable = ['registeration_status_id', 'required_document_id'];

}
