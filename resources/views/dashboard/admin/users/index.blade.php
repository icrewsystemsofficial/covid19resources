@extends('layouts.atlantis')
@section('title', 'Users Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#users_table').DataTable();
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

            <a href="{{ route('admin.user.create') }}" class="btn btn-md btn-primary">
                Create new User <i class="fas fa-plus"></i>
            </a>


            <br><br>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Manage Users <span class="badge badge-primary">{{ count($users) }}</span></h4>
    
                        <a href="{{ route('admin.user.export') }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Export Users Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users_table" class="table table-hover">
                            <thead>
                                <th>User #</th>
                                <th>User Name</th>
                                <th>User Role</th>
                                <th>Location</th>
                                <th>Ref Signups</th>
                                {{-- <th>Status</th> --}}
                                <th>Manage</th>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}
                                            <br>
                                            <small>
                                                {{ $user->email }}
                                            </small>
                                        </td>
                                        <td>{{  ucfirst(implode('',$user->roles->pluck('name')->toArray())) }}</td>
                                        <td>{{ $user->district }} {{ $user->state }} </td>
                                        <td>{{ $user->referrals }}</td>
                                        {{-- <td class="text-center">
                                            @if ($user->accepted == 1)
                                                <span class="badge badge-success">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    Under Review
                                                </span>
                                            @endif
                                        </td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                Manage
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        Whoops! No users found
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
