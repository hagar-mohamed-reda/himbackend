<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <link rel="stylesheet" href="<?php echo e(url('/css/w3.css')); ?>">
<title>ايصال رقم <?php echo e($payment->id); ?></title>
</head>
<body> 
    <?php
        $copies = 1;
        $service = null;
        if ($payment->model_type == 'service')
            $service = \Modules\Account\Entities\Service::find($payment->model_id);

        if ($service) {
            if ($service->type == 'in')
                $copies = 2;
        }     ?>
    <?php for($count = 0; $count < $copies; $count ++): ?>
    <div style="width: 100%;direction: rtl!important;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;border: 1px dashed gray"  >
        <table  style="width: 100%;text-align: center" >
            <tr>
                <td style="width: 50%" >
                    <div style="text-align: center;font-size: 18px" >
                        <b>وزارة التعليم العالى</b>
                        <br>
                        <b>المعهد العالي للإدارة</b>
                        <br>
                        <b>بالمحلة الكبري</b>
                    </div>
                </td>
                <td style="width: 50%" >
                <img src="<?php echo e(url('/logo.png')); ?>" width="80px" alt="">
                </td>
            </tr>
        </table> 
        <div style="padding: 20px" >
                <div style="width: 100%;border-bottom: 2px dashed black;margin: auto" ></div>
                <br>
                    <?php if($count == 0): ?>
                <div style="width: 100%;text-align: center" >
                    <b style="font-size: 16px" >رقم القسيمة</b>

                        <span id="paymentId" ><?php echo e($payment->id); ?></span>
                </div>
                <?php else: ?>
                <br>
                    <?php endif; ?>
                <table  style="width: 100%;" >
                    <td style="width: 50%" >
                    <table  style="width: 100%;" >
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>تاريخ السداد :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                <?php echo e($payment->date); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>وصلنــــا من :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                <?php echo e(optional($payment->student)->name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                                <b>المستــــــوى :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                <?php echo e(optional(optional($payment->student)->level)->name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>مبلـغ وقــدره :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                               <span class="payment-value" ><?php echo e(number_format($payment->value)); ?></span> جنيه
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                              <b>ســــــداد عن :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                <?php if($payment->about): ?>
                                    <?php echo e($payment->about); ?>

                                <?php endif; ?> 

                                <?php if($payment->model_type == 'old_academic_year_expense'): ?>
                                رسوم سابقة . <?php echo e(optional($payment->student)->old_balance_notes); ?>

                                <?php elseif($payment->model_type == 'service'): ?>
                                <?php
                                    $service = \Modules\Account\Entities\Service::find($payment->model_id);

                                ?>
                                خدمة <?php echo e(optional($service)->name); ?> - عدد النسخ <?php echo e($payment->service_count); ?>

                                <?php elseif($payment->model_type == 'installment'): ?>
                                <?php
                                    $installment = \Modules\Account\Entities\Installment::find($payment->installment_id);

                                ?>
                                قسط
                                 (<?php echo e(optional($installment)->type == "new"? 'رسوم حاليه' : 'رسوم سابقه' . ' - ' . optional($payment->student)->old_balance_notes); ?>)
                                <?php elseif($payment->model_type == 'refund'): ?>
                                <?php
                                    $payment = \Modules\Account\Entities\Payment::find($payment->model_id);

                                ?>
                                رد رسوم عن قسيمة رقم (<?php echo e(optional($payment)->id); ?>) 
                                <?php else: ?> 
                                 <?php if(!$payment->is_pr): ?>
                                    <?php echo e(optional($payment->model_object)->name); ?>

                                <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                                <b>ملاحظــــات :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                               <?php echo e(""); ?>

                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%" >
                        <table  style="width: 100%;" >
                            <tr >
                                <td colspan="2" style="width: 40%;padding: 5px" >
                                <div style="text-align: center" >
                                    <b>المبلغ</b>
                                    <br>
                                    <span class="payment-value" ><?php echo e(number_format($payment->value)); ?></span>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;padding: 5px" >
                                <b>الكــود :</b>
                                </td>
                                <td style="width: 60%;padding: 5px" >
                                 <?php echo e(optional($payment->student)->code); ?>

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;padding: 5px" >
                                    <b>الشعبه :</b>
                                </td>
                                <td style="width: 60%;padding: 5px" >
                                   <?php echo e(optional(optional($payment->student)->division)->name); ?>

                                </td>
                            </tr>
                        </table>
                </td>
            </table>
            <br>
            <table  style="width: 100%;" >
                <tr>
                    <td style="width: 50%" ></td>
                    <td style="width: 50%;text-align: center";padding: 5px >
                            <div style="text-align: center" >
                                <b>الخزنية</b>
                                <br>
                                <?php echo e(optional($payment->user)->name); ?>

                            </div>
                    </td>
                </tr>
            </table>
    </div>
</div>
    <br>  
    <?php endfor; ?>

    <div class="w3-modal" style="display: block" id="printModal" >
        <div class="w3-modal-content w3-white w3-round w3-card w3-padding" style="direction: rlt" >
            <div class="w3-center"  style="direction: rtl" >
               <b> يتم طباعة الوصل برقم  : </b>
               <input type="number" class="w3-input" id="paymentIdInput" value="<?php echo e($payment->id); ?>" >
            </div>
            <br>
            <div class="w3-center" >
                <button class="w3-button w3-indigo" onclick="printPage()" >طباعة</button>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo e(url('/js/jquery-3.2.1.min.js')); ?>" ></script>
    <script type="text/javascript" src="<?php echo e(url('/js/tafgeetjs.min.js')); ?>" ></script>

    <script type="text/javascript"> 


        $('.payment-value').each(function(){
            $(this).html(new Tafgeet($(this).text(), 'EGP').parse());
        });  

        function toggleModal(action) {
            var modal = document.getElementById('printModal');

            modal.style.display = action=='show'? 'block' : 'none'; 
        }

        function printPage() {
            var id = document.getElementById('paymentIdInput').value;
            document.getElementById('paymentId').innerHTML = id;
            toggleModal('hide');
            window.print();
        }
 
        
    </script>
</body>
</html>
<?php /**PATH /home/pnpskkmy/public_html/him/Modules/Account/Resources/views/payment_receipt.blade.php ENDPATH**/ ?>