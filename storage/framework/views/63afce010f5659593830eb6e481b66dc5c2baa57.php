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
            كشوف تسجيلات الطلاب (<?php echo e(count($students->groupBy('student_id'))); ?>)
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
                <td>المادة</td>
                <td>التخصص</td>
                <td>المستوى</td>
                <td>التيرم</td>
            </tr>
        </thead>
        <tbody>

                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $std): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(optional($std->student)->name); ?></td>
                        <td><?php echo e(optional($std->course)->name); ?></td>
                        <td><?php echo e(optional($std->division)->name); ?></td>
                        <td><?php echo e(optional($std->level)->name); ?></td>
                        <td><?php echo e(optional($std->term)->name); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

</div><?php /**PATH /home/mohamed/Documents/work-drhamdi/himbackend/Modules/Student/Resources/views/term-sefy.blade.php ENDPATH**/ ?>