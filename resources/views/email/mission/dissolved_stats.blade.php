@component('mail::message')
# Hey {{ $data['name'] }}

This is to inform you that we have dissolved {{ $data['total'] }} missions today :( <br>
The list of defaulters are as follows:

@component('mail::panel')
    @php
        $i = 0;
    @endphp
    @foreach ($data['defaulters'] as $user)
        @php
            $i++;
        @endphp
        {{ $i }}.) {{ $user }} <br>
    @endforeach
@endcomponent

@component('mail::button', ['url' => route('admin.mission.assign')])
Assign new missions
@endcomponent

The recipients of the defaulters list have already been emailed about this & 50 points were reduced from their account. Please
give them an extensive de-brief.

<small>
    Thanks,<br>
    {{ config('app.name') }}
</small>
@endcomponent
