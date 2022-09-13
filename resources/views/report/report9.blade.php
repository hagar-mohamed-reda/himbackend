<html>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    
    
    

  
    <body>
        
        
                <center>
					<hr class="mg-b-10">
					<button id="print-order_number" class="btn btn-danger print-order_number" ><i class="mdi mdi-printer ml-1"></i> طباعة </button> 
				</center>
	    <div class="all">		
         <div class="w3-row" style="background-color: white;padding-bottom: 5px;">
            <!--<div class="w3-col s6" style="padding-top: 3px;">-->
            <!--    @foreach($student[0]['courses'] as $course)-->
            <!--        <div id="place" style=" margin: 1.5px 3px 0 0;-->
            <!--    text-align: start;-->
            <!--    border: 1px solid black;-->
            <!--    text-align: center;-->
            <!--    height: 27px;">-->
            <!--            <div id="place-style" style="display: flex;-->
            <!--    justify-content: space-between;">-->
            <!--                <div class="w3-col s2">-->
            <!--                    <h6 style="font-weight: bolder;-->
            <!--    font-size: 8px !important;">{{ $course->day ?? ''}}</h6>-->
            <!--                </div>-->
            <!--                <div class="w3-col s4 border" style="border-right: 1px solid black;-->
            <!--    border-left: 1px solid black;-->
            <!--    height: 26px;">-->
            <!--                    <h6 style="font-weight: bolder;font-size: 8px !important;">{{ $course->exam_date ?? ''}}</h6>-->
            <!--                </div>-->
            <!--                <div class="w3-col s6">-->
            <!--                    <h6 style="font-weight: bolder;font-size: 8px !important;">{{ $course->name ?? ''}}</h6>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
                    
            <!--    @endforeach-->
                
            <!--</div>-->
            <div class="w3-col s6" style="padding-left: 3px;padding-top: 4px;">
                <div style="text-align: center;">
                    <h6 style="font-weight: bolder;font-size: 8px !important;">وزارة التعليم العالي</h6>
                    <h6 style="font-weight: bolder;font-size: 8px !important;">المعهد التكنولوجي للتمريض ببني سويف</h6>
                    <h6 style="font-weight: bolder;font-size: 8px !important;">الفصل الدراسي الأول ۲۰۲۱/۲۰۲۲</h6>
                </div>
                <div class="w3-row">
                <!--    <div id="img" class="w3-col s3" style="  border: 1px solid black;-->
                <!--height: 120px;">-->
                <!--        <img src="{{ $student[0]->image }}" alt="" style=" width: 100%;-->
                <!--height: 100%;">-->
                <!--    </div>-->
                    <div id="seating_number" class="w3-col s12" style=" border: 1px solid black;
                        text-align: center;
                        height: 120px;">
                        <h6 style="font-weight: bolder;font-size: 8px !important;">رقم الجلوس</h6>
                        <h6 style="font-weight: bolder;font-size: 8px !important;">{{ $student[0]->set_number ?? ''}}</h6>
                        <hr style="border: 1px solid #8080809e;">
                        <h6 style="font-weight: bolder;font-size: 8px !important;">حالة القيد : مستجد</h6>
                        <h6 style="font-weight: bolder;font-size: 8px !important;">المستوي:{{ $student[0]->level->name ?? ''}} </h6>
                    </div>
        
                    <div id="name" class="w3-col s12" style="margin-top: 5px; margin: 1.5px 3px 0 0;
                text-align: start;
                border: 1px solid black;
                height: 27px;">
        
                        <h6 style='margin-right: 30px;font-weight: bolder;font-size: 8px !important;'>{{ $student[0]->name ?? ''}}</h6>
                    </div>
                    <div id="place" class="w3-col s12" style="margin-top: 5px;  margin: 1.5px 3px 0 0;
                text-align: start;
                border: 1px solid black;
                text-align: center;
                height: 27px;">
                        <div id="place-style" display: flex;
                justify-content: space-between;>
                            <div class="w3-col s6">
                                <h6 style="font-weight: bolder;font-size: 8px !important;">المدرج {{$student[0]->theater_id ?? ''}}</h6>
                            </div>
                            <div class="w3-col s6 border">
                                <h6 style="font-weight: bolder;font-size: 8px !important;">لجنة {{$student[0]->commission_id  ?? ''}}</h6>
                            </div>
                            <div class="w3-col s6 border">
                                <h6 style="font-weight: bolder;font-size: 8px !important;"> </h6>                   
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        
        </div>
     </div>  
     

 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>-->
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js.map"></script>-->
        <script>


        </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
     <script src="{{ asset('js/print.js') }}"></script>
    </body>
</html>			

		