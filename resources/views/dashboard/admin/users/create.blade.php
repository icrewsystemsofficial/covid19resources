@extends('layouts.atlantis')
@section('title', 'User Admin')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function getCities(state_name) {
            var selector = document.getElementById('city');
            $('#city').select2();


            axios.get('http://covid19resources.test/api/v1/cities/' + state_name)
            .then(function (response) {
                // handle success   
                var selector = document.getElementById('city');
                selector.innerHTML = '';
                var cities = response.data.districts;
                var option = [];
                cities.forEach((city, index) => {
                    option[index] = document.createElement("option");
                    option[index].text = city.name + ', ' + city.district;
                    option[index].value = city.name + ', ' + city.district;

                    // if(loaded_state == city.name) {
                    //     option[index].selected = true;
                    // }

                    selector.appendChild(option[index]);
                });
            })
            .catch(function (error) {
                // handle error
                alert('Something went wrong! Please report this ASAP to the developers');
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }
    </script>
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
<div class="page-inner">
    <div class="page-header mt-4">
        <a href="{{ route('admin.user.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="page-title">User Admin</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create User </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Name</strong></label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter User name" />
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter User email" />
                        </div>

                        <div class="form-group">
                            <label for="title"><strong>Password</strong></label>
                            <input type="text" name="password" class="form-control" required placeholder="Enter User password min 8 characters" />
                        </div>

                        <div class="form-group">
                            <label for="text"><strong>Confirm Password</strong></label>
                            <input type="text" name="password_confirmation" class="form-control" required placeholder="Confrim Password" />
                        </div>
            
                       <div class="form-group">
                           <div class="row">
                               <div class="col-md-5">
                                   <label for="state">State</label>
                                <select name="state" onchange="getCities(this.value);" class="form-control" required="required">
                                    <option value="null" selected disabled>Select State / UT</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                               </div>
                               <div class="col-md-5">
                                <label for="district">District</label>
                                 <select id="city" name="district" class="form-control" required="required">
                                            <option value="null" selected>Select State / UT first</option>
                                        </select>
                               </div>
                           </div>
					</div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">User Role</label>
                                <select name="role" class="form-control" id="role">
                                   <option disabled>Select User Role</option>
                                   @foreach ($roles as $role)
                                       <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">User Status</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="accepted" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button">Accepted</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="accepted" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button">Under Review</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
