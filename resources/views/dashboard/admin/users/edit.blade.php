@extends('layouts.atlantis')
@section('title', 'User Admin')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        
        function increaseBtnOnclick() {
        document.getElementById("points").value = Number(document.getElementById("points").value) + 1;
        }

        function decreaseBtnOnclick() {
        document.getElementById("points").value = Number(document.getElementById("points").value) - 1;
        }


        function getCities(state_name, loaded_state) {
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

                    if(loaded_state == city.name + ', ' + city.distric) {
                        option[index].selected = true;
                    }

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

        // user delete
    $('#deleteUser').click(function(e) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        buttons:{
            cancel: {
                visible: true,
                text : 'No, cancel!',
                className: 'btn btn-danger'
            },
            confirm: {
                text : 'Yes, delete it!',
                className : 'btn btn-success'
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            swal("Alright!, User deleted Successfully", {
                icon: "success",
                buttons : {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            });
            window.location="{{ route('admin.user.delete',$user->id) }}";
        } else {
            swal.close()
        }
    });
})
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
                    <h4 class="card-title">Edit User </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update',$user->id) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Name</strong></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required placeholder="Enter User name" />
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required placeholder="Enter User email" />
                        </div>

                    <div class="col-md-8">
                        <span id="geography_options" style="display: block;">
                            <div class="form-group">
                                <label>
                                    <strong>Indexed Location</strong>
                                </label>

                                <input type="text" disabled value="{{ $user->district.', '.$user->state }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="district" value="{{ $user->district }}">
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="toggleVisibilityforGeolocation();" class="btn btn-primary">
                                    Change Geography of this resource
                                </button>
                               
                            </div>

                            
                        </span>

                        <script>
                            function toggleVisibilityforGeolocation() {
                                var geography = document.getElementById("geography");
                                var geography_options = document.getElementById("geography_options");

                                if (geography.style.display === "none") {
                                    geography.style.display = "block";
                                    geography_options.style.display = "none";
                                    getCities('{{ $user->state }}', '{{ $user->district }}');
                                } else {
                                    geography.style.display = "none";
                                    geography_options.style.display = "block";
                                }
                            }
                        </script>


                        <span id="geography" style="display: none;">
                            <div class="form-group">
                                <label for="state">
                                    <strong>State / Union Territory</strong>
                                </label>

                                <select name="state" onchange="getCities(this.value,'{{ $user->district }}');" class="form-control">
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}" @php if($user->state == $state->name) { echo "selected"; } @endphp>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city">
                                    <strong>City</strong>
                                </label>

                                <select id="city" name="district" class="form-control">
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="button" onclick="toggleVisibilityforGeolocation();" class="btn btn-warning">
                                    Don't change
                                </button>
                            </div>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">User Role</label>
                                <select name="role" class="form-control" id="role">
                                   <option disabled>Select User Role</option>
                                   @foreach ($roles as $id => $role)

                                   @if($user->hasRole($role->name))
                                     @php
                                       $selected = 'selected';
                                     @endphp
                                   @else
                                     @php
                                       $selected = '';
                                     @endphp
                                   @endif

                                   <option value="{{$role->name}}" {{ $selected }}>{{ ucfirst($role->name) }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="points">Assign Points</label>
                                <input type="button" class="btn ml-2" name="decrease" value="-" onclick="decreaseBtnOnclick()"/><input type="text" class="form-group" name="points" value="0" id="points"/>
                                <input type="button" class="btn" name="increase" value="+" onclick="increaseBtnOnclick()"/>
                            </div>
                        </div>
                    </div>
                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">User Status</label>
                                        @php
                                        if($user->accepted == 1) {
                                            $color = 'success';
                                        } else if($user->accepted == 0) {
                                            $color = 'warning';
                                        }
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100 " id="selectGroup">
                                        <label class="selectgroup-item">
                                            <input type="radio"  onclick="changeSelectorColor('success');" name="accepted" value="1" {{ ($user->accepted == "1")? "checked" : "" }} class="selectgroup-input">
                                            <span class="selectgroup-button mr-1">Accepted <i class="fa fa-check-circle "></i></span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" onclick="changeSelectorColor('warning');" name="accepted" value="0" {{ ($user->accepted == "0")? "checked" : "" }} class="selectgroup-input  ">
                                            <span class="selectgroup-button mr-1">Under Review <i class="fa fa-exclamation-triangle "></i></span>
                                        </label>

                                        <script>
                                            function changeSelectorColor(color) {
                                                var selectGroup = document.getElementById('selectGroup');
                                                selectGroup.className = "selectgroup selectgroup-" + color + " w-100";
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Update User
                            </button>
                            <button class="btn btn-danger btn-md" type="button" id="deleteUser">
                                Delete User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--
<div class="form-group">
    <div class="row">
        <div class="col-md-5">
            <label for="state">State</label>
         <select name="state" onchange="getCities(this.value,);" class="form-control" required="required">
             <option value="null" selected disabled>Select State / UT</option>
             @foreach ($states as $state)
                 <option value="{{ $state->name }}" {{ $user->state === $state->name ? 'selected' : '' }}>
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
</div> --}}
@endsection
