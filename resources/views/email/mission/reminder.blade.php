@component('mail::message')
@php
    $user = (object) $user;
    $missions = (object) $missions;
@endphp
# Hey {{ $user->name }},

This is a VERY important reminder. You have {{ count($missions) }} missions pending.

@component('mail::panel')
    @php
        $i = 0;
    @endphp
    @foreach ($missions as $mission)
    @php
        $total = 0;
        $completed = 0;
        $total = $total + $mission->total;
        $completed = $completed + $mission->completed;
        $i++;
    @endphp
        {{ $i }}). Mission {{ $mission->id }} - <b>{{ $mission->getStatus()->name }}</b> {{ $completed }} / {{ $total }} completed, activity: {{ $mission->updated_at->diffForHumans() }}
        <br>
    @endforeach
@endcomponent

@component('mail::button', ['url' => route('home.mission.index'), 'color' => 'primary'])
    View Missions
@endcomponent

If you're unable to complete the mission(s), please relieve yourself from that mission and request to be reassigned.
Contact Mr. Dhruv or Ms. Tushara to get your mission reassigned.

<br>
The availability span for each tweet is just 1 hour from the time of broadcasting. If you delay,
then a genuinely available resource might go to waste.

<br><br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
