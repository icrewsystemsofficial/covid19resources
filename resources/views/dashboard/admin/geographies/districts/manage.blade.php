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


        CKEDITOR.replace('desc');
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-4">
        <a href="{{ route('admin.resources.index') }}" class="btn btn-warning btn-sm mr-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h4 class="page-title">Manage District</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage District Content</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.geographies.districts.update', $districts->id) }}" method="post">
                        @csrf
                        <div class="col-md-8">
                            <span id="geography" style="display: block;">
                                <div class="form-group">
                                    <label for="state">
                                        <strong>Change State / Union Territory</strong>
                                    </label>
                                    <select name="statedropdown" class="form-control select2" required="required">
                                        <option value="null" disabled selected>No state selected</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">
                                                {{ $state->name. ',' .$state->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </span>
                        </div>

                        
                        <div class="form-group">
                            <label for="author_id">Author</label>

                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            <input type="hidden" class="form-control" name="author_id" value=" {{ auth()->user()->id }}">

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
                                        $color = 'warning';
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100" id="selectGroup">
                                        <label class="selectgroup-city success">
                                            <input onclick="changeSelectorColor('success');" type="radio" name="status" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button">Verified <i class="fa fa-check-circle"></i></span>
                                        </label>
                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('warning');" type="radio" name="status" value="0" class="selectgroup-input">
                                            <span class="selectgroup-button">Unknown <i class="fa fa-exclamation-triangle"></i></span>
                                        </label>

                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('danger');" type="radio" name="status" value="2" class="selectgroup-input">
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
                            <button class="btn btn-info btn-md ml-2 mb-2" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.geographies.districts.delete', $districts->id) }}" onclick="return confirm('Are you sure you wish to delete this district? This action cannot be undone');" class="btn btn-danger btn-md mb-2 ml-2">Delete</a>
                            <!-- Button to Open the Modal -->
                        </div>
                       
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
