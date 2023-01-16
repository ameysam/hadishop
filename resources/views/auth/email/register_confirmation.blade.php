@component('mail::message')
# تکمیل ثبت نام

برای تکمیل ثبت نام خود روی لینک زیر کلیک کنید.

@component('mail::button', ['url' => $url, 'color' => 'success'])
تکمیل ثبت نام
@endcomponent

با تشکر<br>
{{ config('app.name') }}
@endcomponent
