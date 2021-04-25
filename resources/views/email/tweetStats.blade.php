@component('mail::message')
# Twitter Stats

@component('mail::panel')   
1. Total Tweets = {{ $tweet_stats['total'] }}
2. Total Resources = {{ $tweet_stats['converted'] }}
3. Total Users = {{ $tweet_stats['users'] }}
4. Total Screened Tweets = {{ $tweet_stats['6']['count'] }}
@endcomponent

@component('mail::button', ['url' => $redirect_url, 'color' => 'primary'])
Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
