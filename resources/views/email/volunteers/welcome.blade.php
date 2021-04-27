@component('mail::message')
# Hey {{ $user['name'] }} 👋

We're thankful that you chose to signup as a volunteer at {{ config('app.name') }}.
Your one step to help is one giant leap in India's fight against the deadly virus. In a way, you're a
warrior.

<br>

Our team has already been notified of your arrival. We have formed a telegram group, link to it is attached below,
please join the group. The group will be the center of all communications, planning & coordination of missions & various
other details.

<br>

Before you start, there's a couple of things we'd like you to know.
The main reason why developed this tool is, there was lack of compiled data.
We've designed this tool to match with the professional standards. <br><br>

The tool has a service container called "TwitterScanner" which is running 24/7, which is monitoring
Twitter for the keywords @php
$keywords = config('app.tweet_keywords');
$string = '';
$i = 0;
foreach($keywords as $keyword) {


    if($i != 0) {
        $string .= ' ';
    }

    $string .= $keyword;
    $i++;
}
@endphp {{ $string }}. This process is instantaneous, the moment a person tweets any kind of information with
the above mentioned keywords, it's automatically fetched and stored by the tool. From there on, the data (tweet) undergoes
multiple levels of screening & filteration. To put things into perspective, we collected a total of 60,000 tweets during development
and testing, but only 7000 odd tweets were actual leads to resources. Rest were either duplicates (re-tweets) or abusive
tweets (which serve no purpose for us).

<br>

You'll be assigned missions (missions? Yes, you're considered a warrior, and hence the apt name) on a daily basis,
you'll be given a certain number of data to verify. There is also a seperate service container that
keeps assigning missions to our network of volunteers as the tweets come in. <br><br>

To summarize, as a volunteer, your duty would be to
@component('mail::panel')
1. Carry out as many missions as possible: by veryfing as much as the assigned tweets / resources.
2. Share about this tool as much as possible with your friend & family network.
3. Add more information about verified resources you get from other sources.
@endcomponent

<br>
"Even if we can save 1 life from the resources we provide to people, our efforts will
live in every breath that person takes"
<br>
@component('mail::button', ['url' => route('login'), 'color' => 'success'])
    Login to the {{ config('app.name') }}
@endcomponent

@component('mail::button', ['url' => 'https://t.me/joinchat/J4WYVexthVA2NGI1', 'color' => 'primary'])
    Join telegram group
@endcomponent

<br>
Remember, someone out there, who's battling to find resources at the hour of need...
will find what they're looking for & have a better chance of survival, because of your efforts.

<br><br>
Looking forward,<br>
Leonard
@endcomponent
