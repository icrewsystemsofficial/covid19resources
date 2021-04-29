@component('mail::message')
# Hey {{ $user }},

This is to inform you that the command <br><br>
<strong>`php artisan scout:import`</strong> was executed today at <strong>{{ date('H:i A, d/m/Y') }}<br></strong>
<br> for all the specified models were carried out.
The <strong>Algolia search index</strong> must now be updated.
The current searchable contents across the database are as follows:
@component('mail::panel')
<strong>Tweets: </strong> {{ $tweets }} <br>
<strong>Resources: </strong> {{ $resources }}
@endcomponent
Please update this on our social media.
@component('mail::button', ['url' => route('home.search'), 'color' => 'primary'])
Go Search
@endcomponent
<br>
Thank You,<br>
{{ config('app.name')}} Bot
@endcomponent
