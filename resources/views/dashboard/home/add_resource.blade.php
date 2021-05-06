@extends('layouts.atlantis')
@section('title', 'Dashboard')
@section('js')
<script src="https://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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

    $(document).ready(function() {
        $('.select2').select2();
    });

    CKEDITOR.replace('desc');

    function getCities(state_name) {
        var selector = document.getElementById('city');
        $('#city').select2();


        axios.get('cities/' + state_name)
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

@guest
<script>
    document.getElementById('submitbutton').disabled = true;
    function enableSubmitButton() {
        document.getElementById('submitbutton').disabled = false;
    }
</script>
@endguest

@endsection
@section('content')
<div class="panel-header bg-dark">
    <div class="page-inner py-5">
        <div class="d-flex align-`items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white h2 pb-2 fw-bold">
                    Add a resource
                </h2>
                <h5 class="text-white h6 mb-2">
                    We have about {{ $categories->count() }} categories in which you can add data, which will
                    be available to the public.
                </h5>
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
                        Things to keep in mind
                    </h4>
                </div>
                <div class="card-body">
                        <p class="mb-3">
                            <i class="fa fa-check-circle text-success"></i> Keep the title CLEAR, CRISP & CONCISE. Max 10 words
                            <br>
                            <i class="fa fa-check-circle text-success"></i> IMPORTANT! Verify & then include URLs & Phone Numbers in description
                            <br>
                            <i class="fa fa-check-circle text-success"></i> INCLUDE Source for your verification. Don't add any resource without hard-verifying it personally.
                            <br>
                            <i class="fa fa-times-circle text-danger"></i> Don't include Category / Expressive terms in title. We have seperate search-able columns for those.
                        </p>
                        <hr>
                        <br>
                        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('ocr.parse.text') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <p class="ml-2 p-2">
                                Have a <strong>screenshot</strong> from <strong>social media</strong>? We can convert the image contents to text. Why? Text can be used to filter & search in this website
                            </p>

                             <div class="col-md-4">
                                 <label for="OCR_upload">Choose File</label>
                                 <input type="file" class="form-control-file mt-1" name="image" id="OCR_upload">
                                 <small>(Max file size is 5mb allowed)</small>
                             </div>
                             <div class="col-5">
                               <button type="submit" class="btn btn-primary btn-sm">Convert to text</button>
                             </div>
                           </form>
                           <br>
                          <hr>
                          <br>
                        <form style="display: block;" action="{{ route('home.save.resource') }}" method="post">
                            @csrf
                           <div class="form-group">
                            <label for="title"><strong>Title</strong> <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Title for the resource" />
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">
                                        <strong>Category</strong> <span class="text-danger">*</span>
                                    </label>

                                    <select name="category" class="form-control select2">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <strong>Phone Number</strong> <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number (with area code)">
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <strong>URL</strong>
                                    </label>

                                    <input type="text" class="form-control" name="url" placeholder="URL (website, social media link)">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span id="geography" style="display: block;">
                                    <div class="form-group">
                                        <label for="state">
                                            <strong>State / Union Territory</strong> <span class="text-danger">*</span>
                                        </label>

                                        <select name="state" onchange="getCities(this.value);" class="form-control" required="required">
                                            <option value="null" selected>Select State / UT</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->name }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">
                                            <strong>City</strong>
                                            <br>
                                            <span class="text-muted">
                                                <small>
                                                    If not listed, choose "* Unavailable, * Check Landmark"
                                                </small>
                                            </span>
                                        </label>

                                        <select id="city" name="city" class="form-control" required="required">
                                            <option value="null" selected>Select State / UT first</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="landmark">
                                            Landmark
                                        </label>
                                        <input type="text" class="form-control" name="landmark" placeholder="Landmark / Full Address">
                                    </div>
                                </span>
                            </div>



                        </div>


                        <div class="form-group">
                            <label for="description"><strong>Body</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="body" id="desc" cols="30" rows="10">
                                @if (Cookie::get('parsedText'))
                                {{ Cookie::get('parsedText') }}
                               @else
                               <b>RESOURCE_NAME</b> is available in <b>LOCATION</b>, please contact phone number <b>PHONE_NUMBER</b>
                               for more information.

                               <br><br>

                               Verified on {{ date('d/m/Y H:i A') }}
                               @endif
                            </textarea>
                        </div>

                        @guest
                        <span class="mt-3 mb-3 text-muted">
                            You'll need an account to do this, it's really simple to make one. Already have an account? <a href="{{ route('login')}}" class="text-primary" target="_blank">Login</a>
                        </span>

                        <input type="hidden" name="create_account" value="1">

                        <div class="form-group">
                            <label for="name" class="placeholder"><b>Name</b></label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Your name" required="">
                        </div>

                        <div class="form-group">
                            <label for="email" class="placeholder"><b>Email</b></label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Your email" required="">
                        </div>

                        <div class="form-group">
                            <label for="state" class="placeholder"><b>State</b></label>
                            <select name="state" id="state" class="form-control">
                                @php
                                    $states = App\Models\States::all();
                                @endphp
                                @foreach ($states as $state)
                                    <option value="{{ $state->code }}">
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="password"><b>Password</b>
                            </label>
                            <div class="position-relative">
                                <input id="password" placeholder="Enter your password" name="password" type="password" class="form-control" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation"><b>Password</b>
                            </label>
                            <div class="position-relative">
                                <input id="password_confirmation" placeholder="..and confirm it again" name="password_confirmation" type="password" class="form-control" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" onclick="enableSubmitButton();" class="custom-control-input" name="registration_terms" id="registration_terms">
                                <label class="custom-control-label m-0" for="registration_terms">I accept the <a target="_blank" href="{{ route('home.terms') }}" class="text-primary">terms & conditions</a></label>
                            </div>
                        </div>


                    @endguest

                    @auth
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        <input type="hidden" class="form-control" name="author_id" value=" {{ auth()->user()->id }}">
                    </div>
                    @endauth



                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <div class="selectgroup selectgroup-success w-100" id="selectGroup">
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
                            <button id="submitbutton" class="btn btn-info btn-md" type="submit">
                                Add resource
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
