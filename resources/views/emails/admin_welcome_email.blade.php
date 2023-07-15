<x-mail::message>    {{-- markdown -> مصطلح يطلق على الواجهة التصميمية
                                     الخاصة بالإيميل المرسل--}}
# Ucas system

welcome  {{$admin->name}}

<x-mail::panel>
your email is {{$admin->email}}
your email is {{$admin->password}}



</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/admins'">
Admin page
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>







