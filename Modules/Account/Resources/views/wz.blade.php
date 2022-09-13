<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <link rel="stylesheet" href="{{ url('/css/w3.css') }}">
<title>ايصال رقم {{ $payment->id }}</title>

<style>
* {
    font-family: 'Arial', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: bold;
}
    @php
        $cm = 34;
        $diff = 20;
        $rcm = 29;
    @endphp

    .right-corner {
        position: fixed;
        right: 0px;
        padding-right: 96px;
        width: 50%;
        height: auto; 
    }
    
    .right-corner1 {
        top: {{ $cm * 2.1 }}px; 
    }
    
    .right-corner2 {
        top: {{ ($cm * 3.1) }}px; 
    }
    
    .right-corner3 {
        top: {{ ($cm * 4.5) }}px; 
    }
    
    .right-corner4 {
        top: {{ ($cm * 5.7) }}px; 
    }
    
    .right-corner5 {
        top: {{ ($cm * 6.7) }}px;
    }
    
    .right-corner6 {
        top: {{ ($cm * 7.8) }}px; 
    }
    
    .right-corner7 {
        top: {{ ($cm * 0.9) }}px; 
        right: {{ $rcm * 18 }}px;
    }
    
    .right-corner8 {
        top: {{ ($cm * 3.0) }}px; 
        right: {{ $rcm * 18.3 }}px;
    }
    
    .right-corner9 {
        top: {{ ($cm * 3.0) }}px; 
        right: {{ $rcm * 16.8 }}px;
    }
    
    .right-corner10 {
        top: {{ ($cm * 3.2) }}px; 
        right: {{ $rcm * 12.3 }}px;
    }
    
    .right-corner11 {
        top: {{ ($cm * 4.3) }}px; 
        right: {{ $rcm * 12.3 }}px;
    }
    
    .right-corner12 {
        top: {{ ($cm * 9.3) }}px; 
        right: {{ $rcm * 17.5 }}px;
    }
</style>
</head>
<body> 
        <div style="width: 100%;border-bottom: 1px solid black;" ></div>
    @php
        $copies = 1;
        $service = null;
        if ($payment->model_type == 'service')
            $service = \Modules\Account\Entities\Service::find($payment->model_id);

        if ($service) {
            if ($service->type == 'in')
                $copies = 2;
        }     @endphp
    @for($count = 0; $count < $copies; $count ++)
 <!--
        <div style="width: 100px;border-top: 2px solid black;position: fixed;top: 300px;left: 50%;" ></div>
        
        <div style="width: 100px;height: 100px;border-right: 2px solid black;position: fixed;top: 100px;right: 200px;" ></div>
     -->   
    <div style="padding: top: 65px;width: 100%;direction: rtl!important;"  >
        
        <!--
        <table  style="width: 100%;text-align: center" >
            <tr>
                <td style="width: 50%" >
                    <div style="text-align: center;font-size: 18px" >
                        <b>وزارة التعليم العالى</b>
                        <br>
                        <b>المعهد العالى للعلوم الادراية</b>
                        <br>
                        <b>ببنى سويف</b>
                    </div >
                </td>
                <td style="width: 50%" >
                <img src="{{ url('/logo.png') }}" width="80px" alt="">
                </td>
            </tr>
        </table> 
        -->
        
        <div > 
                <br>
                    @if ($count == 0)
                <div style="width: 100%;text-align: center;padding-top: 11.5px;display:none" >
                    <b style="font-size: 16px" ></b>

                        <span id="paymentId" >{{ $payment->id }}</span>
                </div>
                @else
                <br>
                @endif
                
                <div class="w3-row" >
                    
                    <div class="right-corner right-corner1"  >
                        {{ $payment->date }} 
                    </div>
                    
                    <div class="right-corner right-corner2"  >
                        {{ optional($payment->student)->name }}
                    </div> 
                    
                    <div class="right-corner right-corner3"  >
                         {{ optional(optional($payment->student)->level)->name }}
                    </div> 
                    
                    <div class="right-corner right-corner4"  >
                         <span class="payment-value" >{{ number_format($payment->value) }}</span> 
                    </div> 
                    
                    <div class="right-corner right-corner5"  >
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
                    </div>
                    
                    <div class="right-corner right-corner6"  >
                        {{ "---" }}
                    </div> 
                       
                    <div class="right-corner right-corner7"  >
                        {{ $payment->id }} 
                    </div>
                       
                    <div class="right-corner right-corner8"  >
                        <span class="payment-" >{{ number_format($payment->value) }}</span>  
                    </div> 
                       
                    <div class="right-corner right-corner9"  >
                        0
                    </div>  
                    
                       
                    <div class="right-corner right-corner10"  >
                        {{ optional($payment->student)->code }}
                    </div> 
                       
                    <div class="right-corner right-corner11"  >
                        {{ optional(optional($payment->student)->division)->name }}
                    </div> 
                       
                    <div class="right-corner right-corner12"  >
                        {{ optional($payment->user)->name }}
                    </div> 
                    
                </div>
                    
                    <!--
                <table  style="width: 100%;" >
                    <td style="width: 50%" >
                    <table  style="width: 100%;" >
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>تاريخ السداد :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                {{ $payment->date }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>وصلنــــا من :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                {{ optional($payment->student)->name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                                <b>المستــــــوى :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                                {{ optional(optional($payment->student)->level)->name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                               <b>مبلـغ وقــدره :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                               <span class="payment-value" >{{ number_format($payment->value) }}</span> جنيه
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                              <b>ســــــداد عن :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
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
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;padding: 5px" >
                                <b>ملاحظــــات :</b>
                            </td>
                            <td style="width: 60%;padding: 5px" >
                               {{ "" }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%" >
                        <table  style="width: 100%;" >
                            <tr >
                                <td colspan="2" style="width: 40%;padding: 5px" >
                                <div style="text-align: center" >
                                    <b>المبلغ</b>
                                    <br>
                                    <span class="payment-value" >{{ number_format($payment->value) }}</span>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;padding: 5px" >
                                <b>الكــود :</b>
                                </td>
                                <td style="width: 60%;padding: 5px" >
                                 {{ optional($payment->student)->code }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 40%;padding: 5px" >
                                    <b>الشعبه :</b>
                                </td>
                                <td style="width: 60%;padding: 5px" >
                                   {{ optional(optional($payment->student)->division)->name }}
                                </td>
                            </tr>
                        </table>
                </td>
            </table>
                <br>
                <table  style="width: 100%;" >
                    <tr>
                        <td style="width: 50%" ></td>
                        <td style="width: 50%;text-align: center";padding: 5px >
                                <div style="text-align: center" >
                                    <b>الخزنية</b>
                                    <br>
                                    {{ optional($payment->user)->name }}
                                </div>
                        </td>
                    </tr>
                </table>
                
                -->
    </div>
</div>
    <br>  
    @endfor

    <div class="w3-modal" style="display: block" id="printModal" >
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

    <script type="text/javascript" src="{{ url('/js/jquery-3.2.1.min.js') }}" ></script>
    <script type="text/javascript" src="{{ url('/js/tafgeetjs.min.js') }}" ></script>

    <script type="text/javascript"> 


        $('.payment-value').each(function(){
            var money = new Tafgeet($(this).text(), 'EGP').parse();
            money = money.toString().replace("مصري", "");
            money = money.toString().replace("جنيه", ""); 
            console.log(money);
            $(this).html(money);
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
