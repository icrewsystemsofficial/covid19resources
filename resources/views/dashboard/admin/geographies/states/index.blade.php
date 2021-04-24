@extends('layouts.atlantis')
@section('title', 'Districts Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#geographies_table').DataTable();
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
                            <th>Status</th>
                            <th>Last Updated</th>
                        </thead>
                        <tbody>
                            <script>
                                var verified = 0;
                                var refuted = 0;
                                var pending = 0;
                            </script>
                            @forelse ($states as $state)
                                <tr>
                                    <td>
                                        {{ $state->name }}
                                    
                                    </td>
                                    <td>
                                        {{ $state->code }}
                                    </td>
                                    <td>
                                        {{ $state->type }}
                                    </td>
                                    <td>
                                        {{ $state->capital }}
                                    </td>
                                    <td>
                                        {{ $state->districts }}
                                    </td>
                                    <td>
                                        @if ($state->verified == 1)
                                            <span class="badge badge-success">
                                                Verified <i class="fas fa-check"></i>
                                            </span>
                                            <script>
                                                verified = verified + 1;
                                            </script>
                                        @elseif($state->verified == 2)
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
                                        {{ $geography->created_at->format('d/m/Y H:i A') }}
                                    </td> --}}
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
