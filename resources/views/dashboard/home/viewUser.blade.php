@extends('layouts.atlantis')
@section('title', 'Your Profile')
@section('content')
<style>
    .non-editable {
        pointer-events: none;
    }
    .form-group:hover {
        background-color: #f8f5f1;
    }
</style>
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
                        <div class="col-md-8 offset-md-2">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label class="fw-bold text-primary">Name</label>
                                        <input type="text" class="form-control non-editable" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label class="fw-bold text-primary">Email</label>
                                        <input type="email" class="form-control non-editable" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <?php
                                        if ($user->hasRole('volunteer')) {
                                            $volunteer = 'YES';
                                            $font_class = 'text-success';
                                        }
                                        else {
                                            $volunteer = 'NO';
                                            $font_class = 'text-danger';
                                        }
                                    ?>
                                    <div class="form-group form-group-default">
                                        <label class="fw-bold text-primary">Volunteer</label>
                                        <input type="text" class="form-control non-editable {{$font_class}}" name="volunteer" value="{{$volunteer}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                        if ($user->available_for_mission == 1) {
                                            $available_for_mission = 'YES';
                                            $font_class = 'text-success';
                                        }
                                        else {
                                            $available_for_mission = 'NO';
                                            $font_class = 'text-danger';
                                        }
                                    ?>
                                    <div class="form-group form-group-default">
                                        <label class="fw-bold text-primary">Available For Mission</label>
                                        <input type="text" class="form-control non-editable {{$font_class}}" name="volunteer" value="{{$available_for_mission}}">
                                    </div>
                                </div>
                                <div class="col-md-4">    
                                    <div class="form-group form-group-default">
                                        <label class="fw-bold text-primary">Referrals</label>
                                        <input type="text" class="form-control non-editable fw-bold" name="volunteer" value="{{$user->referrals}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <?php
                                            if($user->state == null)
                                                $user->state = 'NOT SET';
                                        ?>
                                        <label class="fw-bold text-primary">State</label>
                                        <input type="text" class="form-control non-editable" name="volunteer" value="{{$user->state}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <?php
                                            if($user->district == null)
                                                $user->district = 'NOT SET';
                                        ?>
                                        <label class="fw-bold text-primary">District</label>
                                        <input type="text" class="form-control non-editable" name="volunteer" value="{{$user->district}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="/" class="btn btn-primary mt-3 mr-4 fw-bold">BACK</a>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection