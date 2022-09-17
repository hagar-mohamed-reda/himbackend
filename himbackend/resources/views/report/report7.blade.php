

 @foreach($commissions as $commission)
 
            <div style="display:none"> {{  $studentQuery = DB::table('students')
            ->select("*")
            ->join('academic_student_register_courses', 'academic_student_register_courses.student_id', '=', 'students.id')
            ->where('academic_student_register_courses.term_id',$term->id)
            ->where('academic_student_register_courses.course_id',$course->id)
            ->where('students.division_id', $division->id)->where('commission_id',$commission->id)->orderBy('set_number')->get() 
            
          
            }}</div>      
            
       <div style="display:none"> {{ $theater = Modules\Student\Entities\Theater::findorfail($commission->theater_id) }}</div>
    
    @if(!$studentQuery->isEmpty())


        <div class="container" style="min-height:100vh !important;padding: 0px !important;margin: 0px !important; ">
            <div class="row" style='direction: ltr !important;'>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <img src="{{url('/logo.png')}}" width="100px" style="margin: auto" >
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <br>
                        <br>
                        <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                            كشوف توقيعات الطلاب
                        </div>

                      <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                        التاريخ : {{$course->exam_date ?? '' }}
                      </div>
                     <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                        المستوي : {{$level->name ?? '' }}                  
                     </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <br>
                    <br>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                         وزارة التعليم العالي<br>
                         المعهد العالي  للإدارة بالمحلة الكبري
                    </div>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                      {{ $year->name ?? ''}} العام الدراسي  
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <br>
                    <br>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                        اسم المادة : {{$course->name ?? '' }}                 
                    </div>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                           التخصص : {{ $division->name ?? '' }}            
                    </div>
                <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'> {{ $commission->name ?? ''}}   &nbsp;&nbsp;  {{ $theater->name ?? ''}}</div>
                    </div>
                 </div>
        
            <table class="table table-bordered" id="printable">
                <thead>
                    <tr>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;"> م</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">رقم الجلوس </td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">اسم الطالب</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;"> التوقيع بالحضور</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;"> التوقيع بالانصراف</td>
        
                </thead>
                <tbody>
                    @foreach($studentQuery as $student)
        
                    <tr>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ $loop->iteration }}  </td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->set_number }}</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->name }}</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"></td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"></td>
        
                    </tr>
                    @endforeach
        
                </tbody>
            </table class="table table-bordered">
            <br>
            <div class="row text-center">
                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>حضور :</p>
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>غياب :</p>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>أخري : </p>
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>الجملة : </p>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>الملاحظون</p>
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>الأسم : </p>
                    <p style='font-weight: bolder !important;font-size:12.5px !important;'>التوقيع : </p>
                </div>
                
            </div>
        </div>
        
    @endif


 @endforeach

