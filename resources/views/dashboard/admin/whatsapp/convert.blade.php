@extends('layouts.atlantis')
@section('title', 'Manage Whatsapp Resource')
@section('js')
    <script src="https://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>

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

        function changeWhatsappStatus() {

        var button = document.getElementById('choose_status_button');
        button.disabled = true;
        button.innerHTML = "Loading...";

        var whatsapp_id = "{{ $whatsapp->id }}";
        var status = document.getElementById('choose_status').value;

            axios.get('whatsapp/change-status/' + whatsapp_id + '/' + status)
            .then(function(response){
                console.log(response);
                window.location.reload();
            })
            .catch(function(error) {
                alert('Whoops! Something went wrong while changing the status of the resource. Please contact admins');
            });

        }

        function choose_status_change(status, whatsapp_id = '') {
        var button = document.getElementById('choose_status_button');
        button.disabled = false;

        button.innerHTML = "Loading...";

        if(whatsapp_id == '') {
            whatsapp_id = "1";
        }

        if(status == 1) {
            button.classList = "btn btn-block btn-success";
            button.innerHTML = "Mark Verified";
        } else if(status == 2) {
            button.classList = "btn btn-block btn-warning";
            button.innerHTML = "Mark Refuted";
        } else {
            button.classList = "btn btn-block btn-danger";
            button.innerHTML = "Mark Spam";
        }


        }
    </script>
@endsection
@section('content')
@php
    if($whatsapp->status == 0) {
        $color = 'dark';
        $status = 'Pending';
        $panel_color = 'bg-dark';
    } else if($whatsapp->status == 1) {
        $color = 'success';
        $status = 'Verified';
        $panel_color = 'bg-success-gradient';
    } else if($whatsapp->status == 2) {
        $color = 'warning';
        $status = 'Refuted';
        $panel_color = 'bg-warning-gradient';
    } else if($whatsapp->status == 3) {
        $panel_color = 'bg-danger-gradient';
        $status = 'Spam';
        $color = 'danger';
    }
@endphp
<div class="panel-header {{ $panel_color }}">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white pb-2 fw-bold">

                    Resource by {{ $whatsapp->wa_name }} <i class="fab fa-whatsapp"></i>
                </h2>
                <h5 class="text-white op-7 mb-2">
                    This resource was fetched using a WhatsApp Chatbot {{ $whatsapp->created_at->diffForHumans() }}
                </h5>
            </div>

            <div class="col-md-4 text-right">
                {{-- <a href="{{ route('home.report', $tweet->id) }}" class="btn btn-lg btn-white hvr-bounce-in">
                    Report this resource <i class="ml-2 fa fa-exclamation-triangle text-danger"></i>
                </a> --}}

                    @if ($whatsapp->status == 1)
                        <span class="btn btn-white">
                            Verified <i class="fas fa-check text-{{ $color }}"></i>
                        </span>
                    @elseif($whatsapp->status == 2)
                        <span class="btn btn-white">
                            Refuted <i class="fas fa-times text-{{ $color }}"></i>
                        </span>
                    @elseif($whatsapp->status == 3)
                        <span class="btn btn-white">
                            Spam <i class="fas fa-exclamation-triangle text-{{ $color }}"></i>
                        </span>
                    @else
                        <span class="btn btn-white">
                            Unknown <i class="fas fa-exclamation-triangle text-{{ $color }}"></i>
                        </span>
                    @endif
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Whatsapp Resource
                    </h4>
                </div>
                <div class="card-body" id="twitterstream_running">
                    <div class="alert alert-info">
                        <h4 class="mt-3 b-b1 mb-2">
                            @php
                                $value = date("Y-m-d H:i:s", strtotime($whatsapp->timestamp));
                                $time = Carbon\Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('d/m/Y H:i A');
                            @endphp
                            <span id="timeAgo"> {{ $time }} </span>
                        </h4>
                        <div id="tweet_box">
                            {{ $whatsapp->body }}
                        </div>
                    </div>
                      
                        <br><br>
                        


                        

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Resource</h4>
                </div>
                <div class="card-body">
                    <form style="display: block;" action="{{ route('admin.whatsapp.convert.save', $whatsapp->id) }}" method="post">
                        @csrf
                        <p>
                            <i class="fa fa-check-circle text-success"></i> Keep the title CLEAR, CRISP & CONCISE. Max 10 words
                            <br>
                            <i class="fa fa-check-circle text-success"></i> IMPORTANT! Verify & then include URLs & Phone Numbers in description
                            <br>
                            <i class="fa fa-check-circle text-success"></i> Choose the appropriate category, and keep 1 resource for 1 category. If same resource fits in multiple categories, then create multiple resources.
                            <br>
                            <i class="fa fa-check-circle text-success"></i> INCLUDE Source for your verification. Don't add any resource without hard-verifying it personally.
                            <br>
                            <i class="fa fa-times-circle text-danger"></i> Don't include Category / Expressive terms in title. We have seperate search-able columns for those.
                        </p>

                        <div class="form-group">
                            <label for="title"><strong>Title</strong></label>
                            <input type="text" name="name" class="form-control" required placeholder="Title for the resource" />
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">
                                        <strong>Category</strong>
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
                                        <strong>Phone Number</strong>
                                    </label>

                                    <input type="text" class="form-control" name="phone" value="{{ $whatsapp->wa_phone }}" placeholder="Phone Number (with area code)">
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
                                            <strong>State / Union Territory</strong>
                                        </label>

                                        <select name="state" onchange="getCities(this.value);" class="form-control" required="required">
                                            <option value="null" selected disabled>Select State / UT</option>
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
                                        </label>

                                        <select id="city" name="city" class="form-control" required="required">
                                            <option value="null" selected>Select State / UT first</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="landmark"></label>
                                        <input type="text" class="form-control" name="landmark" placeholder="Landmark / Full Address">
                                    </div>
                                </span>
                            </div>



                        </div>


                        <div class="form-group">
                            <label for="description"><strong>Body</strong></label>
                            <textarea class="form-control" name="body" id="desc" cols="30" rows="10">
                                -- CONTENT --

                                This was verified by {{ auth()->user()->name }}
                                <br><br><hr>{{ $whatsapp->body }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="author_id">Author</label>

                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            <input type="hidden" class="form-control" name="author_id" value=" {{ auth()->user()->id }}">

                            {{-- <select name="authour_id" id="" class="form-select select2">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @php if($tweet->author_id == $user->id) { echo "selected"; } @endphp>
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
                                        if($whatsapp->status == '0') {
                                            $color = 'warning';
                                        } else if($whatsapp->status == '1') {
                                            $color = 'success';
                                        } else if($whatsapp->status == '2') {
                                            $color = 'danger';
                                        } else {
                                            $color = 'danger';
                                        }
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100" id="selectGroup">
                                        <label class="selectgroup-city success">
                                            <input onclick="changeSelectorColor('success');" type="radio" name="status" value="1" class="selectgroup-input" <?php if($whatsapp->status == 1) { echo "checked";  } ?>>
                                            <span class="selectgroup-button">Verified <i class="fa fa-check-circle"></i></span>
                                        </label>
                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('warning');" type="radio" name="status" value="0" class="selectgroup-input" <?php if($whatsapp->status == 0) { echo "checked"; } ?>>
                                            <span class="selectgroup-button">Unknown <i class="fa fa-exclamation-triangle"></i></span>
                                        </label>

                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('danger');" type="radio" name="status" value="2" class="selectgroup-input" <?php if($whatsapp->status == 2) { echo "checked"; } ?>>
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
                            <a href="{{ route('admin.whatsapp.update', $whatsapp->id) }}" onclick="return confirm('Are you sure you wish to delete this resource? This action cannot be undone');" class="btn btn-danger btn-md">Delete</a>
                            <!-- Button to Open the Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
