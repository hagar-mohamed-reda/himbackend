<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيان حالة دراسية</title>

    <?php echo $__env->make("services.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<style>
    @media  print{
        @page  {size: landscape}
        .yellowclass {
           background-color: yellow;
         }
    }
    .safe-box {
    padding: 10px
}

.border-bottom-dashed {
    border-bottom: 2px dashed gray!important;
}

.border-bottom-red {
    border-bottom: 2px dashed red!important;
}

.border-dashed {
    border: 2px dashed lightgray!important;
}
// .test
// {
//     margin-top:10px ;
// }
.btn-margin-bottom {
    margin-bottom: 6px!important;
}

.custom-panel {
    border: 2px dashed lightgray!important;
    margin-bottom: 15px!important;
}

.custom-panel-title {
    position: absolute!important;
    right: 10px!important;
    top: -13px!important;
    width: auto!important;
    background-color: white!important;
    padding-left: 10px!important;
    padding-right: 10px!important;
}

.custom-panel-body {
    padding: 5px;
}

.small-shadow {
    box-shadow: 0 1px 1px 0px rgba(0, 0, 0, 0.3)!important;
}

.search-input {
    min-width: 70%!important;
}

.border-gray {
    border: 1px solid gray!important;
}

.custom-input {
    min-width: 120px
}

.modal {
    overflow: auto!important;
}


/*
custom button style
*/

select,
input[type=file] {
    padding: 0px!important;
}

.filter-top {
    height: 200px!important;
    overflow: auto;
}

.filter-side {
    height: 400px!important;
    overflow: auto;
}

.w3-ul li {
    padding: 2px!important;
    font-size: 12px!important;
}

.number_input {
    width: 45px
}


</style>

<body>
    <div class="custom-panel w3-display-container w3-round application-panel student-info-panel">
                    <div class="custom-panel-body table-responsive w3-padding" id="printable">
                        
                        <div>
                                          <!-- =====first page=== -->
                                          <div class="container" style="height: 100vh;">
                                                <div class="container w-100" style="text-align: center !important;">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <img src="<?php echo e(url('/logo.png')); ?>" alt="" style="width: 90px">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"
                                                            >وزارة التعليم العالي</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> 
                                                                المعهد العالي للإدارة بالمحلة الكبري</h6>
                                                        </div>
                    
                                                        <div 
                                                        class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> 
                                                                نتيجة العام الجامعي 2021 - 2022 
                                                            </h6>
                                                        </div>
                    
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">تاريخ الميلاد / <?php echo e($studentInfo[0]->birthdate); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">تاريخ الألتحاق / 2021-2022</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">الساعات المحققة / <?php echo e($ActualRegisterHours); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">حالة الطالب / مستجد</h6>
                    
                                                        </div>
                    
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">موقف القبول / <?php echo e($studentInfo[0]->registeration_status); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">رقم الكود / <?php echo e($studentInfo[0]->code); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">سنة المؤهل / 2021</h6>
                                                            <!-- test -->
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">الساعات التي تم تسجيلها / <?php echo e($registerHours); ?></h6>
                                                           
                                                           
                    
                                                        </div>
                    
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">أسم الطالب / <?php echo e($studentInfo[0]->name); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">المستوي / <?php echo e($studentInfo[0]->level_name); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">المؤهل / <?php echo e($studentInfo[0]->qualification_name); ?></h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">نوع القيد / <?php echo e($studentInfo[0]->case_constraint); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->case_constraint_id != 7): ?>
                                                <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">الفصل الدراسي الأول</h6>
                                                </div>
                                                <?php endif; ?>
                                                <br>
                                                <?php if($studentInfo[0]->case_constraint_id == 7): ?>

                                                 <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">سحب ملف طالب متوفي</h6>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($studentInfo[0]->code == 202110173 || $studentInfo[0]->code == 202110569): ?>
                                                <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">  عذر  بموافقة الوزاره للتيرم الاول والتانى رقم القرار 100 بتاريخ 17/7</h6>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($studentInfo[0]->code == 202110433): ?>
                                                <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">عذر  بموافقة الوزاره عن التيرم التيرم الاول فقط رقم القرار 100 بتاريخ 17/7</h6>
                                                </div>
                                                <?php endif; ?>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 && $studentInfo[0]->case_constraint_id != 7 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->code != 202110173 && $studentInfo[0]->code != 202110569 && $studentInfo[0]->code != 202110433): ?>
                                              
                                                <?php endif; ?>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->code != 202110433 && $studentInfo[0]->case_constraint_id != 7): ?>

                                                <div style="background-color:rgba(0,0,0,.5) !important;text-align: center;margin-bottom: 10px;"> 
                                                 نتيجة الطالب عقب إعلان الفصل الدراسي الأول &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; معدل فصلي &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($CGPA); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <?php endif; ?>
                                                <br>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->case_constraint_id != 7): ?>

                                                <div
                                                     class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                   <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">الفصل الدراسي الثاني</h6>
                                               </div>
                                               <?php endif; ?>
                                               <?php if($studentInfo[0]->code == 202110484 || $studentInfo[0]->code == 202110599): ?>


                                            <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;">
                                                <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">لم يتم تسجيل ارشاد اكاديمي بسبب سحب  الطالب للملف بموافقته</h6>
                                            </div>
                                            <?php endif; ?>
                                            <?php if($registerCourses->isempty() && $studentInfo[0]->case_constraint_id == 2): ?>

                                          

                                            <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important;margin-top: 15px;">
                                                <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">لم يتم تسجيل ارشاد اكاديمي</h6>
                                            </div>
                                            <?php endif; ?>
                                              
                                                <?php if($registerCourses->isempty()): ?>
                                            <ng-container>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 &&  $studentInfo[0]->code != 202110173 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->case_constraint_id != 7): ?>
                                                <table class="table table-bordered " style="direction: rtl!important;margin-bottom: 0px !important;">
                
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">#</th>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">كود المادة</td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">أسم المادة</td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">الدرجة</td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">التقدير</td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">النقاط</td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">الساعات</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $registerCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($iteration); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->course_code); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->course_name); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->final_degree); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->gpa_word); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->gpa); ?></td>
                                                            <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($item->hours); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                                <?php endif; ?>
                                                <?php if($studentInfo[0]->case_constraint_id != 6 && $studentInfo[0]->case_constraint_id != 8 && $studentInfo[0]->case_constraint_id != 7): ?>
                
                
                                                <div style="background-color:rgba(0,0,0,.5) !important;text-align: center;margin-bottom: 10px;">نتيجة الطالب عقب إعلان الفصل الدراسي الثاني &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; معدل فصلي &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($CGPA); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <?php endif; ?>
                                            </ng-container>
                                            <?php endif; ?>
                                                <div  style="background-color:rgba(0,0,0,.5) !important;text-align: center;">المعدل التراكمي 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                <!-- .toString()->slice(0, ($CGPA->indexOf("."))+3) -->
                                                <?php echo e($CGPA); ?>

                                                </div>
                                                <div class="container" style="text-align: center !important;">
                                                    <div class="row">
                    
                    
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">رئيس عام الامتحانات</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">أ.د / أحمد ابوالقمصان <br> عميد المعهد </h6>
                                                        </div>
                    
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">رئيس لجنة النظام والمراقبة</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">د /   يوسف ابراهيم</h6>
                                                        </div>
                                                        
                                                        <div class="col-xs-4">
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">لجنة الكنترول</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">د /  منى داود</h6>
                                                            <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">د / أحمد رضوان</h6>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                          </div>
                                          <!-- ======== -->
                                          <!-- =====first bian 7ala=== -->
                                          <div class="container" style="height: 100vh;">
                                            <div class="col-xs-12 " style="background-color: rgba(0,0,0,.5) !important;  margin-bottom: 30px !important;">
                                                <h6 style="text-align: center !important; text-decoration: underline !important;font-size: 22px !important;font-weight: 
                                                bolder !important;">بيان حاله </h6>
                                            </div>
                                <div class="col-xs-6">
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> الجنسيه / <?php echo e($studentInfo[0]->nationality_name); ?></h6>
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> شعبه / <?php echo e($studentInfo[0]->division_type); ?></h6>
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> حاله القيد / مستجد</h6>
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> تاريخه / 2021</h6>
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;">  النسبه المؤيه  /  <?php echo e($studentInfo[0]->grade*100 / $studentInfo[0]->qualification_grade); ?> 
                                        <!-- <?php echo e($studentInfo[0]->grade*100 / $studentInfo[0]->qualification_grade); ?> -->
                                       </h6>
                                    <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important; overflow: hidden;"> </h6>
                        
                                </div>
                                <div class="col-xs-6">
                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> اسم الطالب / <?php echo e($studentInfo[0]->name); ?></h6>
                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> الفرقه / <?php echo e($studentInfo[0]->level_name); ?></h6>
                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">العام الدراسى/ 2020-2021</h6>
                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> المؤهل / <?php echo e($studentInfo[0]->qualification_name); ?></h6>
                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">رقم الجلوس/ <?php echo e($studentInfo[0]->code); ?></h6>
                                    <h6 style="text-align: left !important;font-size: 13px !important;font-weight: bolder !important;"> المجموع / <?php echo e($studentInfo[0]->grade); ?></h6>
                                </div>
                               
                                <div class="col-xs-12" style="background-color: rgba(0,0,0,.5) !important; margin-bottom: 30px !important;">
                                    <h4 style="text-align: center !important; text-decoration: underline !important;
                                    font-size: 22px !important;font-weight: bolder !important; ">التسلسل الدراسى للطالب
                                    </h4 >
                                
                                </div>
                                <div class="tst" style="overflow: hidden;">1</div><br>
                                <h5 class="test" style="margin-top: 5px !important; text-align: right !important;">الطالب قيد بالفرقه الاولى مستجد فى العام الدراسى 2020/2021 ونتيجته ناجح 
                                <br><br>  وله حق القيد بالفرقه التانيه مستجد فى العام الدراسى2021/2022
                            
                                <br><br>
                                <b>                                وقد اعطى هذا البيان بناء على طلب الطالب لتقديمه الى /  المعهد العالى للدراسات المتطوره بالقطاميه 
                                </b>
                                </h5>
                                <br><br>
                                <div class="container" style="text-align: center !important;">
                                    <div class="row">
                            
                                        <div class="col-xs-4">
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> الامين العام</h6>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> السيد مهدى السيد</h6>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">عميد المعهد</h6>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> أ/ نيفين طريح</h6>
                            
                                        </div>
                                        <div class="col-xs-4">
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">   مدير شئون الطلاب </h6>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">    على عثمان</h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> الموظف المختص </h6><br><br>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">تحريرا فى 28/9/2021</h6>
                                        </div>
                            
                                       
                                        
                                       
                                    </div>
                                    </div>
                                          </div>
                                          <!-- ======== -->
                                          <div class="border-bottom-dashed"></div>
                                          <!-- =====second bian 7ala=== -->
                                          <div class="container"  style="height: 100vh;">
                                          <div class="row">
                                            
                                               <div class="col-xs-6">
                                                        <img src="<?php echo e(url('/logo.png')); ?>" alt="" style="width: 90px">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"
                                                        >وزارة التعليم العالي</h6>
                                                        <h6 style="text-align: center !important;font-size: 13px !important;font-weight: bolder !important;"> 
                                                            المعهد العالي للإدارة بالمحلة الكبري</h6>
                                                    </div>
                                          </div>
        
                                            <div class="col-xs-12 " style="background-color: rgba(0,0,0,.5) !important;  margin-bottom: 30px !important;">
                                                <h6 style="text-align: center !important; text-decoration: underline !important;font-size: 22px !important;font-weight: 
                                                bolder !important;">بيان حاله 
                                                </h6>
                                                
                                            </div >         
                                            
                                            <div style="text-align: right !important;font-size: 20px !important;">
                                            السيد الاستاذ الدكتور عميد /  المعهد العالى للعلوم الاداريه بالقطاميه       
                                            <br><p style="text-align: center !important">تحيه طيبه وبعد ...</p>
                                            نتشرف باحاطه سيادتكم علما بان الطالب / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo e($studentInfo[0]->name); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; المقيد بمعهدنا <br>
                                            قد ابدى رغبته فى التحويل طرفكم - وليس لدينا مانع من تحويله - علما بان بياناته كما يلى <hr>
                                            </div>
                                            <div class="col-xs-6">
                                                <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> سنه المؤهل / 2021</h6>
                                                <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> المجموع / مستجد</h6>
                                            
                                            </div>
                                            <div class="col-xs-6">
                                                <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> المؤهل / <?php echo e($studentInfo[0]->qualification_name); ?></h6>
                                                <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">رقم الجلوس/ مستجد</h6>
                                            </div>
                                           
                                            <p style="text-align: center;font-size: 20px !important;">وفيما يلى بيان بالتسلسل الدراسى للطالب</p>
                                            <table  class="table table-bordered " style="direction: rtl!important;margin-bottom: 0px !important;">
                                            
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">العام الجامعى</th>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"> حاله القيد</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"> الفرقه</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">الشعبه</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">النتيجه</td>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr >
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">2020/2021</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">مستجد</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">الاول</td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;"><?php echo e($studentInfo[0]->division_type); ?> </td>
                                                        <td style="text-align: center;font-weight: bolder;border: 1px solid black !important;padding: 2px !important;">(جيد)</td>
                                                    
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                          <div style="text-align: right !important; ">
                                            <h5>وطبقا لسجلات المعهد فان الطالب المذكور له حق القيد بالفرقه : الثانيه&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; شعبه:   <?php echo e($studentInfo[0]->division_type); ?></h5>
                                            <h5>وذلك للعام الدراسى : 2020/2021 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                حاله القيد : مستجد</h5>
                                            <h5>والمعهد ليس عليه اى مسؤليه عن سوء استعمال هذا البيان ولا يجوز استخدامه الا من قبل الجهه الموجهه اليها فقط </h5>
                                          </div>
                                            <br><br><br>
                                            <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">تحريرا فى 28/9/2021</h6>
                                            <div class="container" style="text-align: center !important;">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">عميد المعهد</h6>
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">  ا.د/محمد عيد حسونه </h6>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">     مسئول الكنترول </h6>
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">    أ/سحر عربى </h6>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">    شئون الطلاب </h6>
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">    أ/سحر عربى </h6>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;"> الموظف المختص </h6>
                                                    <h6 style="text-align: right !important;font-size: 13px !important;font-weight: bolder !important;">  نهى رافت </h6>
                                                </div>
                                            </div>
                                            </div>
                                          </div>
                                          <!-- ======== -->
                        </div>             
                    </div>
                </div> 
                
                
                
                
                
                
                
                


    <?php echo $__env->make("services.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/pnpskkmy/public_html/him/resources/views/services/service3.blade.php ENDPATH**/ ?>