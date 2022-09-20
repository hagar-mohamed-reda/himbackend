

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
            @foreach($courses as $index => $course)
            <div style="display:none"> {{ $registerStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->count() }}  </div>
            <div style="display:none"> {{ $presentStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa_word','!=','AB')->count() }}  </div>
            <div style="display:none"> {{ $absenceStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa_word','=','AB')->count() }}  </div>
            <div style="display:none"> {{ $successStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa', '>', 1)->count() }}  </div>
            <div style="display:none"> {{ $failedStudents = Modules\Academic\Entities\StudentRegisterCourse::where('course_id',$course->id)->where('academic_year_id',$academic_year_id)->where('term_id', $term_id)->where('gpa', '=', 'F')->count() }}  </div>
            @if($presentStudents != 0)
            <div style="display:none"> {{ $percentage = $successStudents / $presentStudents * 100 }}  </div>
            @else
            <div style="display:none"> {{ $percentage = 0 }} </div>
            @endif
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;">{{ $index  }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $course->name}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $registerStudents}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $presentStudents}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $absenceStudents}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $successStudents}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $failedStudents}}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ round($percentage, 2)}} %</td>



             

            </tr>
          
            @endforeach

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


