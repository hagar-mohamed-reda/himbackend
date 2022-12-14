

  <div style="display:none">  <?php $studentQuery = $students ; ?> </div>
  <div style="display:none">  <?php $studentChunk = $studentQuery->chunk(20); ?> </div>
  <div style="display:none">  <?php $index = 1; ?> </div>

 @foreach($studentChunk as $chunk)


<div class="container" style="min-height:100vh !important;padding: 0px !important;margin: 0px !important; ">
    <div class="row" style='direction: ltr !important; margin-bottom:10px'>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <img src="{{url('/logo.png')}}" width="100px" style="margin: auto" >
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:21 !important;'>سجل تجنيد المستوي {{optional($level)->name}} </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:21 !important;'>تحية طيبة وبعد</div>
            <div class="text-center" style='font-weight: bolder !important;font-size:21 !important;'>
                نتشرف بأن نرسل لسيادتكم رفق هذا نماذج ( 2 جند ) بطلاب المستوي ( {{optional($level)->name}} ) في
                العام الدراسي 2021 / 2022
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:21 !important;'>
                وزارة التعليم العالي<br>
                 المعهد العالي  للإدارة بالمحلة الكبري
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">م</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">اسم الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">تاريخ الميلاد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">بطاقة شخصية</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">الرقم الثلاثي</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">المؤهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">المستوي</td>
                
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">قرار التجنيد</td>
            </tr>
        </thead>
        <tbody>
            @foreach($chunk as $student)
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ $index++ }}</div>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ $student->name }}  </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->birthdate }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->national_id }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->triple_number }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ optional($student->qualification)->name }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ optional($student->level)->name }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->military_number_code }}</td>
            </tr>
            @endforeach

        </tbody>
    </table class="table table-bordered">
    <div class="row text-center">
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:21x !important;'>عميد المعهد </p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:21x !important;'> مسئول شئون طلاب </p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:21x !important;'>مسئول تجنيد </p>
        </div>
      
    </div>
</div>


 @endforeach
 

