@component('mail::message')
# Resource Reported

A resource had been marked as refuted captain.

@component('mail::button', ['url' => $redirect_url, 'color' => 'primary'])
Visit Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
