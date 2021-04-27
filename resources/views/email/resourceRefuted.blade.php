@component('mail::message')
# Resource Reported

A resource had been marked as refuted.

@component('mail::panel')
Reported By: {{ $details['reported_by'] }}
<br>
Resource: {{ $details['resource'] }}
<br>
Reason : @if ($details['reason'] == 1)
    <p>Tried to reach out to the resource, no response</p>
@elseif($details['reason'] == 2)
    <p>The resource is unavailable now</p>
@elseif($details['reason'] == 3)
 <p>The data is incorrect / inaccurate</p>
@elseif($details['reason'] == 4)
    <p>Others</p>
    {{ $details['comment'] }}
@endif

@endcomponent

@component('mail::button', ['url' => $redirect_url, 'color' => 'primary'])
Visit Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
