@extends('layouts.atlantis')
@section('title', 'Your Profile')
@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="col-md-8 col-md-6">
                    <h2 class="text-white pb-2 fw-bold">{{ config('app.name') }}</h2>
                    <h5 class="text-white op-7 mb-2">State Wise COVID19 Resources. Awareness is the first step in this battle.</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Your Details
                        </h4>
                    </div>

                    <div class="card-body">
                        {{-- Name --}}
                        <div class="row mb-3 align-items-center">
                            <div class="col-12 col-md-3 offset-md-1 mb-3 mb-md-0">
                                <h4 class="fw-bold text-uppercase">Name</h4>
                            </div>                            
                            <div class="col-12 col-md-5 mb-3">
                                <input type="text" class="form-control fw-bold text-black text-uppercase" value="{{$user->name}}" readonly>
                            </div>                            
                        </div>
                        {{-- Volunteer Or Not --}}
                        <div class="row mb-3 align-items-center">
                            <div class="col-12 col-md-3 offset-md-1 mb-3 mb-md-0">
                                <h4 class="fw-bold text-uppercase">Is Volunteer</h4>
                            </div>                            
                            <div class="col-12 col-md-5 mb-3">
                                <?php
                                if ($user->hasRole('volunteer'))
                                    $volunteer = 'YES';
                                else
                                    $volunteer = 'NO';                                
                                ?>
                                <input type="text" class="form-control fw-bold text-black" value="{{ $volunteer }}" readonly>
                            </div>                            
                        </div>
                        {{-- State --}}
                        <div class="row mb-3 align-items-center">
                            <div class="col-12 col-md-3 offset-md-1 mb-3 mb-md-0">
                                <h4 class="fw-bold text-uppercase">State</h4>
                            </div>                            
                            <div class="col-12 col-md-5 mb-3">
                                <?php
                                    if($user->state == null)
                                        $user->state = 'NOT SET YET';
                                ?>
                                <input type="text" class="form-control fw-bold text-black" value="{{$user->state}}" readonly>
                            </div>                            
                        </div>
                        {{-- Available for mission --}}
                        <div class="row mb-3 align-items-center">
                            <div class="col-12 col-md-3 offset-md-1 mb-3 mb-md-0">
                                <h4 class="fw-bold text-uppercase">Available For Mission</h4>
                            </div>                            
                            <div class="col-12 col-md-5 mb-3">
                                <?php
                                if ($user->available_for_mission == 1)
                                    $available_for_mission = 'YES';
                                else
                                    $available_for_mission = 'NO';                                
                                ?>
                                <input type="text" class="form-control fw-bold text-black" value="{{ $available_for_mission }}" readonly>
                            </div>                            
                        </div>
                        {{-- Action Buttons --}}
                        <div class="form-group row align-items-center justify-content-around justify-content-md-center mb-3">
                            <a href="/" class="btn btn-primary mt-3 mr-4 fw-bold">BACK</a>
                            <a href="{{ route('home.profile.edit') }}" class="btn btn-success mt-3 mr-4 fw-bold">UPDATE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection