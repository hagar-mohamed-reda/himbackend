

 @foreach($birthAddresses as $birth_address)
 
  <div style="display:none">  <?php $studentQuery = $students->where('triple_number_order', $birth_address->triple_number_order); ?> </div>
  <div style="display:none">  <?php $studentChunk = $studentQuery->chunk(50); ?> </div>
    
 @foreach($studentChunk as $chunk)
 
   <div style="display:none">  <?php $std = Modules\Account\Entities\Student::where('triple_number_order',$birth_address->triple_number_order)->get(); ?> </div>

<div class="container" style="min-height:100vh !important;padding: 0px !important;margin: 0px !important;">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <img src="{{url('/logo.png')}}" width="100px" style="margin: auto" >
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                 حافظة التجنيد كشف - {{ $std[0]->national_id_place ?? '' }}
            </div>
            <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                العام الدراسي 2021 / 2022
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                 وزارة التعليم العالي<br>
                 المعهد العالي  للإدارة بالمحلة الكبري
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">اسم الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">تاريخ الميلاد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">محل الميلاد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">رقم البطاقة</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">جهة صدورها</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">الرقم الثلاثي</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">رقم قرار التجنيد</td>
            </tr>
        </thead>
        <tbody>
            @foreach($chunk as $student)
            <tr>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ $student->name }}  </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->birthdate }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->birth_address }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->national_id }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->national_id_place }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->triple_number }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->military_number_code }}</td>
            </tr>
            @endforeach

        </tbody>
    </table class="table table-bordered">
    <div class="text-center">
        <p style='font-weight: bolder !important;font-size:12.5px !important;'> أقر أنا / ............................................. بان الاسماء عاليه موجودة بالمعهد ومقيدة بالعام الجامعي    2021/2020 وهذا اقرار مني بذالك .</p>
    </div>
    <br>
    <div class="row text-center">
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:12.5px !important;'>عميد المعهد</p>
        </div>
        
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:12.5px !important;'>رئيس شئون الطلاب</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p style='font-weight: bolder !important;font-size:12.5px !important;'>مسئول التجنيد</p>
        </div>
        
    </div>
</div>


 @endforeach
 @endforeach

