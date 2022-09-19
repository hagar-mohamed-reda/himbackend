<div class="container">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <img src="<?php echo e(asset('assets/img/logo.png')); ?>" width="100px" style="margin: auto">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <br>
            <br>
            <div class="text-center"
                style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;'>
               (<?php if(isset($payments_data[0])): ?>
                   <?php echo e(count($payments_data[0]->groupBy('student_id'))); ?>

               <?php endif; ?>) كشوف خدمات الطالب
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                وزارة التعليم العالي<br>
                المعهد العالي للأدارة </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td>اسم الطالب</td>
                <td>الخدمة</td>
                <td>القيمة</td>
                <td>تاريخ الدفع</td>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($payments_data[0])): ?>

                <?php $__currentLoopData = $payments_data[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(optional($payment->student)->name); ?></td>
                        <td><?php echo e(optional($payment->model_object)->name); ?></td>
                        <td><?php echo e($payment->value); ?></td>
                        <td><?php echo e(Carbon\Carbon::parse($payment->created_at)->format('Y-m-d')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </tbody>
    </table>

</div>
<?php /**PATH /home/mohamed/Documents/work-drhamdi/himbackend/Modules/Account/Resources/views/student_services_payments/index.blade.php ENDPATH**/ ?>