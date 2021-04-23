@extends('layouts.atlantis')
@section('title', 'Tweets Admin')
@section('js')
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready( function () {
            var myTable = $('#tweets_table').DataTable();
            $('#myTable').on( 'click', 'tbody tr', function () {
                myTable.row( this ).delete( {
                    buttons: [
                        { label: 'Cancel', fn: function () { this.close(); } },
                        'Delete'
                    ]
                } );
            } );
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

        var streamed_tweets_stats = document.getElementById('streamed_tweets_stats');

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
        var db_tweets = {{ count($tweets) }};
        streamed_tweets_stats.innerHTML = db_tweets;
        var total = verified + pending + refuted;
        //Progress bar.
        var progress = 0;
        progress = ((db_tweets - pending) / 100);
        document.getElementById('progressBar').setAttribute('aria-valuenow', progress);

        var channel = pusher.subscribe('pusher-tweets');
            channel.bind('tweets', function(data) {
                tweets.push(data);
                db_tweets = db_tweets + 1;
                streamed_tweets_stats.innerHTML = db_tweets;
            });


    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Tweets Admin</h4>
    </div>
    <p>
        This is a collection of data that has been streamed from Twitter. These tweets have the keywords
        @foreach ($keywords as $keywords) <strong>{{ $keywords }}</strong> @endforeach
    </p>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5><b>Statistics</b></h5>
                                    <p class="text-muted">Tweets Streamed</p>
                                </div>
                                <h3 class="text-info fw-bold" id="streamed_tweets_stats"></h3>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-info w-75" id="progressBar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Pending for Verification</p>
                                <p class="text-warning font-weight-bold mb-0">-</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row user-stats text-center">
                                <div class="col">
                                    <div class="number" id="pending">-</div>
                                    <div class="title">Pending Verification <i class="fa fa-exclamation-triangle text-warning"></i></div>
                                </div>
                                <div class="col">
                                    <div class="number text-success" id="verified">-</div>
                                    <div class="title">Converted to resources</div>
                                </div>
                                <div class="col">
                                    <div class="numbe text-danger" id="refuted">-</div>
                                    <div class="title">Rejected</div>
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
                                    <p class="text-muted">Scanning for tweets with keywords
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


            </div>
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage resources <span class="badge badge-primary">{{ count($tweets) }}</span></h4>
                    <div class="text-right">
                        <a href="{{ route('admin.resources.create') }}" class="btn btn-md btn-primary">
                            Add a new resource <i class="fas fa-plus"></i>
                        </a>
                    </div>
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
                                    	@if($tweet->status == 0)
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
                                            </script>
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
                        document.getElementById('verified').innerHTML = verified;
                        document.getElementById('pending').innerHTML = pending;
                        document.getElementById('refuted').innerHTML = refuted;
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
