@extends('layouts.atlantis')
@section('title', 'Mission Dashboard')
@section('js')
    <script src=" asset('atlantis/assets/js/moment.min.js') "></script>
    <script src=" asset('atlantis/assets/js/pusher.min.js') "></script>
    <script>
        $(document).ready( function () {
            var myTable = $('#mission_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Points Table</h4>
    </div>
    <p class="mb-4">
         You can find all the details about you Points that have been assigned to you.
    </p>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Points overview <span class="badge badge-primary"> count($missions) </span></h4>
                    <p>
                        Your Points status is automatically updated as you carry out the mission. Make sure no missions are delayed.
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
                                    var assigned = 0;
                                    var inprogress = 0;
                                    var completed = 0;
                                </script>
                                {{-- @forelse ($missions as $mission) --}}
                                    <tr>
                                        <td>
                                            Mission  $mission->id 
                                        </td>
                                        <td>
                                            <span class="fw-bold text- $mission->missionType()->color ">
                                                 $mission->missionType()->name  <i class=" $mission->missionType()->icon "></i>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge- $mission->getStatus()->color ">
                                                 $mission->getStatus()->name  <i class="fas fa- $mission->getStatus()->icon "></i>
                                            </span>
                                        </td>
                                        <td>
                                             $mission->created_at->diffForHumans() 
                                            <br>
                                            <small>
                                                 $mission->created_at->format('d/m/Y H:i A') 
                                            </small>
                                        </td>
                                        <td>
                                             $mission->updated_at->diffForHumans() 
                                            <br>
                                            <small>
                                                 $mission->updated_at->format('d/m/Y H:i A') 
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href=" route('home.mission.view', $mission->uuid) " class="btn btn-primary">
                                                    View
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                {{-- @empty
                                    <div class="alert">
                                        Whoops! No data found *
                                    </div>
                                @endforelse --}}

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
