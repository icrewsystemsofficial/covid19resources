@extends('layouts.atlantis')

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
                            Edit Your Details
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="/user/{{ $user->id }}" method="post">
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
                                <div class="form-group d-flex align-items-center justify-content-center mb-3">
                                    <a href="/" class="btn btn-primary mt-3 mr-4 fw-bold">BACK</a>
                                    <button type="submit" class="btn btn-success mt-3 mr-4 fw-bold">UPDATE</button>
                                </div>
                                {{-- <input type="submit" value="UPDATE" class="btn"> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection