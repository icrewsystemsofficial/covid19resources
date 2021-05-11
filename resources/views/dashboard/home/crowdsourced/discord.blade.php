@extends('layouts.atlantis')
@section('title', 'Discord')
@section('js')
   
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                Discord Crowdsourced Resource Servers
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr><td>Covid Fighters (India)</td><td> <a type="button" target="_blank" class="btn btn-primary" href="{{ url('https://discord.gg/VUrm3jKT') }}">Join Server</a></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection