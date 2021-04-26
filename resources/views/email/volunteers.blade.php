@component('mail::message')
# Hello {{ $name }}

Welcome and thank you for signing up to volunteer for  {{ config('app.name') }}. As one united nation, we are in the struggle together against COVID-19. Your one step to help is one giant leap in India's fight against COVID!



@component('mail::panel')
Our mission is to provide COVID-19 resources along with verified statistics & logistics of the virus in India. However, with one of the largest populations in the world, obtaining validated information can be remarkably difficult. That's where you help us! By volunteering to confirm COVID-19 data we receive, your actions could be the difference in saving somebody's life. 
@endcomponent

@component('mail::button', ['url' => $redirect_url, 'color' => 'primary'])
Let's work together to fight against & say bye to COVID-19! 
@endcomponent

Much Gratitude and Appreciation,<br>
Fellow Citizens of India
@endcomponent