@extends('layouts.atlantis')
@section('title', 'Cities Admin')
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
        <h4 class="page-title">Cities Admin</h4>
    </div>
    <p>
        This is a collection of the latest information regarding the cities. There are a total of <span id="total">{{ count($cities) }}</span> cities available.
    </p>
    <div class="row">
        <div class="col-md-12">
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Cities <span class="badge badge-primary">{{ count($cities) }}</span></h4>
                    <div class="text-right">
                        <a href="{{ route('admin.geographies.cities.create') }}" class="btn btn-md btn-primary">
                            Add a new City <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="geography_table" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>District</th>
                            <th>State</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Edit Record</th>
                        </thead>
                        <tbody>
                            @forelse ($cities as $city)
                                <tr>
                                    <td>
                                        {{ $city->name }}
                                    </td>
                                    <td>
                                        {{ $city->district }}
                                    </td>
                                    <td>
                                        {{ $city->state }}
                                    </td>
                                    <td class="text-center">
                                        {{ $city->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $city->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.geographies.cities.manage', $city->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No cities found.
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <script>
                        document.getElementById('verified').innerHTML = verified;
                        document.getElementById('pending').innerHTML = pending;
                        document.getElementById('refuted').innerHTML = refuted;

                        document.getElementById('total').innerHTML = verified + pending + refuted;
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
