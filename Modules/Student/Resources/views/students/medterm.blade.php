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
                تقرير الطلبه المتخلفه عن الميد تيرم
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
                <td>الكود</td>
                <td>المادة</td>
                <td>التخصص</td>
            </tr>
        </thead>
        <tbody>




            @if (count($results) == 0)
                <tr>
                    <td style="text-align: center;font-size : 30px" colspan="8">لا يوجد بيانات</td>
                </tr>
            @endif


            @foreach ($results as $result)
                @isset($result->student)
                    <tr>
                        <td>{{ optional($result->student)->name }}</td>
                        <td>{{ optional($result->student)->code }}</td>
                        <td>{{ optional($result->course)->name }}</td>
                        <td>
                            @isset($result->student)
                                {{ optional($result->student->division)->name }}
                            @endisset
                        </td>
                      
                    </tr>
                @endisset
            @endforeach

        </tbody>
    </table>

</div>
