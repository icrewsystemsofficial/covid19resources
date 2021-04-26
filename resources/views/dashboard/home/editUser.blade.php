@extends('layouts.atlantis')
@section('title', 'Edit Profile')
@section('content')
<style>
.switch input { 
    display:none;
}
.switch {
    display:inline-block;
    width:45px;
    height:20px;
    margin:8px;
    transform:translateY(50%);
    position:relative;
    cursor: pointer;
}
/* Style Wired */
.slider {
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    right:0;
    border-radius: 30px;
    box-shadow:0 0 0 2px #777, 0 0 4px #777;
    cursor:pointer;
    border:4px solid transparent;
    overflow:hidden;
        transition:.4s;
}
.slider:before {
    position:absolute;
    content:"";
    width:100%;
    height:100%;
    background:#777;
    border-radius:30px;
    transform:translateX(-20px);
    transition:.4s;
}

input:checked ~ .slider:before {
    transform:translateX(20px);
    background:limeGreen;
}
input:checked ~ .slider {
    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
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
                            Edit Your Details
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('home.profile.save') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="login-form">
                                <div class="form-group">
                                    <label for="name" class="placeholder"><b>Name</b></label>
                                    <input id="name" name="name" type="text" class="form-control" required="" value="{{ $user->name }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="placeholder"><b>Email</b></label>
                                    <input id="email" name="email" type="text" class="form-control" required="" value="{{ $user->email }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="placeholder"><b>Set New Password</b></label>
                                    <div class="position-relative">
                                        <input id="password" name="password" type="password" class="form-control">
                                        <div class="show-password">
                                            <i class="icon-eye"></i>
                                        </div>
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="placeholder"><b>Password Confirmation</b></label>
                                    <div class="position-relative">
                                        <input id="password_confirmation" name="password_confirmation" type="password_confirmation" class="form-control">
                                        <div class="show-password">
                                            <i class="icon-eye"></i>
                                        </div>
                                        @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                @if (!$user->phone_number)
                                    <div class="form-group">
                                        <label for="phone_number" class="placeholder"><b>Set Phone Number</b></label>
                                        <input id="phone_number" name="phone_number" type="text" class="form-control" required=""">
                                        @error('phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="phone_number" class="placeholder"><b>Phone Number</b></label>
                                        <input id="phone_number" name="phone_number" type="text" class="form-control" required="" value="{{ $user->phone_number }}">
                                        @error('phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                                <?php
                                    if($user->available_for_mission == 1) {
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }
                                ?>  
                                
                                <div class="d-flex align-items-center form-group">
                                    <div class="mt-3 mr-3">
                                        <h4 class="text-capitalize placeholder"><b>Available For Mission : <b></h4>
                                    </div>
                                    <label class="switch mx-2" checked>
                                        <input type="checkbox" name="available_for_mission" type="checkbox" class="hidden" {{ $checked }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                
                                <div class="form-group d-flex align-items-center justify-content-center mb-3">
                                    <a href="/" class="btn btn-primary mt-3 mr-4 fw-bold">BACK</a>
                                    <button type="submit" class="btn btn-success mt-3 mr-4 fw-bold">UPDATE</button>
                                </div>

                                <p href="#">ref link 
                                    {{ url('/').'/register?ref='.$user->referral_link.'&uuid='.$user->id}}
                                </p>

                                {{-- <input type="submit" value="UPDATE" class="btn"> --}}
                            </div>
                        </form>
{{-- 
                        @if(!Auth::user()->referral_link)
                            <input type="text" readonly="readonly" value="{{url('/').'/?ref='.Auth::user()->referral_link}}">
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
