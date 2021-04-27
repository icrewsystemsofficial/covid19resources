@extends('layouts.atlantis')
@section('title', 'Filtered Results')
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
        <h4 class="page-title">Results Found <a href="#" class="btn btn-primary btn-rounded btn-sm">{{ count($search_results) }}</a></h4>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div>
                <form class="form-inline">
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
                  
                
                
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                  </form>
            </div>
            <br><br>

            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Manage Users <span class="badge badge-primary">{{ count($users) }}</span></h4>
                </div> --}}
                <div class="card-body">
                    <table id="users_table" class="table table-hover">
                        <thead>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Role</th>
                            <th>Location</th>
                            <th>Ref Signups</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </thead>
                        <tbody>
                            
                            {{-- @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{  implode('',$user->roles->pluck('name')->toArray()) }}</td>
                                    <td>{{ $user->district }} {{ $user->state }} </td>
                                    <td>{{ $user->referral_signups }}</td>
                                    <td class="text-center">
                                        @if ($user->accepted == 1)
                                            <span class="badge badge-success">
                                                Approved
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                Under Review
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No Categoriess added
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
