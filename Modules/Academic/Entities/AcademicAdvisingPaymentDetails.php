<?php

namespace Modules\Academic\Entities;

use App\Term;
use Illuminate\Database\Eloquent\Model;
use Modules\Divisions\Entities\Level as EntitiesLevel;
use Modules\Settings\Entities\AcademicYear;
use Modules\Settings\Entities\CaseConstraint;
use Modules\Settings\Entities\Level;

class AcademicAdvisingPaymentDetails extends Model {
    protected $table = 'acadmic_advising_payment_detiails';
    protected $fillable = [
        'acadimic_year_id',
        'term_id',
        'value',
        'level_id',
        'case_constrain_id',
        'created_at',
        'updated_at'
    ];

    public function level() {
        return $this->belongsTo(EntitiesLevel::class, "level_id");
    }
    public function term()
    {
        return $this->belongsTo(Term::class,'term_id');
    }
    public function academicYear() {
        return $this->belongsTo(AcademicYear::class, "acadimic_year_id");
    }

    public function caseConstrain()
    {
        return $this->belongsTo(CaseConstraint::class,'case_constrain_id');
    }
}
