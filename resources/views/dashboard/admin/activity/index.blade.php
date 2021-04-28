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
        <h4 class="page-title">Activity logs

            <span class="text-muted">
                <small>
                    This logs the different actions users perform in this application.
                </small>
            </span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage logs <span class="badge badge-primary">{{ $activities->count() }}</span></h4>
                </div>
                <div class="card-body">
                    <table id="activity_table" class="table table-hover">
                        <thead>
                            <th>Log #</th>
                            <th>Activity</th>
                            <th>Logged By</th>
                            <th>When</th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($activities as $activity)
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->description }}</td>
                                    {{-- <td>
                                        {{ App\Models\User::find($activity->causer_id)->name }}</td> --}}
                                      <td>
                                          @if($activity->causer_id == 'null')
                                          <a href="#" class="btn btn-danger btn-xs text-white">System</a>
                                          @else
                                          <a class="btn btn-xs btn-info text-white" >{{ App\Models\User::find($activity->causer_id)->name }}</a>
                                          @endif
                                      </td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- hello worl --}}
