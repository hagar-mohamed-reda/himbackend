<?php

namespace Modules\Academic\Entities;
use Modules\Account\Entities\AccountSetting;
use Modules\Account\Entities\StudentOldBalance;
use Modules\Account\Entities\Installment;
use Modules\Settings\Entities\Level;

class StudentResultTransfer extends Student
{
    
    public $failedTransferReason = "";
    
    public function checkIfCanTransferToAnotherLevel() {
        $valid = true; 
        
        if (in_array($this->case_constraint_id, [2,3])) {
            $valid = $this->transferUpToLevel();
        }
        
        return $valid;
    }
    
    
    public function transferUpToLevel() {
        $lastLevel = Level::max('id');
        $term = AccountSetting::getCurrentTerm();
        $registerCourses = $this->getActualRegisterCourses()->count();
        $registerHours = $this->getActualRegisterCourses()->sum('credit_hour');
        
        $valid = true;
        if ($this->level_id < $lastLevel && $this->case_constraint_id != 1) {
            $nextLevel = $this->level_id + 1;
            $level = Level::find($nextLevel);
            
            if (($registerCourses < $level->required_course) || ($registerHours < $level->required_hour)) {
                $valid = false;
                $this->failedTransferReason = "شروط الطالب غير مطابقة للمستوى {".$level->name."} مطلوب {".$level->required_course."} مقرر و {".$level->required_hour."} ساعة";
            }
            
            // if ($nextLevel == $lastLevel && $this->getStudentBalance()->getCurrentBalanceTotal() > 0) {
            //     $valid = false;
            //     $this->failedTransferReason .= ", الطالب لم يقوم بدفع المصاريف الدراسية للتخرج";
            // }
            
            /* for term 2  */
             if ($this->getStudentBalance()->getCurrentBalanceTotal() > 0) {
                 $installments = Installment::where('student_id',$this->id)
                                                ->where('paid',0)->delete();
                 $studentOldBalance = StudentOldBalance::create([
                        'student_id' => $this->id,
                        'value' => $this->getStudentBalance()->getCurrentBalanceTotal(),
                        'notes' => 'رسوم سابقة',
                     ]);
            }
           
            
            /* if term is summer. */
            
            // if ($term->id == 2 && $valid == false) {
            //     $this->update([
            //         "case_constraint_id" => 3
            //     ]);
            // } 
            
            if ($valid == true) {
                $this->update([
                    "level_id" => $nextLevel
                ]);
            }
        }else{}
        
        return $valid;
    }
}
