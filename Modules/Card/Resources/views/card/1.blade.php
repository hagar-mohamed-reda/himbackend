<html>

<head>


    <!-- Bootstrap Css Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <!-- Tajawal Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@800&display=swap" rel="stylesheet">


</head>


<!-- style Css Code -->
<style>
    * {
        font-family: 'Tajawal', sans-serif!important;
    }
    
    span {
        color: black;
    }
    
    h5 {
        font-size: 20px !important;
        font-weight:bolder !important;
	color:black !important;
    }
    
    h6 {
        font-size: 16px !important;
        font-weight:bolder !important;
	color:black !important;
    }
    
    .card-container {
        position: fixed;
        left: -58px;
        top: 75px;
    }
body{
padding:0px !important;
margin:0px !important;
background-image: url({{ url('/logo_t.png') }});
background-size: 100% 100%;;
}
</style>


<!-- End style Css Code -->

<body>

    <!-- Start Logo and Title -->
    <section id='idPrint' class="card-container" style="height: 330px !important;width: 450px !important;display: inline-block;transform: rotate(90deg);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 pr-0 pl-1">
                    <img src="{{ url('/logo.png') }}" width="100%" style="margin-top: 2rem;">
                    <img src="{{ $student->personal_photo_url }}" width="100%"  height='100px'>
                    <h6 style="padding:1px;font-size: 15px !important;color:white;background-color:#0e929f;margin-top:1px;"><a style="display: inherit;text-align: center;">عميد المعهد</a></h6>
                    <h6 style='font-size: 11.9px !important;line-height:0;width:115px;'><a style="display: inherit;text-align: center;line-height:0;">أ.د.أحمد أبو القمصان</a></h6>
		    <img src="{{ url('/amid.png') }}" width="100%" height='36px' >

                </div>
                <div class="col-9" style="text-align: right;">
                    <h6 style="margin-top: 4rem;font-size: 17px !important;">وزارة التعليم العالي<br>المعهد العالي للإدارة<br><span class="mr-3" style="display: block;"> بالمحلة الكبري</span></h6>
                    @if(  strlen($student->name) >= 35 )
                        <h6 class="mt-3" style='font-size: 13.9px !important;'>الإسم :  {{ $student->name }}</h6>
                    @else
                        <h6 class="mt-3">الإسم :  {{ $student->name }}</h6>
                    @endif
                    <h6 class="mt-3" >المستوي : {{ optional($student->level)->name }}</h6>
                    <h6 class="mt-3" >الكود : {{ $student->code }}</h6>
                    <h6 class="mt-3" >الشعبة : {{ optional($student->division)->name }}</h6>
                    <h6 class="mt-3" >العام الدراسي : 2021 / 2022</h6>	
                </div>
            </div>

        </div>
    </section>



    <!-- Bootstrap js Links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>