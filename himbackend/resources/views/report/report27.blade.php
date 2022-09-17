

  <div style="display:none">  <?php $studentChunk = $responses; ?> </div>
  <div style="display:none">  <?php $indexNum = 1; ?> </div>
    


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
                 تقرير حالات القيد  
            </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:14px !important;'>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>المستوي : {{$level->name ?? ''}}</span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'> تخصص :  {{$division->name ?? ''}}</span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'> السنة :  {{$academicYear->name ?? ''}}</span>
                <span style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;padding: 3px !important;margin: 3px !important;display: inline-block !important;'>الترم : {{$term->name ?? ''}}</span>
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
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;height: 43px !important;"> حالة القيد</td>


            </tr>
        </thead>
        <tbody>
            @foreach($studentChunk as $student)
            

            <div style="display:none"></div>
          
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;width: 43px !important;">{{ $indexNum++  }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student['student']['name'] }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student['student']['code'] }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:14px !important;height: 43px !important;">{{ $student['caseConstraint']['name'] }}</td>

             

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


