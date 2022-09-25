<?php

namespace Modules\Card\Entities;

use Illuminate\Database\Eloquent\Model;

class CardExportsSettings extends Model
{
    protected $table = 'card_exports_settings';
    protected $fillable = ['case_constraint_id', 'academic_year_id', 'level_id', 'term_id', 'value'];

    public function getSettings($year_id , $term_id)
    {
        return $this->where('academic_year_id', $year_id)
                ->where('term_id', $term_id)
                ->get();
    }



    public function storeSettings($settings)
    {
        foreach ($settings as $row) {
            $settings_row = $this->where('academic_year_id', $row['academic_year_id'])
                ->where('term_id', $row['term_id'])
                ->where('level_id', $row['level_id'])
                ->where('case_constraint_id', $row['case_constraint_id'])->first();


            if ($settings_row) {
                // update the value
                $settings_row->update(['value' => $row['value']]);
            } else {
                // inserting a new value
                CardExportsSettings::create($row);
            }
        }
    }
}
