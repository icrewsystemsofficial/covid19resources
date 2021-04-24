@extends('layouts.atlantis')
@section('title', 'Users Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#activity_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Users Admin</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Users</h4>
                </div>
                <div class="card-body">
                    <table id="activity_table" class="table table-hover">
                        <thead>
                            <th> Id</th>
                            <th>Activity</th>
                            <th>Logged By</th>
                            <th>When</th>
                        </thead>
                        <tbody>
                            @forelse ($activites $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        {{-- @if($activity->causer_id == 'null')
                                        <a href="#" class="btn btn-danger btn-sm">System</a>
                                        @else
                                        <a class="btn btn-default btn-sm" href="{{ route('usermanagement.manage' ,$activity->causer_id) }}">{{ App\Models\User::find($activity->causer_id)->name }}</a> --}}
                                       @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! Activity found
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- hello worl --}}