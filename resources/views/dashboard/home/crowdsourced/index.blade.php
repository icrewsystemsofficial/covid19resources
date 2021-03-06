@extends('layouts.atlantis')
@section('title', 'Crowdsourced Resources')
@section('js')
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                Crowd-Sourced Resources
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
                            <tbody">
                                <th> <a type="button" class="btn btn-dark text-white" href="{{ route('home.crowdsourced.websites') }}"><i class="fas fa-globe-asia mr-2"></i> Website Links</th>
                                <th> <a type="button" class="btn text-white" style="background-color: #DD2A7B" href="{{ route('home.crowdsourced.instagram') }}"><i class="fab fa-instagram mr-2"></i>Instagram Channels</th>
                                <th> <a type="button" class="btn text-white" style="background-color: #0088cc"  href="{{ route('home.crowdsourced.telegram') }}"><i class="fab fa-telegram-plane mr-2"></i>Telegram Channels</th>
                                <th> <a type="button" class="btn text-white" style="background-color: #7289da" href="{{ route('home.crowdsourced.discord') }}"><i class="fab fa-discord mr-2"></i>Discord Servers</th>
                                <th> <a type="button" class="btn btn-primary" href="{{ route('home.crowdsourced.helplines') }}"><i class="fas fa-phone mr-2"></i>Helpline numbers</th>
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
