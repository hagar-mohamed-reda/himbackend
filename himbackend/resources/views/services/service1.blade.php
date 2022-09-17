<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة قيد</title>

    @include("services.header")
</head>
<style>

</style>
<body>
    <!-- شهادة قيد -->
    <header style="height: 230px;"></header>
    <div class="container" style="position: relative;">
        <img src="{{ $student->personal_photo_url }}" style="position: absolute; left: 5px; top: 10px; width: 100px; height: 100px;" alt="">
        <div class="text-center">
            <h1 style="text-decoration: underline; font-weight: bold;">شهادة قيد</h1>
            <p>يشهد المعهد العالي للعلوم الإدارية ببني سويف</p>
            <div class="row">
                <p class="col-md-6 col-sm-6 col-xs-6  col-xs-6  col-lg-6">كود / {{ $student->code }}</p>
                <p class="col-md-6 col-sm-6 col-xs-6  col-lg-6">بان الطالب /  {{ $student->name }}   </p>
            </div>
            <div class="row">
                <p class="col-md-4 col-sm-4 col-xs-4  col-xs-4  col-lg-4">تاريخ الميلاد / {{ $student->birthdate }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">وجنسيته / {{ optional($student->nationality())->name }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">محل الميلاد /  {{ optional($student->nationalIdPlace())->name }}</p>
            </div>
            <div class="row">
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">للعام / {{ optional($student->academicYear())->name }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">كيفية الالتحاق / {{ optional($student->registerationStatus())->name }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">رقم قومي / {{ $student->national_id }}</p>
            </div>
            <div class="row">
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">للعم الدراسي / {{ optional($student->academicYear())->name }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">الشعبة / {{ optional($student->division())->name }}</p>
                <p class="col-md-4 col-sm-4 col-xs-4  col-lg-4">مقيد بالمستوى / {{ optional($student->level())->name }}</p>
            </div>
            <div class="row">
                <p class="col-md-6 col-sm-6 col-xs-6  col-lg-6">حالة القيد / {{ optional($student->constraint_status())->name }}</p>
                <p class="col-md-6 col-sm-6 col-xs-6  col-lg-6">ويحمل بطاقة الخدمة العسكرية رقم / {{ $student->triple_number }}</p>
            </div>
                <p class="col-md-6 col-sm-6 col-xs-6  col-lg-6">بتاريخ / {{ $student->qualification_date }}</p>
                <p class="col-md-6 col-sm-6 col-xs-6  col-lg-6">علما بان الطالب مؤجل له التجنيد لسن 28 سنة وبالقرار رقم / {{ $student->triple_number }}</p>
            </div>
            <br>
            <div>
                <p>علما بان الطالب قد الجتاز({{ optional($student->toAcademicStudent())->register_hours }})ساعة بنجاح</p>
                <p>وقد اعطيت هذه الشهادة بناء على طلبه لتقديمها الي / مصلحة الجوازات ب{{ optional($student->nationality())->name }}</p>
            </div>
            <div class="row">
                <p class="text-center">وتفضلوا بقبول وافر التحيه والاحترام</p>
                <div class="col-md-4 col-sm-4 col-xs-4  col-lg-4">
                    <p>عميد المعهد</p>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-4  col-lg-4">
                    <p>مدير شئون الطلاب</p>
                    <p>ا/عماد طلعت نجيب</p>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-4  col-lg-4">
                    <p>الموظف المختص</p>
                    <p>محمد عصام عبدالفتاح</p>
                </div>

            </div>

        </div>
    </div>
    <footer style="height: 100px;"></footer>

    @include("services.footer")


    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>
