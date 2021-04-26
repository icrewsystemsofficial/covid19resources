@component('mail::message')
# {{ $name }}

Thank you for signing up with {{ config('app.name') }}. We are all connected together, as ONE NATION in war against the deadly Novel Corona Virus. 

This app is to be used by 
@component('mail::panel')
1. The people who provide help or information regarding resources

2. The people who require that help or information

3. The volunteers who verify the facts and keep the database updated.
@endcomponent

@component('mail::button', ['url' => $redirect_url, 'color' => 'primary'])
Let's fight this COVID19 together
@endcomponent

Thank You,<br>
Fellow Citizens
@endcomponent