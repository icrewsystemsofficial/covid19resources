@extends('layouts.atlantis')
@section('title', 'About Us')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                    {{ config('app.name') }}
                </h1>
                <p class="text-white h4">
                    Who we are, what is our mission
                </p>
            </div>

        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">


                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>1. How does this site work?</strong>
                        </h1>
                        @php
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
                        @endphp

                        <ul class="ml-3">
                            <li>• We have a server that's monitoring twitter for each and every tweet with the hashtag(s) <strong>{{ $string }}</strong>, and have a group of volunteers verify that information & publish them.</li>
                            <li>• We let public post verified information and share it across the network.</li> 
                            <li>• Continue reading on what more this site has to offer <a href="{{ route('home.howTo') }}">here</a></li>
                        </ul>
                        

                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>2. I wish to help, what do I do?</strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   Share this tool as much as you can. </li>
                            <li>•   Volunteer & help us verify the data for people who <strong>reaaaallly</strong> need it. (If we have already verified the data, the patient in need
                                    can directly get access to what they're looking for, and save alot of time. Every second is precious).</li>
                            <li>•   You could also help by adding resources and where to find them if you have a verified source in your contact. We can make it avaialble to those who require it on an urgent basis thereby reaching out at a faster pace.</a></li>
                            <li>•   Give feedback to us at <a href="mailto:ceo@icrewsystems.com">ceo@icrewsystems.com</a></li>
                            <li>•   <a href="{{ route('register') }}">Click here</a> to Register as a volunteer</li>


                        </ul>
                    
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>3. Who are we? Why did we make this tool?</strong>
                        </h1>
                        We're an aviation based IT company from Chennai. We saw our Nation sturggling,
                        and the youth forming open networks to pass data about resources on Twitter.
                        We just made a tool, that has it all in one place.
                    </p>


                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>4. What is our mission?</strong>
                        </h1>
                        Simple. Help the youth of our Nation (who are already doing a fantastic job of passing around information) to
                        spread information faster, in an easier way.
                    </p>

                    

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>5. Why is there difference in numbers compared to MOHFW website?</strong>
                        </h1>
                        MoHFW updates the data at a scheduled time. However, get updates from an Open API published by covid19india.org, who update the
                        the API based on state press bulletins, official (CM, Health M) handles, PBI, Press Trust of India, ANI reports. These are generally more recent.
                    </p>

                    


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
