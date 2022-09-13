

  <div style="display:none">  <?php  $index = 1; ?> </div>
    
 
 <!--overflow: hidden !important;-->
 <!--height:1045px !important;-->
 <div class="container" style="padding: 0px !important;margin: 0px !important; height:100vh;">
     <div class="row" style='direction: ltr !important;'>
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
             <img src="<?php echo e(url('/logo.png')); ?>" width="100px" style="margin: auto" >
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
             <br>
             <br>
             <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;'>
تقرير الطلبه المتخلفه عن الميد             </div>
             <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                 <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>المستوي الأول</span>
                 <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>للعام الجامعي 2021 / 2022</span>
             </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
             <br>
             <br>
             <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                  وزارة التعليم العالي<br>
                  المعهد العالى للإداره بالمحله الكبرى </div>
         </div>
     </div>
     
 
     <table class="table table-bordered">
         <thead>
             <tr>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;width: 43px !important;">م</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">رقم الجلوس</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">أسم الطالب</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الكود</td>
               

             </tr>
         </thead>
         <tbody>
             <?php $__currentLoopData = $responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
             
           
             <tr>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;"><?php echo e($index++); ?></td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->set_number); ?></td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->name); ?></td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;"><?php echo e($student->code); ?></td>


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
 

 <?php /**PATH /home/pnpskkmy/public_html/him/resources/views/report/report23.blade.php ENDPATH**/ ?>