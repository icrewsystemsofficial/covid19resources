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
                    <h4 class="card-title">Points overview <span class="badge badge-primary"></span></h4>
                    <p>
                        Your Points status is automatically updated as you carry out the mission. Make sure no missions are delayed.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mission_table" class="table table-hover">
                            @if (count($users)>0)
                                <thead>
                                    <th>ID #</th>
                                    <th>Assigned By</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Assigned Points</th>
                                    <th class="text-center">Current Points</th>
                                    <th>Comments</th>
                                </thead>                                
                            @endif

                            <tbody>
                                <script>
                                    // This is added here, because the js section is rendered below the page
                                    var assigned = 0;
                                    var inprogress = 0;
                                    var completed = 0;
                                </script>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            #{{ $user->id }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text- btn btn-sm btn-info text-white ">
                                                {{ $user->author }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                                {{ $user->created_at->diffForHumans() }}
                                        </td>
                                        <td class="text-center">
                                                {{ $user->assigned_points }}
                                        </td>
                                        <td class="text-center">
                                                {{ $user->points }}
                                        </td>
                                        <td>
                                            {{ $user->comment }}

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
