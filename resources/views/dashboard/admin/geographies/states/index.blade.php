@extends('layouts.atlantis')
@section('title', 'Districts Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#geography_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">States Admin</h4>
    </div>
    <p>
        This is a collection of the latest information regarding the states. There are a total of <span id="total"></span> states available.
    </p>
    <div class="row">
        <div class="col-md-12">
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage States / Union Territories <span class="badge badge-primary">{{ count($states) }}</span></h4>
                    <div class="text-right">
                        <a href="{{ route('admin.geographies.states.create') }}" class="btn btn-md btn-primary">
                            Add a new State / Union Territory <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="geography_table" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Capital</th>
                            <th>Districts</th>
                            <th>Cities</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Edit Record</th>
                        </thead>
                        <tbody>
                            @forelse ($states as $state)
                                <tr>
                                    <td>
                                        {{ $state->name }}

                                    </td>
                                    <td>
                                        {{ $state->code }}
                                    </td>
                                    <td>
                                        {{ Str::ucfirst($state->type) }}
                                    </td>
                                    <td>
                                        {{ $state->capital }}
                                    </td>
                                    <td>
                                        {{ $state->districts }}
                                    </td>
                                    <td>
                                        {{ $state->totalCities() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $state->created_at->format('d/m/Y H:i A') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $state->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.geographies.states.manage', $state->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No states / union territories found.
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
