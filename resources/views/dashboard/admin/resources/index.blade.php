@extends('layouts.atlantis')
@section('title', 'Resources Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#resource_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Resources Admin</h4>
    </div>
    <p>
        This is a collection of the latest information regarding the resources. There are a total of <span id="total"></span> resources available.
    </p>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fa fa-check-circle text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Verified</p>
                                        <h4 class="card-title" id="verified">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fa fa-exclamation-triangle text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Pending</p>
                                        <h4 class="card-title" id="pending">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Refuted</p>
                                        <h4 class="card-title" id="refuted">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br><br>

            <a href="{{ route('admin.resources.export') }}" class="btn btn-primary btn-sm mb-2"><i class="fas fa-download"></i> Export Resources Data</a>
            <br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage resources <span class="badge badge-primary">{{ count($resources) }}</span></h4>
                    <div class="text-right">
                        <a href="{{ route('admin.resources.create') }}" class="btn btn-md btn-primary">
                            Add a new resource <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="resource_table" class="table table-hover">
                        <thead>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Added by</th>
                            <th>Status</th>
                            {{-- <th>Created</th> --}}
                            <th>Last Updated</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                            <script>
                                var verified = 0;
                                var refuted = 0;
                                var pending = 0;
                            </script>
                            @forelse ($resources as $resource)
                                <tr>
                                    <td>
                                        {{ $resource->title }}
                                        <br><br>
                                        <small>
                                            <span class="badge badge-primary">
                                                {{ $resource->category_data->name }}
                                            </span>
                                        </small>
                                        <br><br>
                                    </td>
                                    <td>
                                        @if($resource->hasAddress == 1)
                                            {{ $resource->city.', '.$resource->district.', '.$resource->state }}
                                            @else
                                            <span class="text-muted">
                                                Not applicable
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $resource->author_data->name }}
                                    </td>
                                    <td>
                                        @if ($resource->verified == 1)
                                            <span class="badge badge-success">
                                                Verified <i class="fas fa-check"></i>
                                            </span>
                                            <script>
                                                verified = verified + 1;
                                            </script>
                                        @elseif($resource->verified == 2)
                                            <span class="badge badge-danger">
                                                Refuted <i class="fas fa-times"></i>
                                            </span>
                                            <script>
                                                refuted = refuted + 1;
                                            </script>
                                        @else
                                            <span class="badge badge-warning">
                                                Pending <i class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <script>
                                                pending = pending + 1;
                                            </script>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        {{ $resource->created_at->format('d/m/Y H:i A') }}
                                    </td> --}}
                                    <td class="text-center">
                                        {{ $resource->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.resources.manage', $resource->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No resources found.
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
