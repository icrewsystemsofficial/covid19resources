@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
#COVID19VerifiedResources #IndiaAgainstCOVID <br>
© {{ date('Y') }} {{ config('app.name') }}. Developed by <a href="https://icrewsystems.com?ref={{ config('app.name') }}">icrewsystems</a>.
@endcomponent
@endslot
@endcomponent
