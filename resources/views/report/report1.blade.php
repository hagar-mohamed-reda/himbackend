


 @foreach($commissions as $commission)

  <div style="display:none">  <?php $studentQuery = Modules\Student\Entities\Student::where('commission_id',$commission->id)
                                    ->where('set_number','!=' , null)->orderBy('set_number')->get() ?> </div>
                                    
           <div style="display:none"> {{ $theater = Modules\Student\Entities\Theater::findorfail($commission->theater_id) }}</div>


        <div class="container" style="min-height:100vh !important;padding: 0px !important;margin: 0px !important; ">
            <div class="row" style='direction: ltr !important;'>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <img src="{{url('/logo.png')}}" width="100px" style="margin: auto" >
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <br>
                    <br>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                         وزارة التعليم العالي<br>
                         المعهد العالي  للإدارة بالمحلة الكبري
                    </div>
                    <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
اسماء و ارقام جلوس الطلاب                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <br>
                    <br>
                                        <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                        {{ $term->name ?? ''}}   {{ $year->name ?? ''}} 
                    </div>
<div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'> {{ $commission->name ?? '' }}   &nbsp;&nbsp;   {{ $theater->name ?? '' }}   </div>
                </div>
                <div class="text-center" style='font-weight: bolder !important;font-size:12.5px !important;'>
                        المستوي : {{$level->name ?? '' }}    &nbsp;&nbsp;    
                        التخصص : {{ $division->name ?? '' }}            

                     </div>
            </div>
        
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;"> م</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">رقم الجلوس </td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">اسم الطالب</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;">  الفرقة</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;background-color: #d4d4d4 !important;"> التخصص </td>
        
                </thead>
                <tbody>
                    @foreach($studentQuery as $student)
        
                    <tr>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;"> {{ $loop->iteration }}  </td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->set_number }}</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->name }}</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->level->name ?? ''}}</td>
                        <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;font-weight: bolder !important;font-size:12.5px !important;">{{ $student->division->name ?? ''}}</td>
        
                    </tr>
                    @endforeach
        
                </tbody>
            </table class="table table-bordered">
            <br>
          
        </div>
        
    @endforeach
        
