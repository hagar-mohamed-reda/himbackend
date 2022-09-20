

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
              تقرير احصائيات النتيجة  
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
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> اسم المادة </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> عدد الطلاب المسجلين </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">  عدد الحضور</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الغياب  </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الناجحين</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الراسبين</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">نسبة النجاح</td>



            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:none"> <?php echo e($registerStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->count()); ?>  </div>
            <div style="display:none"> <?php echo e($presentStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa_word','!=','AB')->count()); ?>  </div>
            <div style="display:none"> <?php echo e($absenceStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa_word','=','AB')->count()); ?>  </div>
            <div style="display:none"> <?php echo e($successStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa', '>', 1)->count()); ?>  </div>
            <div style="display:none"> <?php echo e($failedStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa', '=', 'F')->count()); ?>  </div>
            <?php if($presentStudents != 0): ?>
            <div style="display:none"> <?php echo e($percentage = $successStudents / $presentStudents * 100); ?>  </div>
            <?php else: ?>
            <div style="display:none"> <?php echo e($percentage = 0); ?> </div>
            <?php endif; ?>
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;"><?php echo e($index); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($course->name); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($registerStudents); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($presentStudents); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($absenceStudents); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($successStudents); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($failedStudents); ?></td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e(round($percentage, 2)); ?> %</td>



             

            </tr>
          
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table class="table table-bordered">
    
      <div class="row text-center">
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
            <p style='font-weight: bolder !important;font-size:14px !important;'>عميد المعهد والرئيس العام للأمتحانات</p>
            <p style='font-weight: bolder !important;font-size:14px !important;'>أ.د / أحمد ابو القمصان</p>
            <p style='font-weight: bolder !important;font-size:14px !important;'>(                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     )</p>
            
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        </div>
        
    </div>
    
   
</div>


<?php /**PATH F:\company\himback\himbackend\resources\views/report/result_statistics.blade.php ENDPATH**/ ?>