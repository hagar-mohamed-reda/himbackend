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
                تقرير الطلبه المتخلفه عن الميد
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
                <td>الكود</td>
                <td>المادة</td>
                <td>التخصص</td>
            </tr>
        </thead>
        <tbody>




            <?php if(count($results) == 0): ?>
                <tr>
                    <td style="text-align: center;font-size : 30px" colspan="8">لا يوجد بيانات</td>
                </tr>
            <?php endif; ?>


            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($result->student)): ?>
                    <tr>
                        <td><?php echo e(optional($result->student)->name); ?></td>
                        <td><?php echo e(optional($result->student)->code); ?></td>
                        <td><?php echo e(optional($result->course)->name); ?></td>
                        <td>
                            <?php if(isset($result->student)): ?>
                                <?php echo e(optional($result->student->division)->name); ?>

                            <?php endif; ?>
                        </td>
                      
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

</div>
<?php /**PATH /home/mohamed/Documents/work-drhamdi/himbackend/Modules/Student/Resources/views/students/medterm.blade.php ENDPATH**/ ?>