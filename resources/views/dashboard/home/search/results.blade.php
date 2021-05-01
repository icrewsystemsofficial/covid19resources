@extends('layouts.atlantis')
@section('title', 'Search')
@section('js')
    <script>
        $('#results_table').DataTable();
    </script>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                    {{ count($results) }} results found for {{ $query }}
                </h1>
                <p class="text-white h4">
                    Query the {{ config('app.name') }} database directly
                </p>
            </div>

        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('home.search.results') }}" class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="col-md-12">
                            <center>
                                <div class="input-group">
                                    <input name="query" type="text" value="{{ $query }}" placeholder="What are you looking for?" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-search pl-4">
                                            <i class="fa fa-search search-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>
                                Powered by Algolia
                            </center>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table" id="results_table">
                            <thead>
                                <th>Data</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Options</th>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td>{{ $result->tweet }}</td>
                                        <td>
                                            <span class="text-primary">
                                                Tweet <i class="fab fa-twitter"></i>
                                            </span>
                                        </td>
                                        <td>{{ $result->created_at->format('d/m/Y H:i A') }}</td>
                                        <td>{{ $result->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.twitter.manage', $result->id) }}" class="btn btn-primary" target="_blank">Manage Tweet</a> 
                                            <a href="{{ route('home.search.view', $result->id) }}" class="btn btn-primary btn-sm" target="_blank">View Tweet</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
