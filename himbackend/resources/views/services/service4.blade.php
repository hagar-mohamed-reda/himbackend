<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قبول التحاق</title>

    @include("services.header")

</head>
<body>
    <header style="height: 30px;"></header>
    <div class="container">
        <div class="text-right">
            <h2>السيد الاستاذ / رئيس الإدارة المركزية بالتعليم العالي </h2>
        </div>
        <h3 class="text-center">تحية طيبة وبعد...</h3>
        <div>
            <h3>اقر انا الطالب / {{ $student->name }}</h3>
            <h3>بانني لم اقيد أو التحق بأي جهة تعليمية للعام الدراسي {{ optional($student->academicYear())->name }} وارجو من سيادتكم</h3>
            <h3>قبول التحاقي بالمعهد العالي للعلوم الإدارية ببني سويف للعام الدراسي{{ optional($student->academicYear())->name }}  </h3>
            <h3>والذي يقبل مجموعي من مؤهل {{ optional($student->qualification())->name }}</h3>
        </div>
        <div class="text-center">
            <h2>وهذا اقرار مني بذلك</h2>
            <h2>وتفضلوا بقبول وافر التحية والاحترام</h2>
        </div>

        <div class="text-left">
            <h3>الاسم / ...................</h3>
            <h3>التوقيع / .................</h3>
        </div>
    </div>



    @include("services.footer")
</body>
</html>
