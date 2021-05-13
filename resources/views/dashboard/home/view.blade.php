@extends('layouts.atlantis')
@section('title', 'Dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" integrity="sha512-SJw7jzjMYJhsEnN/BuxTWXkezA2cRanuB8TdCNMXFJjxG9ZGSKOX5P3j03H6kdMxalKHZ7vlBMB4CagFP/de0A==" crossorigin="anonymous" />
@endsection

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

<script>
	function copyClip() {
	    var copyText =  document.getElementById("phone");
	    copyText.select();
	    copyText.setSelectionRange(0, 99999);
	    document.execCommand("copy");
	    $.notify({
		    icon: 'flaticon-success',
		    title: "{{ config('app.name') }}",
		    message:"Mobile number "+ copyText.value + " copied",
		    },{
		    type: 'success',
		    placement: {
		        from: "top",
		        align: "right"
		    },
		    time: 1000,
		});
	}

	$("#txtarea").hide();
	$("#comment").hide();
	
	$( "#slct" ).change(function() {
	  var val = $("#slct").val();
	    if(val=="4"){
	        $("#txtarea").show();
	        $("#comment").show();
	    } else {
	        $("#txtarea").hide();
	    }
	});

</script>
@endsection
@section('content')
<div class="panel-header {{ $resource->getStatus()->gradient }}">
    <div class="page-inner py-5">
        <div class="d-flex align-`items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white h1 pb-2 fw-bold">
                    {{ $resource->getStatus()->name }} <i class="fas fa-{{ $resource->getStatus()->icon }}"></i>
                </h2>
                <h5 class="text-white h4 mb-2">
                    This resource was added {{ $resource->created_at->diffForHumans() }}@if ($resource->created_at != $resource->updated_at), and updated {{ $resource->updated_at->diffForHumans() }}.
                    @else
                    .
                    @endif
                </h5>
            </div>

            <div class="col-md-4 text-right">
                <a  data-toggle="modal" data-target="#reportModal" class="btn btn-lg btn-white hvr-bounce-in">
                    Report this resource <i class="ml-2 fa fa-exclamation-triangle text-danger"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $resource->title }}
                    </h4>
                </div>
                <div class="card-body">
                    {!! $resource->body !!}
                </div>
            </div>


            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title h6">
                        Comments
                    </h4>
                </div>

                <div class="card-body">
                    @if (!Auth::user())
                        <p class="text-danger">
                            Have something to ask / say about this resource? Please <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        </p>
                    @else
                    <div>
                        <form action="{{ route('resource.postcomment',$resource->id) }}" class="mb-5" method="POST">
                            @csrf
                            <div class="d-flex">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white">
                                        {{ auth()->user()->initials }}
                                      </span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-captialize mb-2">
                                        Do you have an update / query about this resource?
                                    </h6>
                                    <div class="input-group">
                                        <textarea class="form-control" aria-label="With textarea" name="comment" placeholder="Comment...."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions float-right mt-2">
                                <button class="btn btn-info btn-sm " type="submit">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="separator-dashed"></div>
                    {{-- {{ $comments }} --}}
                    @foreach ($comments as $comment)
                    <div class="d-flex">
                        <div class="avatar">
                            <span class="avatar-title rounded-circle border border-white bg-info">{{ App\Models\User::find($comment->user_id)->initials }}</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-captialize fw-bold mb-1">{{ App\Models\User::find($comment->user_id)->name }}</h6>
                            <span class="text-muted">{{ $comment->comment }}</span>
                        </div>
                        <div class="float-right pt-1">
                            {{-- <small class="text-muted">{{ $comment->created_at->format('d/m/Y, h:m A') }}</small> --}}
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>
                            How to reach them?
                        </h3>
                    </div>
                </div>

                <div class="form-group">

                    @if ($resource->phone != null)
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-group col-9">
                                <input type="text" class="form-control form-control-sm w-100" id="phone" value="{{ $resource->phone }}" readonly>
                            </div>
                            <button onclick="copyClip();" class="btn btn-sm btn-dark col" >
                                <i class="fas fa-clipboard"></i>
                            </button>
                        </div>

                        <a  href="tel:{{ $resource->phone }}" class="btn btn-block btn-success mb-2">
                            Call {{ $resource->phone }} <i class="fas fa-phone"></i>
                        </a>

                        @else

                        <p class="p2 text-muted mb-4">
                            <i class="fa fa-exclamation-triangle text-danger"></i> This resource does not contain a phone number.
                        </p>

                    @endif

                    @if ($resource->url != '')
                        <a href="{{ $resource->url }}" target="_blank" class="btn btn-sm btn-block btn-dark">
                            Visit URL <i class="fas fa-link"></i>
                        </a>
                        @else
                        <p class="p2 text-muted mb-4">
                            <i class="fa fa-exclamation-triangle text-danger"></i> This resource does not contain a URL.
                        </p>
                    @endif

                    <div class="mt-3">
                        <h3 class="text-muted text-center">
                            Share this resource
                        </h3>
                        @php
                            $links =  Share::currentPage($resource->title)
                                ->facebook()
                                ->twitter()
                                ->telegram()
                                ->getRawLinks();

                            $icons = array();
                        @endphp

                        @foreach ($links as $platform => $link)
                            <a target="_blank" href="{{ $link }}" class="btn btn-white btn-block">
                                {{ ucfirst($platform )}} <i class="fab fa-{{ $platform }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title h3" id="exampleModalLabel"><strong>Report</strong> this resource</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('home.submit.report', $resource->id) }}" method="POST">
            @csrf
            <div class="p-2">
                <p class="h4">
                    We're sorry that this resource was not as per description.
                    Your report will help us maintain our database.
                </p>
                @guest
                    <span class="mt-3 mb-3 text-muted">
                        You'll need an account to do this, let's create you one.
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
                @endguest

                <div class="form-group">
                  <label for="slct">Report Resource</label>
                  <select id="slct" class="form-control" name="reason" >
                      <option value="1">Tried to reach out to the resource, no response</option>
                      <option value="2">The resource is unavailable now</option>
                      <option value="3">The data is incorrect / inaccurate</option>
                      <option value="4">Others</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="txtarea" id="comment">Reason</label>
                  <textarea class="form-control" id="txtarea" name="comment" placeholder="Write your reason here..." cols="5"></textarea>
              </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning">Report</button>
        </div>
    </form>
      </div>
    </div>
  </div>

{{-- href="{{ route('home.report', $resource->id) }}" --}}
@endsection
