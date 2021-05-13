@extends('layouts.atlantis')
@section('title', 'Manage Resource')
@section('js')
    {{-- <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
    <script>

        // $(document).ready(function() {
        //     $('.select2').select2();
        // });

        // CKEDITOR.replace('desc');

        function changeWhatsappStatus() {

        var button = document.getElementById('choose_status_button');
        button.disabled = true;
        button.innerHTML = "Loading...";

        var whatsapp_id = "{{ $whatsapp->id }}";
        var status = document.getElementById('choose_status').value;

            axios.get('/whatsapp/change-status/' + whatsapp_id + '/' + status)
            .then(function(response){
                console.log(response);
                window.location.reload();
            })
            .catch(function(error) {
                alert('Whoops! Something went wrong while changing the status of the tweet. Please contact admins');
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
        } else if(status == 3) {
            button.classList = "btn btn-block btn-danger";
            button.innerHTML = "Mark Spam";
        } else if(status == 4) {
            button.classList = "btn btn-block btn-danger";
            button.innerHTML = "Mark Inadequate";
        }


        }
    </script>
@endsection
@section('content')
   
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Whatsapp Resource
                    </h4>
                </div>
                <div class="card-body" id="twitterstream_running">
                    <div class="alert alert-info">
                        <h4 class="mt-3 b-b1 mb-2">
                            <span id="tweeter_name">{{ $whatsapp->title }}</span> 
                            @php
                                $value = date("Y-m-d H:i:s", strtotime($whatsapp->whatsapp_timestamp));
                                $time = Carbon\Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('d/m/Y H:i A');
                            @endphp
                            <span id="timeAgo"> {{ $time }} </span>
                        </h4>
                        <div id="tweet_box">
                            {{ $whatsapp->body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage this Whatsapp Resource</h4>
                </div>
                <div class="card-body">
                    <p class="mt-2">
                        This message is currently marked as <span class="badge badge-{{ $whatsapp->getStatus()->color }}">{{ strtoupper($whatsapp->getStatus()->name) }}</span>
                    </p>

                    <div class="">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label for="choose_status">Choose Message Status</label>
                                    <select id="choose_status" onchange="choose_status_change(this.value);" class="form-control">
                                        <option value="0" disabled @if($whatsapp->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if($whatsapp->status == 1) selected @endif>Verified</option>
                                        <option value="2" @if($whatsapp->status == 2) selected @endif>Refuted</option>
                                        <option value="3" @if($whatsapp->status == 3) selected @endif>Spam</option>
                                        <option value="4" @if($whatsapp->status == 4) selected @endif>Inadequate Information</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button id="choose_status_button" onclick="changeTweetStatus();" type="button" class="btn btn-block btn-black" disabled>
                                        Choose status
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($tweet->status == 1)
                            <a href="{{ route('admin.twitter.convert', $tweet->id) }}" class="btn btn-success btn-lg mb-3 mt-3">
                                Convert to RESOURCE
                            </a>

                            <br>
                            <span class="text-muted mt-2">
                                <i class="fa fa-check-circle text-success"></i> Success:
                                This tweet as been marked as verified, you can now convert it into a resource.
                            </span>
                            @else
                                <button class="btn btn-dark btn-lg mt-3 mb-3" disabled>
                                    Convert to RESOURCE
                                </button>
                                <br>
                                <span class="text-muted mt-2">
                                    <i class="fa fa-exclamation-triangle text-warning"></i> Error: To convert a tweet into a resource, the status to be "Verified"
                                    <br>
                                    <ol class="text-left mt-4 list">
                                        <li>
                                            Call the phone number / Visit the URL mentioned in the Tweet
                                        </li>
                                        <li>
                                            Mark it as "VERIFIED" only after you get positive response from the source
                                        </li>
                                    </ol>
                                </span>
                        @endif

                        <br>


                        @if (count($resources) > 0)
                        <div class="accordion mt-2">
                            <div class="">
                                <a class="btn btn-block btn-success text-white" data-toggle="collapse" data-target="#resourcesAccordion" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="">{{ count($resources) }} </span> resources generated from this Tweet.
                                </a>
                                <div id="resourcesAccordion" class="collapse" aria-labelledby="headingOne">
                                    <div class="card-body">
                                        @foreach ($resources as $resource)
                                            @php
                                                if($resource->verified == 0) {
                                                    $rcolor = 'warning';
                                                } else if($resource->verified == 1) {
                                                    $rcolor = 'success';
                                                } else if($resource->verified == 2) {
                                                    $rcolor = 'danger';
                                                } else if($resource->verified == 3) {
                                                    $rcolor = 'danger';
                                                }
                                                 else {
                                                    $rcolor = 'dark';
                                                }
                                            @endphp
                                            <div class="alert alert-{{ $rcolor }}">
                                                <span class="text-left text-muted mt-3 b-b1 mb-2">
                                                    Updated {{ $resource->updated_at->diffForHumans() }}
                                                </span>
                                                <div class="mt-2">
                                                    <h3>{{ $resource->title }}</h3>
                                                </div>
                                                <span class="text-muted ">
                                                    <small>
                                                        FEATURE: If Tweet Status is != Resource Status, Add a single button to change
                                                    status of all resources with "tweet_id".
                                                    </small>
                                                </span>
                                                <br><br>
                                                <a href="{{ route('admin.resources.manage', $resource->id) }}" target="_blank" id="status_link" class="btn btn-primary">
                                                    Manage
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif


                    </div>

                    <form style="display: none;" action="{{ route('admin.whatsapp.update', $tweet->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="title"><strong>Name</strong></label>
                            <input type="text" name="name" class="form-control" required value="{{ $tweet->title }}" />
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">
                                        <strong>Category</strong>
                                    </label>

                                    <select name="category" class="form-control select2">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @php if($tweet->category == $category->id) { echo "selected"; } @endphp>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="category">
                                        <strong>Phone Number</strong>
                                    </label>

                                    <input type="text" class="form-control" name="phone" value="{{ $tweet->phone }}" placeholder="Phone Number (with area code)">
                                </div>

                                <div class="form-group">
                                    <label for="category">
                                        <strong>URL</strong>
                                    </label>

                                    <input type="text" class="form-control" name="url" value="{{ $tweet->url }}" placeholder="URL (website, social media link)">
                                </div> --}}
                            </div>




                        </div>


                        <div class="form-group">
                            <label for="description"><strong>Body</strong></label>
                            <textarea class="form-control" name="body" id="desc" cols="30" rows="10">{{ $tweet->tweet }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="author_id">Author</label>

                            <input type="text" class="form-control" value=" {{ $tweet->username }}" disabled>

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
                                        if($tweet->status == '0') {
                                            $color = 'warning';
                                        } else if($tweet->status == '1') {
                                            $color = 'success';
                                        } else if($tweet->status == '2') {
                                            $color = 'danger';
                                        } else {
                                            $color = 'danger';
                                        }
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100" id="selectGroup">
                                        <label class="selectgroup-city success">
                                            <input onclick="changeSelectorColor('success');" type="radio" name="status" value="1" class="selectgroup-input" <?php if($tweet->status == 1) { echo "checked";  } ?>>
                                            <span class="selectgroup-button">Verified <i class="fa fa-check-circle"></i></span>
                                        </label>
                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('warning');" type="radio" name="status" value="0" class="selectgroup-input" <?php if($tweet->status == 0) { echo "checked"; } ?>>
                                            <span class="selectgroup-button">Unknown <i class="fa fa-exclamation-triangle"></i></span>
                                        </label>

                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('danger');" type="radio" name="status" value="2" class="selectgroup-input" <?php if($tweet->status == 2) { echo "checked"; } ?>>
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
                            <a href="{{ route('admin.twitter.update', $tweet->id) }}" onclick="return confirm('Are you sure you wish to delete this resource? This action cannot be undone');" class="btn btn-danger btn-md">Delete</a>
                            <!-- Button to Open the Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
