@extends('layouts.atlantis')
@section('title', 'Leaderboard')
@section('js')
    <script>
        $(document).ready( function () {
            var myTable = $('#mission_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="panel-header bg-success-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                    Volunteer Leaderboard
                </h1>
                <h5 class="text-white mb-2">
                    The entire team of {{ config('app.name') }} salutes the dedication of all these volunteers
                </h5>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Position</th>
                                <th>Volunteer</th>
                                <th>In-Progress Missions</th>
                                <th>Completed Missions</th>
                                <th>Total Missions</th>
                                <th>Points</th>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($datum as $data)
                                @php
                                    $i++;
                                @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $data['name'] }}
                                            @if($i == 1 || $i == 2 || $i == 3)
                                                <i class="fa fa-star text-warning"></i>
                                            @endif
                                        </td>
                                        <td>{{ $data['inprogress'] }}</td>
                                        <td>{{ $data['completed'] }}</td>
                                        <td>{{ $data['total'] }}</td>
                                        <td>{{ $data['points'] }}</td>
                                    </tr>
                                @empty
                                    <div class="alert">
                                        Whoops! No data found *
                                    </div>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-warning">
                        Your name is not here? Your name will be added to the leaderboard once you start missions.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
