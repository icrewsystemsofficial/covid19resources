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
            Volunteers Page
        </h1>
        <p class="subtitle text-white op-7">
            Accept the terms and conditions to start volunteering!
        </p>
    </div>
    <div class="login-aside w-50 d-flex align-items-left justify-content-left bg-white">
        <div class="container container-login container-transparent animated fadeIn" style="display: block;">
            <h3 class="text-center">Terms and Conditions</h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <ol>
                <li class="mb-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus sit in pariatur unde. Quos, libero nihil doloremque natus odio maiores?</li>

                <li class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe quas itaque error officia totam voluptatum molestiae qui facere atque id?</li>

                <li class="mb-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto assumenda, eum totam voluptatum libero molestias minus. At ipsa rerum doloribus?</li>

                <li class="mb-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus facilis tenetur natus qui nisi nostrum accusantium error porro nihil sapiente?</li>

                <li class="mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt qui animi esse quas fuga dicta modi, minima exercitationem! Aperiam, minima?</li>
              </ol>
              <form class="needs-validation" action="{{ route('volunteers.register') }}">
                <div class="form-group">
                 <div class="form-check">
                    <input class="form-check-input position-static"  name="volunteerterms"type="checkbox" id="invalidCheck" value="accepted" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
              </div>
              <button class="btn btn-primary ml-3" type="submit">Submit form</button>
            </form>
              <!--
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
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember_me">
                        <label class="custom-control-label m-0" for="remember_me">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
                </div>
                <div class="login-account">
                    <span class="msg">
                        Wish to Voulenteer?
                    </span>
                    <a href="{{ route('register') }}" class="link">Register</a>
                </div>
            </div>
        </div>
    </form>
-->
    </div>
</div>
@endsection
