
 <?php $__currentLoopData = $birthAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birth_address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
  <div style="display:none">  <?php $studentQuery = $students->where('triple_number_order', $birth_address->triple_number_order); ?> </div>
  <div style="display:none">  <?php $studentChunk = $studentQuery->chunk(50); ?> </div>

 <?php $__currentLoopData = $studentChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

   <div style="display:none">  <?php $std = Modules\Account\Entities\Student::where('triple_number_order',$birth_address->triple_number_order)->get(); ?> </div>

<div class="container" style="min-height:1046px !important;padding: 0px !important;margin: 0px !important; ">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <img src="<?php echo e(url('/logo.png')); ?>" width="100px" style="margin: auto" >
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <!--<div class="text-center">السيد / مدير مكتب جامعة  <?php echo e($birth_address->triple_number_order); ?></div>-->
            <div class="text-center" style='font-weight: bolder !important;font-size:22px !important;'>سجل تجنيد الفرقة الأعدادي </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:22px !important;'><?php echo e($std[0]->national_id_place); ?></div>
            <div class="text-center" style='font-weight: bolder !important;font-size:22px !important;'>تحية طيبة وبعد</div>
            <div class="text-center" style='font-weight: bolder !important;font-size:22px !important;'>
                نتشرف بأن نرسل لسيادتكم رفق هذا نماذج ( 2 جند ) بطلاب المستوي ( <?php echo e(optional($level)->name); ?> ) في
                العام الدراسي 2021 / 2022
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:22px !important;'>
                وزارة التعليم العالي<br>
                 المعهد العالي  للإدارة بالمحلة الكبري
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">اسم الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">تاريخ الميلاد</td>
                <!--<td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">محل الميلاد</td>-->
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">بطاقة شخصية</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">جهة صدورها</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">الرقم الثلاثي</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">المؤهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">المستوي</td>
                
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;">قرار التجنيد</td>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"> <?php echo e($student->name); ?>  </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->birthdate); ?></td>
                <!--<td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->birth_address); ?></td>-->
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->national_id); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->national_id_place); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->triple_number); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"> <?php echo e(optional($student->qualification)->name); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e(optional($student->level)->name); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:22px !important;"><?php echo e($student->military_number_code); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table class="table table-bordered">
    <div class="row text-center">
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>مسئول التجنيد</p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>المراجع</p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>مدير الادارة</p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>أمين المكتبة</p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>المفتش</p>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
            <p style='font-weight: bolder !important;font-size:22px !important;'>قائد مكتب الأتصال</p>
        </div>
    </div>
</div>


 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /home/pnpskkmy/public_html/him/resources/views/report/report15.blade.php ENDPATH**/ ?>