@extends('layouts.atlantis')
@section('title', 'Manage Resource')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

        CKEDITOR.replace('desc');
    </script>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white pb-2 fw-bold">

                    Tweet by {{ $tweet->username }} <i class="fab fa-twitter"></i>
                </h2>
                <h5 class="text-white op-7 mb-2">
                    This tweet was fetched using TwitterScanner {{ $tweet->created_at->diffForHumans() }}
                </h5>
            </div>

            <div class="col-md-4 text-right">
                {{-- <a href="{{ route('home.report', $tweet->id) }}" class="btn btn-lg btn-white hvr-bounce-in">
                    Report this resource <i class="ml-2 fa fa-exclamation-triangle text-danger"></i>
                </a> --}}

                @if ($tweet->verified == 1)
                        <span class="btn btn-success">
                            Verified <i class="fas fa-check"></i>
                        </span>
                    @elseif($tweet->verified == 2)
                        <span class="btn btn-danger">
                            Refuted <i class="fas fa-times"></i>
                        </span>
                    @else
                        <span class="btn btn-warning">
                            Pending <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @endif
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Tweet
                    </h4>
                </div>
                <div class="card-body" id="twitterstream_running">
                    <div class="alert alert-info">
                        <h4 class="mt-3 b-b1 mb-2">
                            <span id="tweeter_name">{{ $tweet->fullname }}</span> (<a href="#" class="text-primary" id="tweeter_username" target="_blank">{{ $tweet->username }}</a>) &bull;
                            @php
                                $value = date("Y-m-d H:i:s", strtotime($tweet->tweet_timestamp));
                                $time = Carbon\Carbon::parse($value . '  UTC')->tz('Asia/Kolkata')->format('d/m/Y H:i A');
                            @endphp
                            <span id="timeAgo"> {{ $time }} </span>
                        </h4>
                        <div id="tweet_box">
                            {{ $tweet->tweet }}
                        </div>
                    </div>
                        <span class="text-muted">
                            <small>
                                If the full tweet is not available, view it on twitter website
                            </small>
                        </span>
                        <br><br>
                        <a href="https://twitter.com/{{ $tweet->username }}" target="_blank" id="status_link" class="btn btn-primary">
                            View on <i class="fab fa-twitter"></i>
                        </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage this tweet</h4>
                </div>
                <div class="card-body">
                    <p class="mt-2">
                        This tweet is currently marked as <span class="badge badge-warning">PENDING</span>
                        <br>
                        There are <span class="badge badge-primary">2</span> resources generated from this Tweet.
                    </p>

                    <div class="text-center">
                        <button class="btn btn-danger btn-lg">
                            Mark as REFUTED
                        </button>

                        <button class="btn btn-success btn-lg">
                            Convert to RESOURCE
                        </button>
                    </div>

                    <form style="display: none;" action="{{ route('admin.twitter.update', $tweet->id) }}" method="post">
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
                                        if($tweet->verified == '0') {
                                            $color = 'warning';
                                        } else if($tweet->verified == '1') {
                                            $color = 'success';
                                        } else if($tweet->verified == '2') {
                                            $color = 'danger';
                                        } else {
                                            $color = 'danger';
                                        }
                                    @endphp
                                    <div class="selectgroup selectgroup-{{ $color }} w-100" id="selectGroup">
                                        <label class="selectgroup-city success">
                                            <input onclick="changeSelectorColor('success');" type="radio" name="status" value="1" class="selectgroup-input" <?php if($tweet->verified == 1) { echo "checked";  } ?>>
                                            <span class="selectgroup-button">Verified <i class="fa fa-check-circle"></i></span>
                                        </label>
                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('warning');" type="radio" name="status" value="0" class="selectgroup-input" <?php if($tweet->verified == 0) { echo "checked"; } ?>>
                                            <span class="selectgroup-button">Unknown <i class="fa fa-exclamation-triangle"></i></span>
                                        </label>

                                        <label class="selectgroup-city">
                                            <input onclick="changeSelectorColor('danger');" type="radio" name="status" value="2" class="selectgroup-input" <?php if($tweet->verified == 2) { echo "checked"; } ?>>
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
