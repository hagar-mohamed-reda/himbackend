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
                كشوف تسجيلات الطلاب ({{ count($students->groupBy('student_id')) }})
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

    <table class="table table-bordered" id="">
        <thead>
            <tr>
                <td>اسم الطالب</td>
                <td>المادة</td>
                <td>التخصص</td>
                <td>المستوى</td>
                <td>التيرم</td>
            </tr>
        </thead>
        <tbody>
            @php
                $nextId = null;                
            @endphp

            @foreach ($students as $i => $std)

                @php
                $border = false;
                $id = $std->student->id;
                $nextId = $students[$i == count($students) - 1 ? count($students) - 1 :  $i + 1]->student->id;
                if($id != $nextId) $border = true;
                @endphp

                <tr style="border-bottom : {{$border ? '1.5px' : '0'}} solid">
                    <td>{{ optional($std->student)->name }}</td>
                    <td>{{ optional($std->course)->name }}</td>
                    <td>{{ optional($std->division)->name }}</td>
                    <td>{{ optional($std->level)->name }}</td>
                    <td>{{ optional($std->term)->name }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
<script>
    function toColor(num) {
        num >>>= 0;
        var b = num & 0xFF,
            g = (num & 0xFF00) >>> 8,
            r = (num & 0xFF0000) >>> 16,
            a = ((num & 0xFF000000) >>> 24) / 255;
        return "rgba(" + [r, g, b, a].join(",") + ")";
    }
</script>
