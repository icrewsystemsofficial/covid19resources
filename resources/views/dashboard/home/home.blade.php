@extends('layouts.atlantis')
@section('title', 'Dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css" integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" integrity="sha512-SJw7jzjMYJhsEnN/BuxTWXkezA2cRanuB8TdCNMXFJjxG9ZGSKOX5P3j03H6kdMxalKHZ7vlBMB4CagFP/de0A==" crossorigin="anonymous" />
<style>
    .table-bg-success {
        border-radius: 25px;
        background: #00aa5b !important;
        background: -webkit-linear-gradient(to right, #00b646, #00aa5b) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #00b646, #00aa5b) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .table-bg-danger {
        background: #ED213A !important;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #93291E, #ED213A) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #93291E, #ED213A) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .table-bg-muted {
        background: #000 !important;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #000000, #5f5d5d) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left,  #000000, #5f5d5d) !important;  /* Chrome 10-25, Safari 5.1-6 */
    }

    .file-upload {
	position: relative;
	display: inline-block;
}

.file-upload__label {
  display: block;
  padding: 1em 2em;
  color: #fff;
  background: #222;
  border-radius: .4em;
  transition: background .3s;

  &:hover {
     cursor: pointer;
     background: #000;
  }
}

.file-upload__input {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    font-size: 1;
    width:0;
    height: 100%;
    opacity: 0;
}


</style>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js" integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA==" crossorigin="anonymous"></script>
<script src="https://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
<script>

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

var tourcompleted = getCookie("tourcompleted");
  if (tourcompleted != "") {
   console.log('Tour completed')
  } else {
    introJs().setOptions({
        steps: [{
            title: 'Welcome to {{ config("app.name") }}',
            intro: 'Hey there 👋 <br> welcome to {{ config("app.name") }}, please follow this guide to know how to use this app efficiently'
        },
        {
            element: document.getElementById('currentlocation_intro'),
            intro: 'This shows the location forwhich the app is currently showing results for'
        },
        {
            element: document.querySelector('.select2'),
            intro: 'You can select your state here, we have listed all the states in India, and the app is capable of getting inputs for all districts & cities in India'
        },
        {
            element: document.getElementById('total_retrived_results'),
            intro: 'This shows the number of results we have for the selected state'
        },
        {
            element: document.getElementById('pills-tab-with-icon'),
            intro: 'The results for the selected state is shown in these tabs'
        },
        {
            element: document.getElementById('share_link_nav'),
            intro: 'Once you login, you\'ll get a personalized link which you can share with your friends and family'
        },
        {
            title: 'Farewell!',
            element: document.querySelector('.card__image'),
            intro: 'We sincerely hope and pray you find what you\'re looking for 🙏'
        }]
        }).start().oncomplete(function() {
            setCookie('tourcompleted', '1', 5);
        });
}

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
            $('#hospitals_table').DataTable();
            $('#ambulance_table').DataTable();
            $('#oxygen_table').DataTable();
            $('#medicine_table').DataTable();
            $('#misc_table').DataTable();
        });


		$('#lineChart').sparkline({{App\Http\Controllers\API\StatsAPI::dataInput()['data']}}, {
			type: 'line',
			height: '90',
			width: '100%',
			lineWidth: '2',
			lineColor: 'blue',
			fillColor: '#c2e9ed'
		});


        var currentStateCode = ("{{$currentlocation->code}}").toLowerCase();

        var today = new Date();
        var dd = today. getDate()-1;
        var mm = today. getMonth()+1;
        var yyyy = today.getFullYear();

        mm = mm+"";
        dd= dd+"";
        yyyy=yyyy+"";

        console.log(mm.length);

        if(mm.length == 1){
            mm = "0" + mm;
        }

        if(dd.length == 1){
            dd = "0" + dd;
        }


        var todaydate = yyyy+"-"+mm+"-"+dd;
        console.log(todaydate);

        var totalConfirmed = [];
        var totalRecovered = [];
        var totalDeceased = [];

        var todayConfirmed = 0;
        var todayRecovered = 0;
        var todayDecreased = 0;

        axios.get('https://api.covid19india.org/states_daily.json')
            .then(function (response) {
                (response.data.states_daily).forEach(dailyloop);

                $('#lineChart_2').sparkline(totalConfirmed, {
                        type: 'line',
                        height: '70',
                        width: '100%',
                        lineWidth: '2',
                        lineColor: '#ffa534',
                        fillColor: 'rgba(255, 165, 52, .14)'
                    });

                    $('#lineChart_3').sparkline(totalRecovered, {
                        type: 'line',
                        height: '70',
                        width: '100%',
                        lineWidth: '2',
                        lineColor: '#ffa534',
                        fillColor: 'rgba(255, 165, 52, .14)'
                    });

                    $('#lineChart_4').sparkline(totalDeceased, {
                        type: 'line',
                        height: '70',
                        width: '100%',
                        lineWidth: '2',
                        lineColor: '#ffa534',
                        fillColor: 'rgba(255, 165, 52, .14)'
                    });



            });

        function dailyloop(element, index) {
            if(element['status'] === 'Deceased'){
                totalDeceased.push(element[currentStateCode]);
                if(element["dateymd"] === todaydate){
                    todayDeceased = element[currentStateCode]
                    $("#stats_deceased_cases").text(element[currentStateCode]);
                }
            }

            if(element['status'] === 'Recovered'){
                totalRecovered.push(element[currentStateCode]);
                if(element["dateymd"] === todaydate){
                    todayRecovered = element[currentStateCode]
                    $("#stats_recovered_cases").text(element[currentStateCode]);
                }
            }

            if(element['status'] === 'Confirmed'){
                totalConfirmed.push(element[currentStateCode]);
                if(element["dateymd"] === todaydate){
                    todayConfirmed = element[currentStateCode]
                    $("#stats_confirmed_cases").text(element[currentStateCode]);
                }
            }
        }
	</script>

    <script>
        function changeLocation(state) {

            var locationUpdatingIcon = document.getElementById('locationUpdatingIcon');
            var locationUpdateForm = document.getElementById('locationUpdateForm');

            locationUpdateForm.style.display = 'none';
            locationUpdatingIcon.style.display = 'block';
            axios.get('/currentlocation/update/' + state)
            .then(function (response) {
                document.getElementById('location').innerHTML = response.data.name;
                window.location.reload();
            })
            .catch(function (error) {
            // handle error
            $.notify({
                    icon: 'fa fa-times-circle',
                    title: '{{ config("app.name") }}',
                    message: 'There was an error in updating your location, please clear cache and try again',
                },{
                    type: 'danger',
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 4000,
                });

            console.log(error);
            })
            .then(function () {

            });
        }
    </script>
@endsection



@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white pb-2 fw-bold">{{ config('app.name') }}</h2>
                <h5 class="text-white op-7 mb-2">State Wise COVID19 Resources. Awareness is the first step in this battle.</h5>
            </div>
            <div class="col-md-4 col-md-4 py-2 py-md-0">
                <span id="locationUpdatingIcon" class="pull-right" style="display: none;">
                    <h2 class="h3 text-white">Updating location <i class="fa fa-sync fa-spin text-white"></i></h2>
                </span>
                <form action="" id="locationUpdateForm">
                    <select name="state" onchange="changeLocation(this.value);" class="form-control select2" id="">
                        <option value="all" selected disabled>Select a state</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->code }}" <?php if($currentlocation->code == $state->code) { echo "selected"; } ?>>
                            {{ $state->name }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">


    <div class="row mt--2">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="row">
                    <div class="col-12">
                        <h4 class="card-title" id="total_retrived_results">
                            There are {{ $resources->count() }} verified resources for <strong>{{ $currentlocation->name }}</strong>
                        </h4>
                        <span class="text-muted">
                            All of these resources are <strong><abbr title="We call each and every resource and verify them">manually verified</abbr></strong> by our volunteers.
                            @if ($resources->count() > 0)
                            <div>Latest update was <strong>{{ $resources[($resources->count() - 1)]->updated_at->diffForHumans() }}</strong></div>
                            @endif
                        </span>
                    </div>
                   </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="card card-dark bg-danger-gradient">
                                <div class="card-body pb-0">
                                    <div class="h1 fw-bold float-right text-white" id="stats_confirmed_cases"></div>
                                    <p class="text-white">Confirmed Cases</p>
                                    <div class="pull-in sparkline-fix">
                                        <div id="lineChart_2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-dark bg-success-gradient">
                                <div class="card-body pb-0">
                                    <div class="h1 fw-bold float-right text-white" id="stats_recovered_cases"></div>
                                    <p class="text-white">Recovered Cases</p>
                                    <div class="pull-in sparkline-fix">
                                        <div id="lineChart_3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-black">
                                <div class="card-body pb-0">
                                    <div class="h1 fw-bold float-right text-white" id="stats_deceased_cases"></div>
                                    <p class="text-white">Deceased Cases</p>
                                    <div class="pull-in sparkline-fix">
                                        <div id="lineChart_4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills nav-success  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                        <li class="nav-item submenu">
                            <a class="nav-link active show" id="pills-misc-tab-icon" data-toggle="pill" href="#pills-misc-icon" role="tab" aria-controls="pills-misc-icon" aria-selected="false">
                                <i class="fa fa-circle-notch"></i>
                                All Resources
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-hospitals-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                                <i class="fas fa-hospital-symbol"></i>
                                Hospitals
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-ambulance-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                                <i class="fa fa-ambulance"></i>
                                Ambulance
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-oxygen-tab-icon" data-toggle="pill" href="#pills-oxygen-icon" role="tab" aria-controls="pills-oxygen-icon" aria-selected="false">
                                <i class="fas fa-lungs"></i>
                                Oxygen
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-medicine-tab-icon" data-toggle="pill" href="#pills-medicine-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                                <i class="fa fa-syringe"></i>
                                Medicines
                            </a>
                        </li>

                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-add-resources-tab-icon" data-toggle="pill" href="#pills-add-resources-icon" role="tab" aria-controls="pills-add-resources-icon" aria-selected="false">
                                <i class="fas fa-plus-circle"></i>
                                Add Resources
                            </a>
                        </li>
                    </ul>

                    <div class="mt-2 text-center">
                        <a href="{{ route('home.search') }}" class="btn btn-sm btn-warning">Looking for something in particular? A.I. Search <i class="fa fa-search"></i></a>
                    </div>

                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade active show" id="pills-misc-icon" role="tabpanel" aria-labelledby="pills-misc-tab-icon">
                            <div class="table-responsive">
                                <table id="misc_table" class="table table-hover table-borderless">
                                    <thead>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Last Updated</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $resource)
                                            @if($resource)

                                            @php
                                                if($resource->verified == 0) {
                                                    // $color = 'bg-warning'
                                                    $color = 'table-bg-muted';
                                                } else if($resource->verified == 1) {
                                                    $color = 'table-bg-success';
                                                } else if($resource->verified == 2) {
                                                    $color = 'table-bg-danger';
                                                }
                                            @endphp

                                            <tr class="{{ $color }} text-white" style="border-radius: 50px;">
                                                <td class="text-center">
                                                    {{ $resource->title }}
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    @if($resource->hasAddress == 1)
                                                        <small>
                                                            <a class="text-white" target="_blank" href="https://www.google.com/maps/place/{{ $resource->city.','.$resource->district }}">
                                                                <i class="fa fa-map-pin"></i> {{ $resource->city.', '.$resource->district }}
                                                            </a>
                                                        </small>
                                                        @else
                                                        <span class="text-white">
                                                            Landmark: {{ $resource->landmark }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $resource->author_data->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($resource->verified == 1)
                                                        <span class="badge badge-success">
                                                            Verified <i class="fas fa-check"></i>
                                                        </span>
                                                    @elseif($resource->verified == 2)
                                                        <span class="badge badge-danger">
                                                            Refuted <i class="fas fa-times"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Pending <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ $resource->created_at->format('d/m/Y H:i A') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $resource->updated_at->diffForHumans() }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('home.view', $resource->id) }}" class="btn btn-sm btn-white">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-hospitals-tab-icon">
                            <div class="table-responsive">
                                <table id="hospitals_table" class="table table-hover table-borderless">
                                    <thead>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Last Updated</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $resource)
                                            @if($resource->category_data->name == 'Hospitals')

                                            @php
                                                if($resource->verified == 0) {
                                                    $color = 'bg-warning-gradient';
                                                } else if($resource->verified == 1) {
                                                    $color = 'table-bg-success';
                                                } else if($resource->verified == 2) {
                                                    $color = 'table-bg-danger';
                                                } else {
                                                    $color = 'bg-primary';
                                                }
                                            @endphp

                                            <tr class="{{ $color }} text-white" style="border-radius: 50px;">
                                                <td class="text-center">
                                                    {{ $resource->title }}
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    @if($resource->hasAddress == 1)
                                                        <small>
                                                            <a class="text-white" target="_blank" href="https://www.google.com/maps/place/{{ $resource->city.','.$resource->district }}">
                                                                <i class="fa fa-map-pin"></i> {{ $resource->city.', '.$resource->district }}
                                                            </a>
                                                        </small>
                                                        @else
                                                        <span class="text-white">
                                                            Landmark: {{ $resource->landmark }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $resource->author_data->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($resource->verified == 1)
                                                        <span class="badge badge-success">
                                                            Verified <i class="fas fa-check"></i>
                                                        </span>
                                                    @elseif($resource->verified == 2)
                                                        <span class="badge badge-danger">
                                                            Refuted <i class="fas fa-times"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Pending <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ $resource->created_at->format('d/m/Y H:i A') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $resource->updated_at->diffForHumans() }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('home.view', $resource->id) }}" class="btn btn-sm btn-white">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-ambulance-tab-icon">
                            <div class="table-responsive">
                                <table id="ambulance_table" class="table table-hover table-borderless">
                                    <thead>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Last Updated</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $resource)
                                            @if($resource->category_data->name == 'Ambulance')

                                            @php
                                                if($resource->verified == 0) {
                                                    $color = 'table-bg-muted';
                                                } else if($resource->verified == 1) {
                                                    $color = 'table-bg-success';
                                                } else if($resource->verified == 2) {
                                                    $color = 'table-bg-danger';
                                                }
                                            @endphp

                                            <tr class="{{ $color }} text-white" style="border-radius: 50px;">
                                                <td class="text-center">
                                                    {{ $resource->title }}
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    @if($resource->hasAddress == 1)
                                                        <small>
                                                            <a class="text-white" target="_blank" href="https://www.google.com/maps/place/{{ $resource->city.','.$resource->district }}">
                                                                <i class="fa fa-map-pin"></i> {{ $resource->city.', '.$resource->district }}
                                                            </a>
                                                        </small>
                                                        @else
                                                        <span class="text-white">
                                                            Landmark: {{ $resource->landmark }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $resource->author_data->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($resource->verified == 1)
                                                        <span class="badge badge-success">
                                                            Verified <i class="fas fa-check"></i>
                                                        </span>
                                                    @elseif($resource->verified == 2)
                                                        <span class="badge badge-danger">
                                                            Refuted <i class="fas fa-times"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Pending <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ $resource->created_at->format('d/m/Y H:i A') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $resource->updated_at->diffForHumans() }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('home.view', $resource->id) }}" class="btn btn-sm btn-white">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-oxygen-icon" role="tabpanel" aria-labelledby="pills-oxygen-tab-icon">
                            <div class="table-responsive">
                                <table id="oxygen_table" class="table table-hover table-borderless">
                                    <thead>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Last Updated</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $resource)
                                            @if($resource->category_data->name == 'Oxygen')

                                            @php
                                                if($resource->verified == 0) {
                                                    $color = 'table-bg-muted';
                                                } else if($resource->verified == 1) {
                                                    $color = 'table-bg-success';
                                                } else if($resource->verified == 2) {
                                                    $color = 'table-bg-danger';
                                                }
                                            @endphp

                                            <tr class="{{ $color }} text-white" style="border-radius: 50px;">
                                                <td class="text-center">
                                                    {{ $resource->title }}
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    @if($resource->hasAddress == 1)
                                                        <small>
                                                            <a class="text-white" target="_blank" href="https://www.google.com/maps/place/{{ $resource->city.','.$resource->district }}">
                                                                <i class="fa fa-map-pin"></i> {{ $resource->city.', '.$resource->district }}
                                                            </a>
                                                        </small>
                                                        @else
                                                        <span class="text-white">
                                                            Landmark: {{ $resource->landmark }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $resource->author_data->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($resource->verified == 1)
                                                        <span class="badge badge-success">
                                                            Verified <i class="fas fa-check"></i>
                                                        </span>
                                                    @elseif($resource->verified == 2)
                                                        <span class="badge badge-danger">
                                                            Refuted <i class="fas fa-times"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Pending <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ $resource->created_at->format('d/m/Y H:i A') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $resource->updated_at->diffForHumans() }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('home.view', $resource->id) }}" class="btn btn-sm btn-white">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-medicine-icon" role="tabpanel" aria-labelledby="pills-medicine-tab-icon">
                            <div class="table-responsive">
                                <table id="medicine_table" class="table table-hover table-borderless">
                                    <thead>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Added by</th>
                                        <th>Status</th>
                                        {{-- <th>Created</th> --}}
                                        <th>Last Updated</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $resource)
                                            @if($resource->category_data->name == 'Medicines')

                                            @php
                                                if($resource->verified == 0) {
                                                    $color = 'table-bg-muted';
                                                } else if($resource->verified == 1) {
                                                    $color = 'table-bg-success';
                                                } else if($resource->verified == 2) {
                                                    $color = 'table-bg-danger';
                                                }
                                            @endphp

                                            <tr class="{{ $color }} text-white" style="border-radius: 50px;">
                                                <td class="text-center">
                                                    {{ $resource->title }}
                                                    <br>
                                                </td>
                                                <td class="text-center">
                                                    @if($resource->hasAddress == 1)
                                                        <small>
                                                            <a class="text-white" target="_blank" href="https://www.google.com/maps/place/{{ $resource->city.','.$resource->district }}">
                                                                <i class="fa fa-map-pin"></i> {{ $resource->city.', '.$resource->district }}
                                                            </a>
                                                        </small>
                                                        @else
                                                        <span class="text-white">
                                                            Landmark: {{ $resource->landmark }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $resource->author_data->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($resource->verified == 1)
                                                        <span class="badge badge-success">
                                                            Verified <i class="fas fa-check"></i>
                                                        </span>
                                                    @elseif($resource->verified == 2)
                                                        <span class="badge badge-danger">
                                                            Refuted <i class="fas fa-times"></i>
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            Pending <i class="fas fa-exclamation-triangle"></i>
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    {{ $resource->created_at->format('d/m/Y H:i A') }}
                                                </td> --}}
                                                <td class="text-center">
                                                    {{ $resource->updated_at->diffForHumans() }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('home.view', $resource->id) }}" class="btn btn-sm btn-white">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-add-resources-icon" role="tabpanel" aria-labelledby="pills-add-resources-tab-icon">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Do you have <strong>verified</strong> information?
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <p class="mb-4">
                                        You can add information to our website in 2 easy steps. You'll be
                                        saving countless lives.
                                    </p>
                                    <a target="_blank" class="btn btn-success btn-block hvr-grow" href="{{ route('home.add.resource') }}">
                                        Add resources <i class="fas fa-plus-circle"></i>
                                    </a>



                                    <form class="row mt-3 p-2" action="{{ route('home.resource.ocr') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <h4 class="h3">Wait a <strong>minute</strong>, screenshots?</h4>
                                        <p class="ml-2 p-2">
                                            Adding resources couldn't be simpler, just take a screenshot & upload it here. We'll extract the text from it in real time.
                                            You really don't have to switch apps / tabs to look for information.
                                        </p>

                                        <div class="col-md-12">
                                            <center>
                                                <div class="col-md-4 mb-3">
                                                    <label for="OCR_upload">Select your screenshot</label>
                                                    <input type="file" class="form-control-file mt-1" name="image" id="OCR_upload">
                                                    <small>(Maximum filesize is 5MB)</small>
                                                </div>
                                            </center>
                                        </div>
                                         <div class="col-md-12">
                                           <center>
                                            <button onclick="ocr_loading();" id="ocr_button" type="submit" class="btn btn-success btn-md hvr-grow">Extract text from screenshot <i class="fas fa-file"></i></button>
                                            <script>
                                                function ocr_loading() {
                                                    var ocrbutton = document.getElementById('ocr_button');
                                                    ocrbutton.disabled = true;
                                                    ocrbutton.innerHTML = "Processing <i class='fa fa-circle-notch fa-spin'></i>"
                                                }
                                            </script>
                                           </center>
                                         </div>
                                       </form>
                                       <br>
                                      <hr>
                                      <br>


                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Not COVID-19 Positive? There are <strong>6 other ways</strong> you can help
                    </h4>
                </div>

                <div class="card-body">
                    1) Refer the website to the person in need. This is the best help you could offer : a friend in need is a help in need.
                    <br><br>
                    2) Sign up as a volunteer : we have a specialised volunteering team that is working around the clock to help us verify our data. Be a part of this glorified mission .. SigU up aV volunteer today <a href="{{ route('volunteer.registration') }}" style="text-decoration: none"> (link here) </a>
                    <br><br>
                    3) Share #covid19verifiedresources website via social media: Someone in dire need could use this reference. It would be a miracle to them. 
                    <br><br>
                    4) Add resources to our Website: we appreciate all the data we could get ; you come across a valid resource, immediately add it to our website so it's available to all. It's a one step process <a href="{{ route('home.add.resource') }}" style="text-decoration: none"> (link here) </a>
                    <br><br>
                    5) If you are an NGO and you are willing to support this cause : contact us <a href="https://www.tidio.com/talk/cdcm4i8ho2rteyjfwrzqa19csu0eiwm7" style="text-decoration: none" target="_blank">(link here)</a> immediately, we could join hands to save the nation.
                    <br><br>
                    6) If you can offer technical help: great minds don't just think alike, they work alike. You can help us by taking care of the backend data updation processes.

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: none;">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-right text-warning">+7%</div>
                    <h2 class="mb-2">{{App\Http\Controllers\API\StatsAPI::dataInput()['total']}}</h2>
                    <p class="text-muted">Tweet Streams</p>
                    <div class="pull-in sparkline-fix">
                        <div id="lineChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
