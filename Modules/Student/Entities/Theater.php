<?php

namespace Modules\Student\Entities;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;

class Theater extends Model {

    /**
     * folder name of the application
     *
     * @var String
     */

    /**
     * table name of the db;
     *
     * @var type string
     */
    protected $table = 'theaters';
    protected $fillable=['name'];

    /**
     * folder name of the application
     *
     * @var String
     */
   



}
