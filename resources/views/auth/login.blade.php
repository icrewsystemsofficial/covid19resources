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
@section('js')
@endsection

@endsection
@section('content')
<div class="wrapper wrapper-login wrapper-login-full p-0">
    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
        <h1 class="title fw-bold text-white mb-3">
            {{ config('app.name') }}
        </h1>
        <p class="subtitle text-white op-7">
            A curated repository of #verified COVID19 resources across India. Our databases are updated
            in "real-time". Spread the word, awareness is the first step in this battle.
        </p>
    </div>
    <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
        <div class="container container-login container-transparent animated fadeIn" style="display: block;">
            <h3 class="text-center">Login to {{ config('app.name') }}</h3>
            <!-- Session Status -->
            {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

            <!-- Validation Errors -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="login-form">
                <div class="form-group">
                    <label for="email" class="placeholder"><b>Email</b></label>
                    <input id="email" name="email" type="text" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="password" class="placeholder"><b>Password</b></label>
                    <a href="{{ route('password.request') }}" class="link float-right">Forget Password ?</a>
                    <div class="position-relative">
                        <input id="password" name="password" type="password" class="form-control" required="">
                        <div class="show-password">
                            <i class="icon-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group form-action-d-flex mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="ber" id="remember_me">
                        <label class="custom-control-label m-0" for="remember_me">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
                </div>
                <div class="login-account">
                    <span class="msg">
                        Wish to Voulenteer?
                    </span>
                    <a href="{{ route('volunteer.registration') }}" class="link">Volunteer Registration</a>

                    <span class="msg">
                        Or just a normal user?
                    </span>
                    <a href="{{ route('register') }}" class="link">Registration</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
