@component('mail::message')
# Hey {{ $user->name }},

A new mission has been assigned to you. More details about the mission are given below.
@component('mail::panel')
<strong>Mission #</strong> {{ $mission->id }}
<br>
<strong>Objective</strong> {{ $mission->description }}
<br>
<strong>Type</strong> @if($mission->type == 0) Twitter Verification @else Resource Verification @endif
@endcomponent

@component('mail::button', ['url' => route('home.mission.view', $mission->uuid), 'color' => 'primary'])
Take a look
@endcomponent

Once again, we thank you for stepping up and volunteering at these difficult times.
As soon as you complete this mission, 10000 points will be credited to your account.
<br><br>
Thank You,<br>
{{ config('app.name') }}
@endcomponent
