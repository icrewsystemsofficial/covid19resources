@extends('layouts.atlantis')
@section('title', 'Whatsapp Admin')
@section('js')
    <script>
        $(document).ready( function () {
            $('#whatsapp_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Whatsapp Admin</h4>
    </div>
    <p>
        This is a collection of the latest information regarding the resources obtained from the Whatsapp Chatbot.
    </p>
    <div class="row mt-2">
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

            <br>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Resources from Whatsapp Chatbot <span class="badge badge-primary">{{ count($whatsapp) }}</span></h4>
                    
                </div>
                <div class="card-body">
                    <table id="whatsapp_record_table" class="table table-hover">
                        <thead>
                            <th>Title</th>
                            <th>Location</th>
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
                            @forelse ($whatsapp as $whatsapp_record)
                                <tr>
                                    <td>
                                        {{ $whatsapp_record->title }}
                                    </td>
                                    <td>
                                        @if($whatsapp_record->hasAddress == 1)
                                            {{ $whatsapp_record->city.', '.$whatsapp_record->district.', '.$whatsapp_record->state }}
                                            @else
                                            <span class="text-muted">
                                                Not applicable
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($whatsapp_record->verified == 1)
                                            <span class="badge badge-success">
                                                Verified <i class="fas fa-check"></i>
                                            </span>
                                            <script>
                                                verified = verified + 1;
                                            </script>
                                        @elseif($whatsapp_record->verified == 2)
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
                                    <td>
                                        {{ $whatsapp_record->updated_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.whatsapp.manage', $whatsapp_record->id) }}" class="btn btn-sm btn-primary">
                                            Manage
                                        </a>
                                        <a href="{{ route('admin.whatsapp.delete',$whatsapp_record->id) }}" class="btn btn-sm btn-danger">
                                            Dissolve
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    Whoops! No whatsapp records found.
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
