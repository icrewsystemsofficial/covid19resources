@extends('layouts.atlantis')
@section('title', 'Application Settings')
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
        <h4 class="page-title">Application Settings</h4>
    </div>
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('admin.setting.add') }}" class="btn btn-md btn-primary">
                Add a new setting <i class="fas fa-plus"></i>
            </a>

            <br><br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage App Settings </h4>
                </div>
                <div class="card-body">
                    <table id="users_table" class="table table-hover">
                        <thead>
                            <th>Setting #</th>
                            <th>Setting Name</th>
                            <th>Setting Value</th>
                            <th>Setting Core</th>
                            <th>Manage</th>
                        </thead>
                        <tbody>
                            @forelse ($settings as $setting)
                                <tr>
                                    <td>{{ $setting->id }}</td>
                                    <td>{{ $setting->name }}</td>
                                    <td>{{ $setting->value }}</td>
                                    <td class="text-center">
                                        @if ($setting->core == 1)
                                            <span class="btn btn-success btn-sm">
                                                Yes
                                            </span>
                                        @else
                                            <span class="btn btn-warning btn-sm">
                                                No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.setting.edit', $setting->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No settings added
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
