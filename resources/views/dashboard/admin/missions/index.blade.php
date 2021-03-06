@extends('layouts.atlantis')
@section('title', 'Mission Dashboard')
@section('js')
    <script src="{{ asset('atlantis/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/pusher.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            var myTable = $('#mission_table').DataTable();
        });

        function getStatus() {

            var status_button = document.getElementById('STATUS_refresh_button');

            var assigned = document.getElementById('STATUS_assigned');
            var inprogress = document.getElementById('STATUS_inprogress');
            var completed = document.getElementById('STATUS_completed');
            var volunteers = document.getElementById('STATUS_volunteers');
            var unassigned = document.getElementById('STATUS_tunassigned');
            var tcompleted = document.getElementById('STATUS_tcompleted');
            var tassigned = document.getElementById('STATUS_tassigned');


            status_button.innerHTML = "<i class='fa fa-sync fa-spin'></i>";
            status_button.disabled = true;

            axios.get('/mission/getstats')
            .then(function(response){
                status_button.innerHTML = "<i class='fa fa-sync'></i> Refresh Data";
                status_button.disabled = false;

                var data = response.data;

                assigned.innerHTML = data[0].count;
                inprogress.innerHTML = data[1].count;
                completed.innerHTML = data[3].count;
                unassigned.innerHTML = data.pendingtweets;
                tcompleted.innerHTML = data.total_completed;
                tassigned.innerHTML = data.total_resources_assigned_in_missions;
            })
            .catch(function(error) {
                console.log(error);
            })
        }

        getStatus();
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Mission Control Dashboard</h4>
    </div>
    <p class="mb-4">
         These are all the missions that are currently assigned.
         <br><br>
         <a href="{{ route('admin.mission.assign') }}" class="btn btn-success"><i class="fa fa-plus"></i> Assign new mission</a>
         <a href="#" onclick="getStatus();" id="STATUS_refresh_button" class="btn btn-primary">
            <i class='fa fa-sync'></i> Refresh Data
         </a>
    </p>

    <div class="row">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right">
                        <i class="fa fa-exclamation-triangle text-danger"></i>
                    </div>
                    <div class="h1 m-0" id="STATUS_assigned">-</div>
                    <div class="text-muted mb-3">Assigned</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_inprogress">-</div>
                    <div class="text-muted mb-3">Inprogress</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_completed">-</div>
                    <div class="text-muted mb-3">Completed</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_tcompleted">-</div>
                    <div class="text-muted mb-3">T. Completed</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_tassigned">-</div>
                    <div class="text-muted mb-3">T. Assigned</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0 mt-4" id="STATUS_tunassigned">-</div>
                    <div class="text-muted mb-3">T. Unassigned</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Missions in-progress <span class="badge badge-primary">{{ count($missions) }}</span>
                    </h4>
                    <p>
                        Your mission status is automatically updated as you carry out the mission. Make sure no missions are delayed.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mission_table" class="table table-hover">
                            <thead>
                                <th>Mission #</th>
                                <th>Volunteer</th>
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
                                            <a href="{{ route('admin.user.edit', $mission->volunteer_id) }}" target="_blank" class="text-primary">
                                                @php
                                                	$user = App\Models\User::find($mission->volunteer_id);
                                                	if($user != '') {
                                                		echo $user->name;
                                                	} else {
                                                		echo "Unknown user with ID # $mission->volunteer_id";
                                                	}
                                                @endphp
                                            </a>
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
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('home.mission.view', $mission->uuid) }}" class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.mission.manage', $mission->uuid) }}" class="btn btn-info btn-sm">
                                                    Manage
                                                </a>
                                                <a href="#" onclick="dissolveMission('{{ $mission->id }}')" class="btn btn-danger btn-sm">
                                                    Dissolve
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

                        function dissolveMission(id) {
                            if(confirm('Are you sure you wish to dissolve this mission? This action is not un-doable')) {
                              window.location = "{{ config('app.url') }}/admin/mission/dissolve/" + id;
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
