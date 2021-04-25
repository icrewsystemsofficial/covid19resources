@extends('layouts.atlantis')
@section('title', 'Mission Dashboard')
@section('js')
    <script src="{{ asset('atlantis/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/pusher.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            var myTable = $('#mission_table').DataTable();
        });

        Pusher.logToConsole = false;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'ap2'
        });

        var tweets = [];
        var latest_tweet = 0;
        var idle_checks = 0;
        //Elements
        var tweetbox = document.getElementById('tweet_box');
        var streamed_tweets = document.getElementById('streamed_tweets');
        var current_tweet = document.getElementById('current_tweet');
        var tweeter_username = document.getElementById('tweeter_username');
        var tweeter_name = document.getElementById('tweeter_name');
        var status_link = document.getElementById('status_link');

        // var streamed_tweets_stats = document.getElementById('streamed_tweets_stats');

        //Status boxes.
        var twitterstream_running = document.getElementById('twitterstream_running');
        var twitterstream_idle = document.getElementById('twitterstream_idle');
        var twitterstream_stopped = document.getElementById('twitterstream_stopped');


        function changeStatus(status) {

            var twitterstream_running = document.getElementById('twitterstream_running');
            var twitterstream_idle = document.getElementById('twitterstream_idle');
            var twitterstream_stopped = document.getElementById('twitterstream_stopped');
            var statusIndicator = document.getElementById('statusIndicator');
            var timeAgo = document.getElementById('timeAgo');

            twitterstream_running.style.display = "none";
            twitterstream_idle.style.display = "none";
            twitterstream_stopped.style.display = "none";

            switch(status) {
                case "running":
                    twitterstream_running.style.display = "block";
                    statusIndicator.classList = "badge badge-success";
                    statusIndicator.innerHTML = "RUNNING <i class='fa fa-sync fa-spin'></i>";
                break;

                case "idle":
                    twitterstream_idle.style.display = "block";
                    statusIndicator.classList = "badge badge-warning";
                    statusIndicator.innerHTML = "IDLE <i class='fa fa-circle'></i>";
                break;

                case "stopped":
                    twitterstream_stopped.style.display = "block";
                    statusIndicator.classList = "badge badge-danger";
                    statusIndicator.innerHTML = "STOPPED <i class='fa fa-times'></i>";
                break;

                default:
                    twitterstream_stopped.style.display = "block";
                    statusIndicator.classList = "badge badge-dark";
                    statusIndicator.innerHTML = "UNKNOWN <i class='fa fa-exclamation-triangle'></i>";
                break;
            }
        }


        //When page loads, it will be IDLE.
        changeStatus('idle');

        (function variableInterval() {
            if(idle_checks >= 5) {
                idle_checks = 0;
                console.log('No tweets observed, going to stopped mode....No updates will be');
                changeStatus('stopped');
                interval = 10000;
            }
            else if(typeof tweets[latest_tweet] == 'undefined') {
                latest_tweet = 0;
                idle_checks = idle_checks + 1;
                console.log('No tweets, switching to idle mode....' + idle_checks);
                changeStatus('idle');
                interval = 2000;
            } else {


                currentTweet = tweets[latest_tweet]['tweet'];
                    // console.log(tweets[latest_tweet]);
                    tweetbox.innerHTML = currentTweet.text;
                    current_tweet.innerHTML = latest_tweet;
                    tweeter_username.innerHTML = currentTweet.user_name;
                    tweeter_name.innerHTML = currentTweet.name;
                    tweeter_username.href = 'https://twitter.com/' + currentTweet.user_name;
                    status_link.href = 'https://twitter.com/' + currentTweet.user_name + '/status/' + currentTweet.id;
                    let timeago = moment(currentTweet.momentJS, "YYYYMMDDhm").fromNow();
                    timeAgo.innerHTML = timeago;
                changeStatus('running');

                interval = 10000;
            }

            streamed_tweets.innerHTML = tweets.length;

            latest_tweet = latest_tweet + 1;

            setTimeout(variableInterval, interval);
        })();

        //Update tthe Stats
        // streamed_tweets_stats.innerHTML = db_tweets;
        var total = document.getElementById('STATUS_total');
        var total_tweets = total.innerText;

        var channel = pusher.subscribe('pusher-tweets');

        channel.bind('tweets', function(data) {
            tweets.push(data);
            // total_tweets = total_tweets + 1;
            // total.innerHTML = total_tweets;
            setTimeout(function() {
                getStatus();
            }, 5000)
        });


        function getStatus() {

            var status_button = document.getElementById('STATUS_refresh_button');

            var pending = document.getElementById('STATUS_pending');
            var converted = document.getElementById('STATUS_converted');
            var total = document.getElementById('STATUS_total');
            var verified = document.getElementById('STATUS_verified');
            var refuted = document.getElementById('STATUS_refuted');
            var screened = document.getElementById('STATUS_screened');
            var inadequate = document.getElementById('STATUS_inadequate');
            var spam = document.getElementById('STATUS_spam');

            // status_button.innerHTML = "<i class='fa fa-sync fa-spin'></i>";
            // status_button.disabled = true;

            axios.get('/twitter/getstats')
            .then(function(response){
                // status_button.innerHTML = "<i class='fa fa-sync'></i> Refresh Data";
                // status_button.disabled = false;

                var data = response.data;

                pending.innerHTML = data[0].count;
                converted.innerHTML = data[5].count;
                total.innerHTML = data.total;
                verified.innerHTML = data[1].count;
                screened.innerHTML = data[6].count;
                spam.innerHTML = data[3].count;
                inadequate.innerHTML = data[4].count;

            })
            .catch(function(error) {
                alert('There was an error getting updates from the API Server. Please contact admins');
                console.log(error);
            })
        }

        getStatus();
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Mission Dashboard</h4>
    </div>
    <p class="mb-4">
         You can find all the missions that have been assigned to you. If you don't have a mission assigned yet, you can assign one yourself.
    </p>

    <div class="row">
        <div class="col-md-12">
            <p>


                <button class="btn btn-primary mb-4" type="button" data-toggle="collapse" data-target="#SOPBox" aria-expanded="false" aria-controls="SOPBox">
                    Generate new mission
                </button>
              </p>
              <div class="collapse" id="SOPBox">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                <p>
                                    <span class="mr-1 h4"><strong>Step #1</strong></span>
                                    Make sure you have a mission assigned. If you don't, click <a href="{{ route('home.mission.index') }}" class="text-primary">here</a> to self assign. The mission
                                    will tell you how many tweets you have to verify & convert into resources.

                                    <br><br>

                                    <span class="mr-1 h4"><strong>Step #2</strong></span>
                                    Look at the resource <strong>CAREFULLY</strong>. Check for <strong>What & Where</strong> of the resource, <strong>Phone numbers</strong> of the person
                                    associated with the resource, <strong>Geographical information</strong>. If these criteria are fulfilled, then proceed to make a call to
                                    the phone number. If not, mark the tweet as "Inadequate Information".

                                    <br><br>

                                    <span class="mr-1 h4"><strong>Step #3</strong></span>
                                    When calling the person / entity / organization, <strong>introduce yourself</strong> ({{ auth()->user()->name }}, volunteer from {{ config('app.name') }}),
                                    ask them about the <strong>resource</strong>. (If applicable: Remaining stock, Cost, Landmark) and note them down as you're speaking
                                    with them.

                                    <br><br>

                                    <a onclick="alert('Example not added yet');" href="#" class="btn btn-md btn-primary">
                                        Listen to example <i class="fas fa-volume-up"></i>
                                    </a>

                                    <br><br>


                                    <i class="fa fa-check-circle text-success"></i> Keep the conversation short. Ideally 30-45 seconds.
                                        <br>
                                        <i class="fa fa-check-circle text-success"></i> Always begin with greetings & address the person on the other end as "Sir/Madam"
                                        <br>
                                        <i class="fa fa-times-circle text-danger"></i> Don't ask for information that is not relevant
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

        </div>

        <div class="col-6 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right">
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                    </div>
                    <div class="h1 m-0" id="STATUS_pending">-</div>
                    <div class="text-muted mb-3">Completed</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_screened">-</div>
                    <div class="text-muted mb-3">Assigned</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-4">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_converted">-</div>
                    <div class="text-muted mb-3">Completed</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Missions overview <span class="badge badge-primary">{{ count($missions) }}</span></h4>
                    <p>
                        Your mission status is automatically updated as you carry out the mission. Make sure no missions are delayed.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mission_table" class="table table-hover">
                            <thead>
                                <th>Mission #</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Assigned</th>
                                <th>Last Updated</th>
                                <th>Options</th>
                            </thead>
                            <tbody>
                                <script>
                                    // This is added here, because the js section is rendered below the page
                                    var verified = 0;
                                    var pending = 0;
                                    var refuted = 0;
                                </script>
                                @forelse ($missions as $mission)
                                    <tr>
                                        <td>
                                            Mission {{ $mission->id }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text-{{ $mission->missionType()->color }}">
                                                {{ $mission->missionType()->name }} <i class="{{ $mission->missionType()->icon }}"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $mission->getStatus()->color }}">
                                                {{ $mission->getStatus()->name }} <i class="fas fa-{{ $mission->getStatus()->icon }}"></i>
                                            </span>
                                        </td>
                                        <td>
                                            {{ $mission->created_at->diffForHumans() }}
                                            <br>
                                            <small>
                                                {{ $mission->created_at->format('d/m/Y H:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            {{ $mission->updated_at->diffForHumans() }}
                                            <br>
                                            <small>
                                                {{ $mission->updated_at->format('d/m/Y H:i A') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('home.mission.view', $mission->uuid) }}" class="btn btn-primary">
                                                    View
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert">
                                        Whoops! No data found *
                                    </div>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <script>

                        function deleteRow(row) {

                            if(confirm('Are you sure you wish to delete this tweet? This action is not un-doable')) {
                                var row_id = 'row_'+row;
                                var row_element = document.getElementById(row_id);
                                row_element.style.display = 'none';
                                axios.get('/tweets/' + row + '/delete')
                                .then(function(response) {
                                    console.log('Removing row # ' + row);
                                    row_element.remove();
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                            } else {

                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
