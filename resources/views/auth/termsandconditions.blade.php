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
            {{ config('app.name') }}
        </h1>
        <p class="subtitle text-white op-7">
            A curated repository of #verified COVID19 resources across India. Our databases are updated
            in "real-time". Spread the word, awareness is the first step in this battle.
        </p>
    </div>
    <div class="login-aside w-50 d-flex align-items-left justify-content-left bg-white">
        <div class="container container-login container-transparent animated fadeIn" style="display: block;">
            <h3 class="text-center">Terms and Conditions</h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <p>
                Thank you for choosing to volunteer at {{ config('app.name') }}. Before we begin,
                    we need to make sure that you know what it takes to be a volunteer for {{ config('app.name') }}
            </p>
            <!-- Validation Errors -->
            <ol>
                <li class="mb-2">
                    This is an online-tool that curates data from sources mainly Twitter, and then user-fed information.
                    Your duty as a volunteer would be to verify the authenticity of that information.
                </li>

                <li class="mb-2">
                    You are informed that you'll be required to make phone calls to verify resources.
                    {{ config('app.name') }} or ICREWSYSTEMS SOFTWARE ENGINEERING LLP will not be
                    able to cover the charges.
                </li>

                <li>
                    You are eligible for a certificate of apprecitation acknowledging your efforts,
                    This certificate will be provided ONLY after you fullfil the points criteria.
                </li>
              </ol>
              <form class="needs-validation" action="{{ route('register') }}">
                <div class="form-group">
                 <div class="form-check">
                    <input class="form-check-input position-static"  name="volunteerterms"type="checkbox" id="invalidCheck" value="accepted" required>
                    <label class="form-check-label" for="invalidCheck">
                         I agree to the above mentioned terms
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
              </div>
              <button class="btn btn-primary ml-3" type="submit">
                  Continue
              </button>
            </form>
    </div>
</div>
@endsection
