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
                    A comprehensive guide for the website
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
                            <strong>1. I wish to help, what do I do? Where do I start?</strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   Share this tool as much as you can. </li>
                            <li>•   Volunteer & help us verify the data for people who <strong>reaaaallly</strong> need it. (If we have already verified the data, the patient in need
                                    can directly get access to what they're looking for, and save alot of time. Every second is precious).</li>
                            <li>•   You could also help by adding resources and where to find them if you have a verified source in your contact. We can make it avaialble to those who require it on an urgent basis thereby reaching out at a faster pace.</a></li>
                            <li>•   Give feedback to us at <a href="mailto:ceo@icrewsystems.com">ceo@icrewsystems.com</a></li>
                        </ul>

                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>2. How does this site work?</strong>
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
                            <li>•    We have a server that's monitoring twitter for each and every tweet with the hashtag(s) <strong>{{ $string }}</strong>, and have a group of volunteers verify that information & publish them. </li>
                            <li>•	 We let public post verified information and share it across the network.</li>
                        </ul>


                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>3. How do I access other users (admins/volunteers etc..) details? </strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks the <strong>users</strong> button in side bar, it redirects the user to the page where he/she will be able to view the list of users and their details</li>
                            <li>•   When the user clicks the <strong>create a new user</strong> button ,the user will be able to create a new user</li>
                            <li>•   When the user clicks the <strong>manage</strong> button, the user will be able to update and delete a user</li>
                        </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>4. How do I view/track my activities on this website?</strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>activity log</strong>  in side bar, it takes to the page where user can able to view their activies in the website</li>
                        </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>5. How do I create / view / manage FAQ's ? </strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks the <strong>FAQ</strong> button in side bar, it takes to the page where user can able to view the list of faq </li>
                            <li>•   When the user clicks the <strong>create a new FAQ</strong> button, the user will be able to create a new FAQ </li>
                            <li>•   When the user clicks the <strong>manage</strong> button user are able to update and delete the faq</li>
                        </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>6. How do I create / view / manage user roles? </strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>access control</strong> in the side bar, it takes the user to the page where he/she will be able to view the roles</li>
                            <li>•   When the user clicks <strong>create a new role</strong> button, the user will be able to create a new role </li>
                            <li>•   When the user clicks <strong>manage</strong> button ,it takes the user to another page where the user will be able to set the required permission for a particular role</li>
                        </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>7. How do I retreive / view data from Twitter? </strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>tweets</strong> in side bar, it takes to the page where user can able to view the tweets about #covid19resources</li>
                            <li>•	When the user clicks <strong>refresh</strong> data button, the  user are able to see the latest tweets</li>
                            <li>•	When the user clicks <strong>manage</strong> button user are able to choose the status of the tweet and change the status and verify the tweets</li>
                            <li>•	When the user clicks <strong>the delete icon</strong> the tweet will be deleted from the website </li>
                        </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>8. How do I add Resources?</strong>
                        </h1>
                            <ul class="ml-3">
                                <li>•   When the user clicks <strong>resources</strong> button in the side bar, it takes them to the page where the user will be able to view the resources </li>
                                <li>•	When the user clicks on <strong>add a new resource </strong> button, users will be able to create the available resources</li>
                                <li>•	When the user clicks <strong>manage</strong> button, users will be able to update and delete the resources availability</li>
                            </ul>
                    </p>

                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>9. How do I access various Resource Categories (Oxygen/Ventilators etc..)</strong>
                        </h1>
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>categories</strong> in side bar, it takes to the page where user can able to view the categories of resources such as hospitals, ventilators etc</li>
                            <li>•	When the user clicks <strong>add a new category</strong> button, user are able to create the available category</li>
                            <li>•	When the user clicks <strong>manage</strong> button, user are able to update and delete the category</li>
                        </ul>
                    </p>



                    <p class="mb-3">
                        <h1 class="h2">
                            <strong>10. How do I add Geographical Data?</strong>
                        </h1>
                        For Cities -
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>cities</strong> in the side bar, it takes to the page where the page shows a collection of the latest information regarding the cities is available</li>
                            <li>•	When the user clicks <strong>add new city</strong> button user are able to add the new city</li>
                            <li>•	When the user clicks <strong>manage</strong> button user are able to update and delete the cities</li>
                        </ul>
                        For Districts -
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>Districts</strong> in side bar, it takes you to a page where a collection of the latest information regarding the districts is available</li>
                            <li>•	When the user clicks <strong>add new district</strong> button .user are able to add the new district </li>
                            <li>•	When the user clicks <strong>manage</strong> button user are able to update and delete the district</li>
                        </ul>
                        For States-
                        <ul class="ml-3">
                            <li>•   When the user clicks <strong>States</strong> in side bar, it takes you to the page a collection of the latest information regarding the States is available</li>
                            <li>•	When the user clicks <strong>add new States</strong> button, user will be able to add the new States</li>
                            <li>•	When the user clicks <strong>manage</strong> button user will be able to update and delete the States</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
