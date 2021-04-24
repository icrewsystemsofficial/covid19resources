@extends('layouts.atlantis')
@section('title', 'Tweets Admin')
@section('js')
    <script src="{{ asset('atlantis/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/pusher.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            var myTable = $('#tweets_table').DataTable();
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
        <h4 class="page-title">Tweets Dashboard</h4>
    </div>
    <p class="mb-4">
        This is a collection of data that has been streamed from Twitter. These tweets have the keywords
        @foreach ($keywords as $keywords) <strong>{{ $keywords }}</strong> @endforeach
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <p class="text-muted">
                                        Tweets Streamed <i class="fa fa-circle-notch fa-spin"></i>
                                        <h1 class="text-success fw-bold h1" id="STATUS_total">1</h1>
                                    </p>
                                </div>
                            </div>

                            <button id="STATUS_refresh_button" onclick="getStatus();" class="btn btn-block btn-primary">
                                <i class="fa fa-sync"></i> Refresh Data
                            </button>
                        </div>

                        <div class="col-md-8">
                            To avoid server overload, we only load 500 datapoints at a time.
                            Oldest information is stored first. Use the links below to navigate further to the next 500 of the TOTAL TWEETS
                            <br>
                            <br>
                            {{ $tweets->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><b>TweetScanner</b> <i class="fab fa-twitter"></i></h5>
                            <p class="text-muted mb-4">Scanning for tweets with keywords
                                <br>
                                @php
                                    $keywords = config('app.tweet_keywords');
                                @endphp
                                @foreach ($keywords as $keywords) <strong>{{ $keywords }}</strong> @endforeach
                                ...
                            </p>
                        </div>
                        <h3 class="text-info">
                            <span id="statusIndicator" class="badge badge-dark fw-bold">Loading...</span>
                        </h3>
                    </div>

                    <div class="alert alert-danger" id="twitterstream_stopped" style="display: none;">
                        <h4 class="b-b1 mb-2">
                            <i class="fa fa-times text-danger"></i> Stopped
                        </h4>
                        <div>

                            The TweetScanner is currently not running. This might be a temporary maintenance stop. Please check our
                            App Status page to know more information.
                            <br><br>
                            <a href="#" class="btn btn-danger btn-md">App Status</a>
                        </div>
                    </div>

                    <div class="alert alert-warning" id="twitterstream_idle" style="display: none;">
                        <h4 class="b-b1 mb-2">
                            <i class="fa fa-exclamation-triangle text-warning"></i> Idle
                        </h4>
                        <div>
                            The TweetScanner stream is currently idle. This means that currently no one is tweeting with the monitored hashtags.
                            Data will show up as soon as someone tweets it.
                        </div>
                    </div>

                    <div class="card-body" id="twitterstream_running" style="display: none;">
                        <div class="alert alert-success">
                            <h4 class="mt-3 b-b1 mb-2">
                                <span id="tweeter_name"></span> (<a href="#" class="text-primary" id="tweeter_username" target="_blank"></a>) &bull; <span id="timeAgo">Unknown</span>
                            </h4>
                            <div id="tweet_box">
                                Tweet Data
                            </div>
                        </div>

                            <span class="text-muted">
                                Showing tweet <span id="current_tweet">0</span> of <span id="streamed_tweets">Unknown</span> (reindexing...)
                                <br>
                                Saved to database <i class="fa fa-check text-success"></i>
                            </span>
                            <br><br>
                            <a href="#" target="_blank" id="status_link" class="btn btn-primary">
                                <i class="fab fa-twitter"></i>
                            </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right">
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                    </div>
                    <div class="h1 m-0" id="STATUS_pending">-</div>
                    <div class="text-muted mb-3">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_screened">-</div>
                    <div class="text-muted mb-3">Screened</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_converted">-</div>
                    <div class="text-muted mb-3">Duplicated (RT)</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_verified">-</div>
                    <div class="text-muted mb-3">Verified</div>
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_refuted">-</div>
                    <div class="text-muted mb-3">Refuted</div>
                </div>
            </div>
        </div> --}}
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_inadequate">-</div>
                    <div class="text-muted mb-3">Inadequate</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_spam">-</div>
                    <div class="text-muted mb-3">Spam</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage resources <span class="badge badge-primary">{{ count($tweets) }}</span></h4>
                </div>
                <div class="card-body">
                    <table id="tweets_table" class="table table-hover table-responsive">
                        <thead>
                            <th>Tweet</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Added</th>
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
                            @forelse ($tweets as $tweet)
                                <tr id="row_{{$tweet->id}}">
                                    <td>
                                        {{ $tweet->tweet }}
                                    </td>
                                    <td>
                                        {{ $tweet->fullname }}
                                        <br>
                                        <small>
                                            (<a href="https://twitter.com/{{ $tweet->username }}" target="_blank" class="text-primary">{{ $tweet->username }}</a>)
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $tweet->getStatus()->color }}">
                                            {{ $tweet->getStatus()->name }} <i class="fas fa-{{ $tweet->getStatus()->icon }}"></i>
                                        </span>
                                    	{{-- @if($tweet->status == 0)
                                            <span class="badge badge-warning">
                                                Pending <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                        @elseif($tweet->status == 1)
                                            <span class="badge badge-success">
                                                Verified <i class="fas fa-check-circle"></i>
                                            </span>
                                            <script>
                                                verified = verified + 1;
                                            </script>
                                        @elseif($tweet->status == 2)
                                            <span class="badge badge-danger">
                                                Refuted <i class="fas fa-times-circle"></i>
                                            </span>
                                            <script>
                                                refuted = refuted + 1;
                                            </script>
                                        @elseif($tweet->status == 3)
                                            <span class="badge badge-danger">
                                                Spam <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                        @elseif($tweet->status == 4)
                                            <span class="badge badge-danger">
                                                Inadequate Information <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                        @endif

                                        <script>
                                                pending = pending + 1;
                                            </script> --}}
                                    </td>
                                    <td class="text-center">
                                        {{ $tweet->created_at->format('d/m/Y H:i A') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $tweet->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.twitter.manage', $tweet->id) }}" class="btn btn-sm btn-primary">
                                                Manage
                                            </a>

                                            <a onclick="deleteRow('{{$tweet->id}}');" chref="#" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash text-white"></i>
                                            </a>


                                        </div>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No resources found.
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <script>
                        // document.getElementById('verified').innerHTML = {{ $tweet_stats->verified }};
                        // document.getElementById('pending').innerHTML = {{ $tweet_stats->pending }};
                        // document.getElementById('refuted').innerHTML = {{ $tweet_stats->refuted }};
                        // document.getElementById('total').innerHTML = verified + pending + refuted;

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
