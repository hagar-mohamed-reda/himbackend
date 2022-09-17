<?php

namespace Modules\Student\Entities;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;

class Commission extends Model {

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
    protected $table = 'commissions';
    protected $fillable=['level_id','division_id','theater_id','commission_index','name','max_num','start_num','distribution','commission_type_id'];

    /**
     * folder name of the application
     *
     * @var String
     */
     
     
       public function commission_type() {
            return $this->belongsTo('Modules\Settings\Entities\CommissionType', 'commission_type_id');
        }
        
        public function theater() {
            return $this->belongsTo('Modules\Student\Entities\Theater', 'theater_id');
        }
        
         public function level() {
            return $this->belongsTo('Modules\Divisions\Entities\Level', 'level_id');
        }
         public function division() {
            return $this->belongsTo('Modules\Divisions\Entities\Division', 'division_id');
        }
   



}
