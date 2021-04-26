@extends('layouts.atlantis')
@section('title', 'Manage Resource')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>

        $(document).ready(function() {
            $('.select2').select2();
        // Ending jQuery document ready bracket.1
        });

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
                    option[index].value = city.name;

                    if(loaded_state == city.name) {
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


        // getCities('{{ $resource->state }}', '{{ $resource->city }}');
        CKEDITOR.replace('desc');
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-4">
        <a href="{{ route('admin.resources.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <a target="_blank" href="{{ route('home.view', $resource->id) }}" class="btn btn-success btn-sm mr-3">
            <i class="fas fa-eye"></i> View as normal user
        </a>
        <br>
        <h4 class="page-title">Manage resource # {{ $resource->id }}</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage resource Content</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.resources.update', $resource->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Name</strong></label>
                            <input type="text" name="name" class="form-control" required value="{{ $resource->title }}" />
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">
                                        <strong>Category</strong>
                                    </label>

                                    <select name="category" class="form-control select2">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @php if($resource->category == $category->id) { echo "selected"; } @endphp>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <strong>Phone Number</strong>
                                    </label>

                                    <input type="text" class="form-control" name="phone" value="{{ $resource->phone }}" placeholder="Phone Number (with area code)">
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <strong>URL</strong>
                                    </label>

                                    <input type="text" class="form-control" name="url" value="{{ $resource->url }}" placeholder="URL (website, social media link)">
                                </div>
                            </div>


                            <div class="col-md-8">
                                <span id="geography_options" style="display: block;">
                                    <div class="form-group">
                                        <label>
                                            <strong>Indexed Location</strong>
                                        </label>

                                        <input type="text" disabled value="{{ $resource->city.', '.$resource->district.', '.$resource->state }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="category">
                                            <strong>User input location (landmark)</strong>
                                        </label>

                                        <input type="text" disabled value="{{ $resource->landmark }}" class="form-control">
                                        <input type="hidden" name="city" value="{{ $resource->city }}">
                                        <input type="hidden" name="landmark" value="{{ $resource->landmark }}">
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
                                            getCities('{{ $resource->state }}', '{{ $resource->city }}');
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

                                        <select name="state" onchange="getCities(this.value, '{{ $resource->city }}');" class="form-control">
                                            @foreach ($states as $state)
                                                <option value="{{ $state->name }}" @php if($resource->state == $state->name) { echo "selected"; } @endphp>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">
                                            <strong>City</strong>
                                        </label>

                                        <select id="city" name="city" class="form-control">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="landmark"></label>
                                        <input type="text" class="form-control" name="landmark" value="{{ $resource->landmark }}" placeholder="Landmark / Full Address">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" onclick="toggleVisibilityforGeolocation();" class="btn btn-warning">
                                            Don't change
                                        </button>
                                    </div>
                                </span>
                            </div>


                        </div>


                        <div class="form-group">
                            <label for="description"><strong>Body</strong></label>
                            <textarea class="form-control" name="body" id="desc" cols="30" rows="10">{{ $resource->body }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="author_id">Author</label>

                            <input type="text" class="form-control" value=" {{ $resource->author_data->name }}" disabled>
                            <input type="hidden" class="form-control" name="author_id" value=" {{ $resource->author_id }}">

                            {{-- <select name="authour_id" id="" class="form-select select2">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @php if($resource->author_id == $user->id) { echo "selected"; } @endphp>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select> --}}
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    @php
                                        if($resource->verified == '0') {
                                            $color = 'warning';
                                        } else if($resource->verified == '1') {
                                            $color = 'success';
                                        } else if($resource->verified == '2') {
                                            $color = 'danger';
                                        }
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100" id="selectGroup">
                                        <label class="selectgroup-city success">
                                            <input onclick="changeSelectorColor('success');" type="radio" name="status" value="1" class="selectgroup-input" <?php if($resource->verified == 1) { echo "checked";  } ?>>
                                            <span class="selectgroup-button">Verified <i class="fa fa-check-circle"></i></span>
                                        </label>
                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('warning');" type="radio" name="status" value="0" class="selectgroup-input" <?php if($resource->verified == 0) { echo "checked"; } ?>>
                                            <span class="selectgroup-button">Unknown <i class="fa fa-exclamation-triangle"></i></span>
                                        </label>

                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('danger');" type="radio" name="status" value="2" class="selectgroup-input" <?php if($resource->verified == 2) { echo "checked"; } ?>>
                                            <span class="selectgroup-button">Refuted <i class="fa fa-times-circle"></i></span>
                                        </label>
                                    </div>

                                    <script>
                                        function changeSelectorColor(color) {
                                            var selectGroup = document.getElementById('selectGroup');
                                            selectGroup.className = "selectgroup selectgroup-" + color + " w-100";
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-info btn-md" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.resources.delete', $resource->id) }}" onclick="return confirm('Are you sure you wish to delete this resource? This action cannot be undone');" class="btn btn-danger btn-md">Delete</a>
                            <!-- Button to Open the Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
