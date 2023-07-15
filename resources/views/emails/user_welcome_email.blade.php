<x-mail::message>    {{-- markdown -> مصطلح يطلق على الواجهة التصميمية
    الخاصة بالإيميل المرسل--}}
# Ucas system

welcome  {{$order->title}}

<x-mail::panel>
your  <b>email</b>  is {{$order->student_email}}
</x-mail::panel>



<x-mail::panel>
your <b>response </b> from us is  :  <br> <br>  {{$order->response}}
</x-mail::panel>



<x-mail::button :url="'http://127.0.0.1:8000/admins'">
user page
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
