@extends('layouts.authentication')
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
@endsection
@section('content')
<div class="wrapper wrapper-login wrapper-login-full p-0">
    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
        <h1 class="title fw-bold text-white mb-3">
            Together against COVID19
        </h1>
        <p class="subtitle text-white op-7">
            Awareness is the first step against the COVID 19 in this battle. Let's make our fellow people aware
            in the best way we know.
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
                <div class="form-group form-action-d-flex mb-3">
                    {{-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember_me">
                        <label class="custom-control-label m-0" for="remember_me">Remember Me</label>
                    </div> --}}
                    <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
                </div>
                <div class="login-account">
                    <span class="msg">
                        Already a volunteer?
                    </span>
                    <a href="{{ route('login') }}" class="link">Register</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
