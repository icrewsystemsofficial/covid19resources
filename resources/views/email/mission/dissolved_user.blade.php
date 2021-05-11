@component('mail::message')
# Is everything okay {{ $data['name'] }}?

This is to inform you that, we had to dissolve <b>Mission #{{ $data['mission']['id'] }}</b>, because
you did not commence the mission. This is a very important issue, missions have to be carried out
on the same day they're assigned. We have reduced <b>50 points</b> from your account. You're left with
{{ $data['points'] }} points.

@component('mail::button', ['url' => route('home.mission.index')])
My Missions
@endcomponent

We understand these are tough times, but we have a mission and we must be focused on it. It's our sincerest request, if you're unable to carry out the assigned mission(s), please relieve yourself from that mission and request to be reassigned.
Contact Mr. Dhruv or Ms. Tushara to get your mission re-assigned.


<small>
    Thanks,<br>
    {{ config('app.name') }}
</small>
@endcomponent
