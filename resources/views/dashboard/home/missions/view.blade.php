@extends('layouts.atlantis')
@section('title', 'Mission '. $mission->id)
@section('js')
    <script>
        $(document).ready( function () {
            $('#tweets_table').DataTable();
        });

        function hideRow(row) {
            var row_id = 'row_'+row;
            var row_element = document.getElementById(row_id);
            // row_element.innerHTML = 'Loading';
            row_element.style.display = 'none';
            var screened = document.getElementById('screened');
            var current = screened.value;
            screened.innerText = current++;
        }

        setInterval(function() {
            window.location.reload();
        }, 180000)

        function updateStatus(screened, total) {
            var id = {{ $mission->id }};
            if(screened == total) {

                var status = {{ \App\Models\Mission::COMPLETED }};

                // alert(screened + ' ' + total);

                axios.get('/mission/changeStatus/' + id + '/' + status)
                .then(function(response) {
                    if(response.data.type == 'success') {
                        window.location.reload();
                        console.log(response);
                    } else {
                        alert('There was an error updating the mission status. Screenshot this and show it to the admins');
                    }
                })
            }
            else if(screened != 0) {
                var status = {{ \App\Models\Mission::INPROGRESS }};

                // alert(screened + ' ' + total);

                axios.get('/mission/changeStatus/' + id + '/' + status)
                .then(function(response) {
                    if(response.data.type == 'success') {
                        window.location.reload();
                        console.log(response);
                    } else {
                        alert('There was an error updating the mission status. Screenshot this and show it to the admins');
                    }
                })
            }

        }

        function updateMissionCompletedCount(screened) {
            var id = {{ $mission->id }};
            axios.get('/mission/completedCount/' + id + '/' + screened)
                .then(function(response) {
                    if(response.data.type == 'success') {
                        console.log(response);
                    } else {
                        alert('There was an error updating the mission status. Screenshot this and show it to the admins');
                    }
                });
        }

        // This updates the count of the tweets that are verified.
        updateMissionCompletedCount(screened);


        document.getElementById('screened').innerHTML = screened;
        document.getElementById('screened').value = screened;
    </script>

        @if($mission->status == \App\Models\Mission::ASSIGNED)
            <script>
                updateStatus(screened, {{ count($mission->dataArray()) }});
            </script>
        @endif


@endsection
@section('content')
<div class="panel-header {{ $mission->getStatus()->gradient }}">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h1 class="text-white pb-2 h1 fw-bold">
                    Mission {{ $mission->id }}
                </h1>
                <h5 class="text-white mb-2">
                    Each mission has datum that needs to be verified. Collectively, each mission provides 100 points.
                    You need 10000 points to be eligible for the certificate.
                </h5>
            </div>


            <div class="col-md-4 text-right">
                <span class="btn btn-white">
                    {{ $mission->getStatus()->name }} <i class="fas fa-{{ $mission->getStatus()->icon }} text-{{ $mission->getStatus()->color }}"></i>
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
                        Progress: <span id="screened"></span> / {{ count($mission->dataArray())}} Verified
                        <br>
                        <small>
                            <span class="text-muted">
                                Tap the button to refresh the data.
                            </span>
                        </small>
                    </h4>
                    <div class="text-right">
                        <a onclick="window.location.reload();" href="#" class="btn btn-md btn-primary">
                            <i class="fa fa-sync"></i> Refresh
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <strong>Assigned</strong>: {{ $mission->created_at->format('d/m/Y H:i A') }} ({{ $mission->created_at->diffForHumans() }})
                    <br>
                    <strong>
                        Objective:
                    </strong>
                    {!! $mission->description !!}
                    <br><br><br>

                    <div class="table-responsive">
                        <table id="tweets_table" class="table table-hover">
                            <thead>
                                <th>Tweet</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Tweeted</th>
                                <th>Last Updated</th>
                                <th>Options</th>
                            </thead>
                            <tbody>
                                <script>
                                    var screened = {{ count($mission->dataArray()) }}
                                </script>
                                @forelse ($mission->dataArray() as $data)
                                    @php
                                        $tweet = App\Models\Twitter::find($data);
                                    @endphp
                                    @if($tweet == '')
                                        <tr>
                                        	<td>
                                        		This tweet is unavailable
                                        	</td>
                                        </tr>
                                    @elseif($tweet->status == App\Models\Twitter::SCREENED)

                                    <script>
                                        screened = screened - 1;
                                    </script>

                                    <tr id="row_{{$tweet->id}}">
                                        <td width="45px;">
                                            {{ $tweet->tweet }}
                                        </td>
                                        <td width="45px;">
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
                                        </td>

                                        <td>
                                            @php
                                                $tweeted = \Carbon\Carbon::parse($tweet->tweet_timestamp);
                                            @endphp
                                            {{  $tweeted->diffForHumans() }}
                                            <br>
                                            <small>
                                                {{ $tweeted->format('d/m/Y H:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            {{ $tweet->updated_at->diffForHumans() }}
                                            <br>
                                            <small>
                                                {{ $tweet->updated_at->format('d/m/Y H:i A') }}
                                            </small>
                                        </td>


                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a target="_blank" onclick="hideRow('{{$tweet->id}}');" href="{{ route('admin.twitter.manage', $tweet->id) }}" class="btn btn-sm btn-primary">
                                                    Manage
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                        Whoops! No resources found.
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
