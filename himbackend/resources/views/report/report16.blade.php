

  <div style="display:none">  <?php $studentChunk = $responses->chunk(18); ?> </div>
  <div style="display:none">  <?php $indexNum = 1; ?> </div>
    
 @foreach($studentChunk as $chunk)
 

<!--overflow: hidden !important;-->
<!--height:1045px !important;-->
<div class="container" style="padding: 0px !important;margin: 0px !important; ">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <img src="{{url('/logo.png')}}" width="100px" style="margin: auto" >
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;'>
                أسماء الطلاب المتقدمة للأمتحان 
            </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>المستوي : {{$level->name}}</span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'> تخصص :  {{$division->name}}</span>
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
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> المؤهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> الكود</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> المستوي</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> التخصص</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> سنة الموهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">  نوع القبول</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;">رقم الجلوس</td>


            </tr>
        </thead>
        <tbody>
            @foreach($chunk as $student)
          
            <div style="display:none">{{ $studentCourses =  Modules\Academic\Entities\StudentRegisterCourse::query()
                        ->where('student_id', $student->id)
                        ->where('academic_year_id', 8)
                        ->where('term_id', 1)
                        ->select('*', 'academic_courses.id as id', 'academic_student_register_courses.created_at as register_date')
                        ->join('academic_courses', 'academic_courses.id', '=', 'course_id')->orderby('course_id')->get() }}</div>
          
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;">{{ $indexNum++  }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->name }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ optional($student->qualification)->name ?? '' }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->code }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->level->name ?? ''}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->division->name ?? ''}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->qualification_date }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ optional($student->constraint_status)->name ?? ''}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student->set_number }}</td>

             

            </tr>
          
            @endforeach

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

 @endforeach

