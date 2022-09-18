<div class="container">
    <div class="row" style='direction: ltr !important;'>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <img src="{{ asset('assets/img/logo.png') }}" width="100px" style="margin: auto">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <br>
            <br>
            <div class="text-center"
                style='font-weight: bolder !important;font-size:14px !important;background-color: #d4d4d4 !important;border: 1px solid black;'>
                كشوف خدمات الطالب
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
                <td>اسم الطالب</td>
                <td>المادة</td>
                <td>التخصص</td>
                <td>درجات اعمال السنة</td>
                <td>درجات التحريري</td>
                <td>درجات العملي</td>
                <td>درجات الميدتيرم</td>
                <td>الدرجة النهائية</td>
            </tr>
        </thead>
        <tbody>
            @isset($results)

                @foreach ($results as $result)
                    <tr>
                        <td>{{ optional($result->student)->name }}</td>
                        <td>{{ optional($result->course)->name }}</td>
                        <td>{{ optional($result->student->division)->name }}</td>
                        <td>{{ $result->work_year_degree }}</td>
                        <td>{{ $result->final_tahrery_degree }}</td>
                        <td>{{ $result->amly_degree }}</td>
                        <td>{{ $result->mid_degree }}</td>
                        <td>{{ $result->final_degree }}</td>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>

</div>