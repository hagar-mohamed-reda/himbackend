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
                <td>الخدمة</td>
                <td>القيمة</td>
                <td>تاريخ الدفع</td>
            </tr>
        </thead>
        <tbody>
            @isset($payments_data[0])

                @foreach ($payments_data[0] as $payment)
                    <tr>
                        <td>{{ optional($payment->student)->name }}</td>
                        <td>{{ optional($payment->model_object)->name }}</td>
                        <td>{{ $payment->value }}</td>
                        <td>{{ Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            @endisset

        </tbody>
    </table>

</div>
