<html>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <style type="text/css" >
			.bold{
				font-weight: bold;
			}
			@media  print {
			    
			    
			    html,body{
			        padding:0 !important;
			        overflow:hidden;
			    }
				
					.print-order {
						display: none !important;
					}
		
				#tab{
					    display:block !important;
					} 
					

			}
			*{
			    text-align: center !important;
			}
			
            
            #title {
                text-align: center;
            }
            
            h5,
            h6 {
                font-weight: bolder;
                font-size: 8.7px !important;
            }
            
            #seating_number {
                border: 1px solid black;
                text-align: center;
                height: 120px;
            }
            
            #seating_number th {
                border-bottom: black 1px solid;
            }
            
            #img {
                border: 1px solid black;
                height: 120px;
            }
            
            img {
                width: 100%;
                height: 100%;
            }
            
            #name {
                margin: 1.5px 3px 0 0;
                text-align: start;
                border: 1px solid black;
                height: 27px;
            }
            
            #place {
                margin: 15px 3px 0 0;
                text-align: start;
                border: 1px solid black;
                text-align: center;
                height: 27px;
                /*margin-top: 16px;*/
            }
            
            #place-style {
                display: flex;
                justify-content: space-between;
            }
            
            .border {
                border-right: 1px solid black;
                border-left: 1px solid black;
                height: 26px;
            }
            
            #subjects {
                padding-top: 31px;
                border-right: black solid 1px;
            }
            
            .content {
                padding: 0px !important;
            }
            *{
                font-family: Arial, Helvetica, sans-serif !important;
            }
              
			
</style>



    <body>
        
    <!--            <center>-->
				<!--	<hr class="mg-b-10">-->
				<!--	<button id="print-order_numberbtn" class="btn btn-danger print-order_numberbtn" ><i class="mdi mdi-printer ml-1"></i> طباعة </button> -->
				<!--</center>-->
				
	<div class="all">	
	            <div style="display:none"><?php echo e($variable = 1); ?></div>
           <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if($variable % 4 == 0): ?>
                   <div class="w3-row" style="background-color: white;padding-bottom:3px; height:250px; margin-bottom:100px;">
            <?php else: ?> 
            <div class="w3-row" style="background-color: white; padding-bottom:3px; height:250px; margin-bottom:7px;"> 
           <?php endif; ?>
            <div style="display:none"><?php echo e($variable++); ?></div>

            <div style="display:none"><?php echo e($courses = $student['current_register_courses']->sortBy('exam_date')); ?></div>
            <div style="display:none"><?php echo e($commission = Modules\Student\Entities\Commission::find($student->commission_id)); ?></div>
            <div style="display:none"><?php echo e($theater = Modules\Student\Entities\Theater::find($commission->theater_id)); ?></div>
           
            <div class="w3-col s6" style="padding-top: 1px;border-bottom: 1px solid black;padding-bottom: 5px;">
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="place">
                        <div id="place-style">
                               <div class="w3-col s6">
                                <h6 style="font-weight: bolder;
                font-size: 8.7px !important;"><?php echo e($course->name); ?></h6>
                            </div>
                            <div class="w3-col s4 border">
                                <h6 style="font-weight: bolder;
                font-size: 8.7px !important;"><?php echo e($course->exam_date); ?>  |  <?php echo e($course->time); ?></h6>
                            </div>
                              <div class="w3-col s2">
                                <h6 style="font-weight: bolder;
                font-size: 8.7px !important;"><?php echo e($course->exam_day); ?></h6>
                            </div>
                        </div>
                    </div>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
            
            <div class="w3-col s6" style="border-left: 1px solid black; padding-left: 3px;padding-top: 0px;border-bottom: 1px solid black;padding-bottom: 3px;">
                <div style="text-align: center;">
                    <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">وزارة التعليم العالي</h6>
                    <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">المعهد العالي للأدارة بالمحلة الكبري</h6>
                    <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">الفصل الدراسي الثاني ۲۰۲۲/۲۰۲۱</h6>
                </div>
                <div class="w3-row">
                    <div id="img" class="w3-col s3">
                        <img src="<?php echo e($student->image); ?>" alt="">
                    </div>
                    <div id="seating_number" class="w3-col s9">
                        <div style='display: inline-block !important;'>
                            <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">رقم الجلوس</h6>
                        <h6 style="font-weight: bolder;
                font-size: 9.4px !important;margin-bottom: 0px !important;"><?php echo e($student->set_number); ?></h6>
                        </div>
                        <div style='display: inline-block !important;margin-right: 20px !important;'>
                            <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">كود الطالب</h6>
                        <h6 style="font-weight: bolder;
                font-size: 9.4px !important;margin-bottom: 0px !important;"><?php echo e($student->code); ?></h6>
                        </div>
                        <hr style="border: 1px solid #8080809e;margin: 10px 0 !important;">
                        <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">حالة القيد : مستجد</h6>
                        <h6 style="font-weight: bolder;
                font-size: 9.4px !important;">المستوي : <?php echo e($student->level->name); ?>  -         تخصص  : <?php echo e($student->division->name); ?>  </h6>
                    </div>
        
                    <div id="name" class="w3-col s12" style="margin-top: 5px;">
        
                        <h6 style='margin-right: 30px;font-size: 12px !important;'><?php echo e($student->name); ?></h6>
                    </div>
                    <div id="place" class="w3-col s12" style="margin-top: 5px;">
                        <div id="place-style">
                            <div class="w3-col s6">
                                <h6 style="font-weight: bolder;
                font-size: 11px !important;"> <?php echo e($theater->name ?? ''); ?></h6>
                            </div>
                            <div class="w3-col s6">
                                <h6 style="font-weight: bolder;
                font-size: 11px !important;"><?php echo e($commission->name ?? ''); ?></h6>
                            </div>
                        
                        </div>
                    </div>
        
                </div>
            </div>

        </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     </div>  
     
    

 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>-->
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js.map"></script>-->
        <script>
                $(document).ready(function () {
                    
                    $(document).on('click', '.pagination a', function(event){
              event.preventDefault(); 
              var page = $(this).attr('href').split('page=')[1];
              fetch_data(page);
             });
            
             function fetch_data(page)
             {
              $.ajax({
               url:"/affair/fetch_data_report8?page="+page,
               success:function(data)
               {
                $('#table_data').html(data);
               }
              });
             }
        
                      
                });//end of document ready

        </script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
     <script src="<?php echo e(asset('js/print.js')); ?>"></script>

    </body>
</html><?php /**PATH /home/pnpskkmy/public_html/him/resources/views/report/report8.blade.php ENDPATH**/ ?>