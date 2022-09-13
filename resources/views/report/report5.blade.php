
<style>
    @media print {
        #printCount{
            display: none !important;
        }
    }
</style>
 <div style="display:none !important; ">{{ $index = 1 }}</div>
    @foreach($students->chunk(12) as $chunk)


<div class="container" style=''>
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <h4 id='printCount' style='color: green;display: inline-block;'>العدد : {{ $students->count() }}<h4>
            <img src="{{url('/logo.png')}}" width="100px" style="margin: auto;display: inline-block;" >
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center">
                 سجل شئون الطلاب المستوى  {{  $level->name }}  - تخصص : {{ $division->name  }}  
            </div>
            <div class="text-center">
                العام الدراسي 2021 / 2022
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <br>
            <br>
            <div class="text-center">
                 المعهد العالي  للإدارة بالمحلة الكبري
            </div>
        </div>
    </div>
    <table class="table table-bordered" style='min-height: 1192px !important;max-height: 1194px !important;'>
        <thead>
            <tr>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">م</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">كود الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">اسم الطالب</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;"> الديانة</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">الجنسية </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">تاريخ الميلاد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">محل الميلاد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">المؤهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">سنة المؤهل</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">المجموع</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">تاريخ الالتحاق</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">نوع القبول</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">رقم الموافقة</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">تاريخ الموافقة</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">حالة القيد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">العنوان</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">المحافظة</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">رقم التليفون </td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">وظيفة ولي الامر</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">الرقم القومي</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">الموقف من التجنيد</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">صورة الطلاب</td>
            </tr>
        </thead>
        <tbody style=''>
                   
            @foreach($chunk as $student)
            <tr>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $index++ }}</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->code }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;"> {{ $student->name }}  </td>
                @if($student->religion == "muslim")
                    <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">مسلم</td>
                @elseif($student->religion == "christian")
                     <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">مسيحي</td>
                @else <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;"></td> @endif
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->nationality->name ?? '' }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->birthdate }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->birth_address }}</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ optional($student->qualification)->name }}</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->qualification_date }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->grade }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->registeration_date }}</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ optional($student->registerationStatus)->name }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->acceptance_code }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->acceptance_date }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->case_constraint->name ?? '' }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->address }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->government->name ?? '' }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->phone_1 }}</td>
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ optional($student->parentJob)->name }}</td>
                 <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->national_id }}</td>
                <!--<td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->triple_number }}</td>-->
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ optional($student->militaryStatus)->name }}</td>
                <!--<td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">{{ $student->military_date }}</td>-->
                <td style="padding: 1px!important;text-align: center !important;vertical-align: middle !important;border: 1px solid black !important;">
                    <img src="{{ $student->personal_photo_url }}" class="w3-round" style="width: 40px" alt="">
                </td>
     
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="text-center">
        <p>بان الاسماء عاليه موجودة بالمعهد ومقيدة بالعام الجامعي   2021 / 2022</p>
    </div>
    <div class="row text-left" style='direction: ltr !important; margin-left: 30px; margin-bottom:20px;'>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" >
            <p>يعتمد....</p>
            <p>عميد المعهد</p>
            <!--<p>ا.د/ محمد حسين معبد </p>-->
        </div>
        <!--<div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">-->
        <!--    <p>وهذا اقرار مني بذلك</p>-->
        <!--    <p>رئيس شئون الطلاب</p>-->
        <!--    <p>  </p>-->
        <!--</div>-->
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p>مدير شئون الطلاب</p>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
            <p>اخصائي شئون الطلاب</p>
        </div>
    </div>
</div>

    @endforeach

