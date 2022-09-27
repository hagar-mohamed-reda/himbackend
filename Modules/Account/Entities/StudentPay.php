<?php

namespace Modules\Account\Entities;
use Illuminate\Http\Request;
use DB;
use Modules\Account\Entities\Discount;

class StudentPay
{
    /**
     * detect the payment type if
     * ['academic_year_expense','service','installment','old_academic_year_expense']
     */

    

    public static function getPayType(Student $student, Request $request) {
        if ($request->payment_type == 'service')
            return "service";
        if ($student->is_old_installed)
            return "installment";
        if ($student->old_balance > 0)
            return "old_academic_year_expense";
        if ($student->is_current_installed)
            return "installment";
        if ($student->current_balance > 0)
            return "academic_year_expense";
    }

    /**
     * pay value
     */
    public static function pay(Request $request, $installment=null, $payments=[]) {
                // dd($request);
                
        $wzServiceMax = Payment::where('service_type', '!=', 'in')
        ->orWhere('service_type', null)->max('serial');
        $inServiceMax = Payment::where('service_type','in')->max('serial');

        $student = Student::find($request->student_id);
        $details = $student->getStudentBalance()->getCurrrentAcademicYearExpenseDetail();
       
        //$payments = [];
        $type = self::getPayType($student, $request);
         
        if ($type == "academic_year_expense") {

            foreach($details as $detail) {
                
                $discountModelForStudent = Discount::where('student_id',$student->id)->where('model_id',$detail->id)->sum('value');
                $discountForModel =  $detail->discount;


                $payment = Payment::addPayment([
                    "serial" => $wzServiceMax + 1,
                    "date" => date('Y-m-d'),
                    "value" => $detail->value - $discountForModel -  $discountModelForStudent,
                    "model_type" => "academic_year_expense",
                    "model_id" => $detail->id,
                    "user_id" => $request->user->id,
                    "store_id" => $detail->store_id,
                    "student_id" => $student->id
                ]);

                $data = [
                    "serial" => $wzServiceMax + 1,
                    "date" => date('Y-m-d'),
                    "value" => $detail->value,
                    "model_type" => "academic_year_expense",
                    "model_id" => $detail->id,
                    "user_id" => $request->user->id,
                    "store_id" => $detail->store_id,
                    "student_id" => $student->id
                ];
                if ($detail->priorty == 1 &&  $detail->service_id != 8) {
                    $item = null;
                    if (isset($payments['pr_1'])) {
                        $item = $payments['pr_1'];
                        //
                        $item->value += $payment->value;
                    } else {
                        $item = $payment;
                    }

                    $payment->paper_id = $student->id . '-1';
                    $payment->update();
                    
                    $item->about = "رسوم تحويل - رسوم مقصه";
                    $payments['pr_1'] = $item;
                } else { 
                    $payments[] = $payment;
                }
                $student->changeStudentCaseConstraint();
            }

            $payarr = [];
            foreach($payments as $element)
                $payarr[] = $element; 
            $payments = $payarr;
            
         
            
        }

        else if ($type == 'service') {
            foreach($request->services as $item) {
                $service = Service::find($item['id']);
                
                
                if ($service) {
                    if($service->type == "wz"){
                        $service->serial = $wzServiceMax + 1 ;
                        $service->service_type = "wz" ;
                    }else{
                        if(!$inServiceMax)
                            $inServiceMax = 0;
                            $service->serial = $inServiceMax + 1 ;
                            $service->service_type = "in" ;
                    }
                    
                    $total = $item['number'] * ($service->value + $service->additional_value);
                     $payment = Payment::addPayment([
                        "serial" => $service->serial,
                        "date" => date('Y-m-d'),
                        "value" => $total,
                        "model_type" => "service",
                        "model_id" => $service->id,
                        "service_type" => $service->service_type,
                        "user_id" => $request->user->id,
                        "store_id" => $service->store_id,
                        "student_id" => $student->id,
                        "service_count" => $item['number']
                    ]); 
                    $payments[] = $payment;
                    StudentService::create([
                        "service_id" => $service->id,
                        "student_id" => $student->id,
                        "service_type" => $service->service_type,
                    ]);
                }
            }
        }

        else if ($type == "old_academic_year_expense") {
            // old balance store
            $store = AccountSetting::getOldBalanceStore();

            $payment = Payment::addPayment([
                "serial" => $wzServiceMax + 1,
                "date" => date('Y-m-d'),
                "value" => $request->value,
                "model_type" => "old_academic_year_expense",
                //"model_id" => null,
                "user_id" => $request->user->id,
                "store_id" => $store->id,
                //"installment_id" => optional($installment)->id,
                "student_id" => $student->id
            ]);
            $payments[] = $payment;
           
        }

        else if ($type == "installment") {
            if ($student->is_current_installed) {
                if (!$installment)
                    $installment = $student->getStudentBalance()->getReadyInstallment('new');
                foreach($details as $detail) {
                    $paidValue = Payment::query()
                        ->where('model_type', 'academic_year_expense')
                        ->where('model_id', $detail->id)
                        ->where('student_id', $student->id)
                        ->sum('value');

                    if ($paidValue < $detail->value && $request->value > 0) {
                        $value = $request->value;
                        $remained = $request->value - $detail->value;
                        //
                        if ($request->value > $detail->value)
                            $value = $detail->value;

                        $payment = Payment::addPayment([
                            "serial" => $wzServiceMax + 1,
                            "date" => date('Y-m-d'),
                            "value" => $value,
                            "model_type" => "academic_year_expense",
                            "model_id" => $detail->id,
                            "user_id" => $request->user->id,
                            "store_id" => $detail->store_id,
                            "installment_id" => optional($installment)->id,
                            "installment_type" => "new",
                            "student_id" => $student->id
                        ]);
                        $payments[] = $payment;

                        $installment->paid = 1;
                        $installment->update();



                        if ($remained > 0) {
                            $request->value = $remained;
                            return self::pay($request, $installment, $payments);
                        }
                    }

                }
            }
            else {
                $installment = $student->getStudentBalance()->getReadyInstallment('old');
                // old balance store
                $store = AccountSetting::getOldBalanceStore();
                $payment = Payment::addPayment([
                    "serial" => $wzServiceMax + 1,
                    "date" => date('Y-m-d'),
                    "value" => $request->value,
                    "model_type" => "installment",
                    //"model_id" => null,
                    "user_id" => $request->user->id,
                    "store_id" => $store->id,
                    "installment_id" => optional($installment)->id,
                    "installment_type" => "old",
                    "student_id" => $student->id
                ]);
                $payments[] = $payment;
                $installment->paid = 1;
                $installment->update();
            }
        }
        /*$payments =  Payment::query()
            ->where('date', date('Y-m-d'))
            ->where('student_id', $student->id)
            ->latest()
            ->get();*/
            
          

        return $payments;
    }


    public static function payRefund(Request $request) {
        $payment = Payment::find($request->payment_id);

        $refund = Payment::addRefund([
            "serial" => $wzServiceMax + 1,
            "date" => date('Y-m-d'),
            "value" => $payment->value,
            "model_type" => "refund",
            "model_id" => $payment->id,
            "user_id" => $request->user->id,
            "store_id" => $payment->store_id,
            "student_id" => $payment->student_id
        ]);
        $payment->is_refund = 1;
        $payment->refund_id = $refund->id;
        $payment->update();

        return $refund;
    }


    public static function removePayment(Request $request) {
        $payment = Payment::find($request->payment_id);
        $pay = $payment;

        if ($payment->installment_id > 0) {
            $installment = installment::find($payment->installment_id);
            if ($installment)
            $installment->update([ "paid" => 0 ]);
        }

        if ($payment) {
            $payment->store->updateStore($payment->value * -1);
            $payment->delete();
        }

        return $pay;
    }

}
