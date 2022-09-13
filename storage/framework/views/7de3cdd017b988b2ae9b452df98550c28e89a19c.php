

  <div style="display:none">  <?php $studentChunk = $responses->chunk(18); ?> </div>
  <div style="display:none">  <?php $indexNum = 1; ?> </div>
    
 <?php $__currentLoopData = $studentChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 

<!--overflow: hidden !important;-->
<!--height:1045px !important;-->
<div class="container" style="padding: 0px !important;margin: 0px !important; ">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <img src="<?php echo e(url('/logo.png')); ?>" width="100px" style="margin: auto" >
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;'>
                أسماء  أوائل الطلبه  
            </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>المستوي : <?php echo e($level->name); ?></span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'> تخصص :  <?php echo e($division->name); ?></span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>للعام الجامعي 2021 / 2022</span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>الفصل الدراسي الأول</span>
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
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;width: 43px !important;">م</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> اسم الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الكود</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">رقم الجلوس</td>


            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
            <div style="display:none"><?php echo e($studentCourses =  Modules\Academic\Entities\StudentRegisterCourse::query()
                        ->where('student_id', $student->id)
                        ->where('academic_year_id', 8)
                        ->where('term_id', 1)
                        ->select('*', 'academic_courses.id as id', 'academic_student_register_courses.created_at as register_date')
                        ->join('academic_courses', 'academic_courses.id', '=', 'course_id')->orderby('course_id')->get()); ?></div>
          
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;"><?php echo e($indexNum++); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->name); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->code); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->set_number); ?></td>

             

            </tr>
          
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table class="table table-bordered">
    <div class="row text-center">
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
            <p style='font-weight: bolder !important;font-size:14px !important;'>يعتمد</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
            <p style='font-weight: bolder !important;font-size:14px !important;'>عميد المعهد</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
            <p style='font-weight: bolder !important;font-size:14px !important;'>مدير شئون الطلاب</p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
            <p style='font-weight: bolder !important;font-size:14px !important;'>اخصائي شئون الطلاب</p>
        </div>
        
    </div>
</div>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH /home/pnpskkmy/public_html/him/resources/views/report/report25.blade.php ENDPATH**/ ?>