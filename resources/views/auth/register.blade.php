@extends('layouts.authentication')
@section('title', 'Register as a volunteer')
@section('js')
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            $.notify({
                icon: 'flaticon-error',
                title: "{{ config('app.name') }}",
                message: "{{ $error }}",
                },{
                type: 'danger',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 1000,
            });
        @endforeach
    @endif
</script>
{!! NoCaptcha::renderJs() !!}
@endsection
@section('content')
<div class="wrapper wrapper-login wrapper-login-full p-0">
    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
        <h1 class="title fw-bold text-white mb-3">
            {{ config('app.name') }}
        </h1>
        <p class="subtitle text-white op-7">
            We're confident, because we're being run by the YOUTH of this nation.
            Come be a part of an initative with {{ \App\Models\User::count() }}+ volunteers, across the country.
        </p>
    </div>
    <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
        <div class="container container-login container-transparent animated fadeIn" style="display: block;">
            <h3 class="text-center">Register to volunteer at {{ config('app.name') }}</h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if ($uuid == '')
            <input type="text" hidden>
        @else
            <input type="text" name="uuid" hidden value="{{ $uuid->id }}">
        @endif
            <div class="login-form">
                
                <div class="form-group">
                    <label for="name" class="placeholder"><b>Name</b></label>
                    <input id="name" name="name" type="text" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="email" class="placeholder"><b>Email</b></label>
                    <input id="email" name="email" type="text" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="phone" class="placeholder"><b>Phone Number</b></label>
                    <input id="phone" name="phone" type="text" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="state" class="placeholder"><b>State</b></label>
                    <select name="state" onchange="getDistricts(this.value);" id="state" class="form-control">
                        @foreach ($states as $state)
                            <option value="{{ $state->code }}">
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="password" class="placeholder"><b>Password</b></label>
                    <div class="position-relative">
                        <input id="password" name="password" type="password" class="form-control" required="">
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="placeholder"><b>Password Confirmation</b></label>
                    <div class="position-relative">
                        <input id="password_confirmation" name="password_confirmation" type="password_confirmation" class="form-control" required="">
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group form-action  ">
                    {!! NoCaptcha::display() !!}
                </div>
                <div class="form-group form-action-d-flex mb-3">
                  
                    <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Register</button>
                </div>
                
                <div class="login-account">
                    <span class="msg">
                        Already a volunteer?
                    </span>
                    <a href="{{ route('login') }}" class="link">Login</a>
                    |
                    <span class="msg">
                        Sign up for a generic account
                    </span>
                    <a href="{{ route('login') }}" class="link">Generic account</a>
                </div>


            </div>
        </div>
    </form>
    </div>
</div>
@endsection
