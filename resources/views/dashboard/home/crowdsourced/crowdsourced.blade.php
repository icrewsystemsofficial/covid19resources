@extends('layouts.atlantis')
@section('title', 'crowdsourced')
@section('js')
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                Crowdsourced Resources
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
                        <table class="table" id="results_table">
                            <thead>
                                <th> <a type="button" class="btn btn-primary" href="{{ route('home.instagram') }}">Instagram</th>
                                <th> <a type="button" class="btn btn-primary" href="{{ route('home.websites') }}"> Websites</th>
                                <th> <a type="button" class="btn btn-primary" href="{{ route('home.helplines') }}">Helpline numbers</th>
                             </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
