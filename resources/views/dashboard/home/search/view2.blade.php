@extends('layouts.atlantis')
@section('title', 'View Resource')
@section('js')
    {{-- <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
    <script>

        // $(document).ready(function() {
        //     $('.select2').select2();
        // });

        // CKEDITOR.replace('desc');

        function changeTweetStatus() {

        var button = document.getElementById('choose_status_button');
        button.disabled = true;
        button.innerHTML = "Loading...";

        var tweet_id = "{{ $tweet->id }}";
        var status = document.getElementById('choose_status').value;

            axios.get('/tweet/change-status/' + tweet_id + '/' + status)
            .then(function(response){
                console.log(response);
                window.location.reload();
            })
            .catch(function(error) {
                alert('Whoops! Something went wrong while changing the status of the tweet. Please contact admins');
            });

        }

        function choose_status_change(status, tweet_id = '') {
        var button = document.getElementById('choose_status_button');
        button.disabled = false;

        button.innerHTML = "Loading...";

        if(tweet_id == '') {
            tweet_id = "1";
        }

        if(status == 1) {
            button.classList = "btn btn-block btn-success";
            button.innerHTML = "Mark Verified";
        } else if(status == 2) {
            button.classList = "btn btn-block btn-warning";
            button.innerHTML = "Mark Refuted";
        } else if(status == 3) {
            button.classList = "btn btn-block btn-danger";
            button.innerHTML = "Mark Spam";
        } else if(status == 4) {
            button.classList = "btn btn-block btn-danger";
            button.innerHTML = "Mark Inadequate";
        }


        }
    </script>
@endsection
@section('content')
<div class="panel-header {{ $tweet->getStatus()->gradient }}">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white pb-2 fw-bold">

                    Tweet by {{ $tweet->username }} <i class="fab fa-twitter"></i>
                </h2>
                <h5 class="text-white op-7 mb-2">
                    This resource was fetched using TwitterScanner {{ $tweet->created_at->diffForHumans() }}
                </h5>
            </div>


            <div class="col-md-4 text-right">
                <span class="btn btn-white">
                    {{ $tweet->getStatus()->name }} <i class="fas fa-{{ $tweet->getStatus()->icon }} text-{{ $tweet->getStatus()->color }}"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Tweet
                    </h4>
                </div>
                <div class="card-body" id="twitterstream_running">
                    <div class="alert alert-info">
                        <h4 class="mt-3 b-b1 mb-2">
                            <span id="tweeter_name">{{ $tweet->fullname }}</span> (<a href="https://twitter.com/{{ $tweet->username }}" target="_blank" class="text-primary" id="tweeter_username">{{ $tweet->username }}</a>) &bull;
                            @php
                                $value = date("Y-m-d H:i:s", strtotime($tweet->tweet_timestamp));
                                $time = Carbon\Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('d/m/Y H:i A');
                            @endphp
                            <span id="timeAgo"> {{ $time }} </span>
                        </h4>
                        <div id="tweet_box">
                            {{ $tweet->tweet }}
                        </div>
                    </div>
                        <span class="text-muted">
                            <small>
                                If the full tweet is not available, view it on twitter website
                            </small>
                        </span>
                        <br><br>
                        <a href="https://twitter.com/{{ $tweet->username }}/status/{{ $tweet->tweet_id }}" target="_blank" id="status_link" class="btn btn-primary">
                            View on <i class="fab fa-twitter"></i>
                        </a>


                        @if (count($other_tweets) > 0)
                        <div class="accordion mt-2" id="otherTweetsAccordion">
                            <div class="">
                                <a class="btn btn-block btn-dark text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Found {{ count($other_tweets) }} other tweets by {{ $tweet->username }}
                                </a>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#otherTweetsAccordion">
                                    <div class="card-body">
                                        @foreach ($other_tweets as $otweet)
                                            @php
                                                if($otweet->status == 0) {
                                                    $ocolor = 'warning';
                                                } else if($otweet->status == 1) {
                                                    $ocolor = 'success';
                                                } else if($otweet->status == 2) {
                                                    $ocolor = 'danger';
                                                } else {
                                                    $ocolor = 'dark';
                                                }
                                            @endphp
                                            <div class="alert alert-{{ $ocolor }}">
                                                <h4 class="mt-3 b-b1 mb-2">
                                                    <span id="tweeter_name">{{ $otweet->fullname }}</span> (<a href="https://twitter.com/{{ $tweet->username }}" target="_blank" class="text-primary" id="tweeter_username">{{ $tweet->username }}</a>) &bull;
                                                    @php
                                                        $value = date("Y-m-d H:i:s", strtotime($otweet->tweet_timestamp));
                                                        $time = Carbon\Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('d/m/Y H:i A');
                                                    @endphp
                                                    <span id="timeAgo"> {{ $time }} </span>
                                                </h4>
                                                <div id="tweet_box">
                                                    {{ $otweet->tweet }}
                                                </div>
                                                <br>
                                                <a href="https://twitter.com/{{ $otweet->username }}/status/{{ $otweet->tweet_id }}" target="_blank" id="status_link" class="btn btn-primary">
                                                    View on <i class="fab fa-twitter"></i>
                                                </a>
                                                <a href="{{ route('admin.twitter.manage', $otweet->id) }}" target="_blank" id="status_link" class="btn btn-primary">
                                                    Manage
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
