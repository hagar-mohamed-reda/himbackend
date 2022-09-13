<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خطاب طلب ملف تحويل</title>

    @include("services.header")
</head>
<body>
    <header style="height: 200px;"></header>

    <div class="container">
        <h4>السيد الاستاذ الدكتور عميد /...</h4>
        <h4 class="text-center">تحية طيبة وبعد</h4>
        <h4>بالاشارة الي خطاب الادارة العامة للمعاهد العليا الخاصة المؤرخ ف :{{ date('Y-m-d') }} م في شأن الموافقة على تحويل الطالب : {{ $student->name }}</h4>
        <h4>من معهدكم الى معهدنا : المعهد العالي للعلوم الإدارية ببني سويف</h4>
        <h4>يرجى التفضل موافقتنا بملف الطالب المذكور وتسليمه له باليد حتى يمكن اسبيفاء اجرائات القيد بالمعهد</h4>
        <h4>وتفضلوا سيادتكم بقبول وافر الاحترام</h4>

        <div class="row text-left">
            <p>يعتمد</p>

            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                <p>عميد المعهد</p>
                <p>ا.د/احمد ابو القمصان</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
                <p>مدير شئون الطلاب</p>
                <p>ا/عماد طلعت نجيب</p>
            </div>
                <p>الموظف المختص</p>
                <p>احمد جابر سليم</p>
            </div>
        </div>
    </div>

    @include("services.footer")


    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>
