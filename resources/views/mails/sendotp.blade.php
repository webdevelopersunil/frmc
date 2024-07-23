<x-mail::message>
# Frmc Portal — OTP to login to your portal account .

<h3>Your OTP for registration is: {{ $otp }}</h3>

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

Regards,
{{ config('app.name') }}
</x-mail::message>
 