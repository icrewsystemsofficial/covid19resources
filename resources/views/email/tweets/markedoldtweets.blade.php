@component('mail::message')
# Hey {{ $user }}

Command <b>`php artisan twitter:clear-old`</b> was executed. <br>

The site marked {{ $total }} screened tweets older than {{ $date }} as "OLD", these tweets
will that were assigned to missions, will be decomissioned.

@component('mail::button', ['url' => route('admin.twitter.index')])
    View
@endcomponent

<small>
    Thanks,<br>
    {{ config('app.name') }} Bot
</small>
@endcomponent
