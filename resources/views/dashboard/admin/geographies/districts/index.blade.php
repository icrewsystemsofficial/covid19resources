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
        <h4 class="page-title">Districts Admin</h4>
    </div>
    <p>
        This is a collection of the latest information regarding the districts. There are a total of <span id="total"></span> districts available.
    </p>
    <div class="row">
        <div class="col-md-12">
            <br><br>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Districts <span class="badge badge-primary">{{ count($districts) }}</span></h4>
                    <div class="text-right">
                        <a href="{{ route('admin.geographies.districts.create') }}" class="btn btn-md btn-primary">
                            Add a new district <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="geography_table" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>State</th>
                            <th>Code</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Edit Record</th>
                        </thead>
                        <tbody>
                            @forelse ($districts as $district)
                                <tr>
                                    <td>
                                        {{ $district->name }}

                                    </td>
                                    <td>
                                        {{ $district->state }}
                                    </td>
                                    <td>
                                        @if ($district->code == 'null')
                                            <span class="text-danger">
                                                UNKNOWN
                                            </span>
                                            @else
                                                {{ $district->code }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $district->created_at->format('d/m/Y H:i A') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $district->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.geographies.districts.manage', $district->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No districts found.
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
