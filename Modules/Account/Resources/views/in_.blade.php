
<html>

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <link rel="stylesheet" href="{{ url('/css/w3.css') }}">
<title>ايصال رقم {{ $payment->id }}</title>
    <!-- Bootstrap Css Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


</head>


<!-- style Css Code -->
<style>
    h4{
        margin-top: 2rem;
    }
    label{
        display: inherit;
        text-align: center !important;
        font-size: 1.5rem;
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2;
    }
    hr{
        margin-top: 3rem;
        border: 1px black solid;
        margin-bottom: 3rem;
    }
</style>
<!-- End style Css Code -->


<body>
    @for($count = 0; $count < 2; $count ++)
    <section class="p-5"  style="direction: rtl;text-align: right;padding-top: 10px!important">


    <!-- Title Center -->
    @if($count == 0)
    <br>
    <h3 style="text-align: center;margin-bottom: 2rem;"  >مسلسل : 
    <span id="paymentId" >{{ $payment->id }}</span>
    </h3>
    @endif
    <!-- End Title Center -->


    <!-- Content Information -->
    <div class="w3-row" style="text-align: left !important;direction: ltr !important;">
        <div class="form-group  w3-col l2 m2 s2">
            <label for="inputZip">جنية</label>

            <!-- Put Here variable for Price per pound In Value of Input -->
            <input value="{{ number_format($payment->value) }}"  type="text" class="form-control" id="inputZip" disabled>
            <!-- End Put Here variable for Price per pound In Value of Input -->


          </div>
          <div class="form-group w3-col l2 m2 s2">
            <label for="inputZip">قرش</label>

            <!-- Put Here variable for Price per krsh In Value of Input -->
            <input value="0" type="text" class="form-control" id="inputZip" disabled>
            <!-- End Put Here variable for Price per krsh In Value of Input -->


          </div>
    </div>
    <h4 style="display: inline;">كود الطالب : {{ optional($payment->student)->code }}</h4>
    <h4>استلمت من الطالب : {{ optional($payment->student)->name }}</h4>
    <h4>بالفرقة : {{ optional(optional($payment->student)->level)->name }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   {{ optional(optional($payment->student)->division)->name }}</h4>
    <h4>فقط وقدرة :  
    <span class="payment-value" >{{ number_format($payment->value) }}</span>
    </h4>
    <h4>وذلك قيمة : 

        @if ($payment->about)
                                    {{ $payment->about }}
                                @endif 

                                @if ($payment->model_type == 'old_academic_year_expense')
                                رسوم سابقة . {{ optional($payment->student)->old_balance_notes }}
                                @elseif($payment->model_type == 'service')
                                @php
                                    $service = \Modules\Account\Entities\Service::find($payment->model_id);

                                @endphp
                                خدمة {{ optional($service)->name }} - عدد النسخ {{ $payment->service_count }}
                                @elseif($payment->model_type == 'installment')
                                @php
                                    $installment = \Modules\Account\Entities\Installment::find($payment->installment_id);

                                @endphp
                                قسط
                                 ({{ optional($installment)->type == "new"? 'رسوم حاليه' : 'رسوم سابقه' . ' - ' . optional($payment->student)->old_balance_notes }})
                                @elseif($payment->model_type == 'refund')
                                @php
                                    $payment = \Modules\Account\Entities\Payment::find($payment->model_id);

                                @endphp
                                رد رسوم عن قسيمة رقم ({{ optional($payment)->id }}) 
                                @else 
                                 @if (!$payment->is_pr)
                                    {{ optional($payment->model_object)->name }}
                                @endif
                                @endif

    </h4>
    

    <h4>تحريرا في : {{ $payment->date }}</h4>
    <div class="row" style="text-align: left !important;direction: ltr !important;">
        <div class="form-group w3-col l5 m5 s5">
            <label for="inputZip">الخزينة</label>
            <h4 style="text-align: center;">{{ optional($payment->user)->name }}</h4>
          </div>
    </div>
    <!-- End Content Information -->



    <!-- Line befor Second Page -->
    
    @if($count == 0)
    <hr>
    @endif
    <!-- End Line befor Second Page -->
 
</section>
    @endfor

    <div class="w3-modal" style="display: block;z-index: 99999999999" id="printModal" >
        <div class="w3-modal-content w3-white w3-round w3-card w3-padding" style="direction: rlt" >
            <div class="w3-center"  style="direction: rtl" >
               <b> يتم طباعة الوصل برقم  : </b>
               <input type="number" class="w3-input" id="paymentIdInput" value="{{ $payment->id }}" >
            </div>
            <br>
            <div class="w3-center" >
                <button class="w3-button w3-indigo" onclick="printPage()" >طباعة</button>
            </div>
        </div>
    </div>
<!-- Bootstrap js Links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <script type="text/javascript" src="{{ url('/js/jquery-3.2.1.min.js') }}" ></script>
    <script type="text/javascript" src="{{ url('/js/tafgeetjs.min.js') }}" ></script>

    <script type="text/javascript"> 


        $('.payment-value').each(function(){
            $(this).html(new Tafgeet($(this).text(), 'EGP').parse());
        });  

        function toggleModal(action) {
            var modal = document.getElementById('printModal');

            modal.style.display = action=='show'? 'block' : 'none'; 
        }

        function printPage() {
            var id = document.getElementById('paymentIdInput').value;
            document.getElementById('paymentId').innerHTML = id;
            toggleModal('hide');
            window.print();
        }
 
        
    </script>

</body>

</html>