@extends('layouts.atlantis')
@section('title', 'Dashboard')
@section('css')
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


</style>
@endsection
@section('js')
<script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
<script>

        $(document).ready(function() {
            $('.select2').select2();
            $('#hospitals_table').DataTable();
            $('#ambulance_table').DataTable();
            $('#oxygen_table').DataTable();
            $('#medicine_table').DataTable();
            $('#misc_table').DataTable();
        });


		Circles.create({
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');
		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: <?php echo App\Http\Controllers\API\StatsAPI::dataInput()['labels']; ?>,
				datasets : [{
					label: "Tweets Captured",
					backgroundColor: 'blue',
					borderColor: 'rgb(23, 125, 255)',
					data: {{App\Http\Controllers\API\StatsAPI::dataInput()['data']}},
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
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

        //totalConfirmed = totalConfirmed.slice(totalConfirmed.length - 10);
        //totalRecovered = totalRecovered.slice(totalRecovered.length - 10);
        //totalDeceased = totalDeceased.slice(totalDeceased.length - 10);

	</script>

    <script>
        function changeLocation(state) {

            var locationUpdatingIcon = document.getElementById('locationUpdatingIcon');
            var locationUpdateForm = document.getElementById('locationUpdateForm');

            locationUpdateForm.style.display = 'none';
            locationUpdatingIcon.style.display = 'block';
            // var api_url = "{{ config('app.url') }}/api/v1/currentlocation/update/";
            axios.get('/currentlocation/update/' + state)
            .then(function (response) {
            // handle success
                // $.notify({
                //     icon: 'flaticon-alarm-1',
                //     title: '{{ config("app.name") }}',
                //     message: 'Location has been updated to ' + response.data.name,
                // },{
                //     type: 'primary',
                //     placement: {
                //         from: "top",
                //         align: "right"
                //     },
                //     time: 4000,
                // });

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
            // always executed
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
                    <h4 class="card-title">
                        There are {{ $resources->count() }} verified resources for <strong>{{ $currentlocation->name }}</strong>
                    </h4>
                    <span class="text-muted">
                        All of these resources are <strong><abbr title="We call each and every resource and verify them">manually verified</abbr></strong> by our volunteers.
                        @if ($resources->count() > 0)
                        Latest update was <strong>{{ $resources[($resources->count() - 1)]->updated_at->diffForHumans() }}</strong>
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills nav-primary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                        <li class="nav-item submenu">
                            <a class="nav-link active show" id="pills-stats-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" artelected="true">
                                <i class="fa fa-chart-line"></i>
                                Statistics
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
                            <a class="nav-link" id="pills-misc-tab-icon" data-toggle="pill" href="#pills-misc-icon" role="tab" aria-controls="pills-misc-icon" aria-selected="false">
                                <i class="fa fa-circle-notch"></i>
                                Miscelleneous
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-stats-tab-icon">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="card card-dark bg-danger-gradient">
                                        <div class="card-body pb-0">
                                            <div class="h1 fw-bold float-right text-white" id="stats_confirmed_cases"></div>
                                            <p class="text-white">Yesterday's Confirmed Cases</p>
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
                                            <p class="text-white">Yesterday's Recovered Cases</p>
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
                                            <p class="text-white">Yesterday's Deceased Cases</p>
                                            <div class="pull-in sparkline-fix">
                                                <div id="lineChart_4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-4 col-lg-4">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                                6%
                                                <i class="fa fa-chevron-up"></i>
                                            </div>
                                            <div class="h1 m-0">4278</div>
                                            <div class="text-muted mb-3">Total Resources</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-4 col-lg-4">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                                6%
                                                <i class="fa fa-chevron-up"></i>
                                            </div>
                                            <div class="h1 m-0">94</div>
                                            <div class="text-muted mb-3">Users / Moderators</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-4 col-lg-4">
                                    <div class="card">
                                        <div class="card-body p-3 text-center">
                                            <div class="text-right text-success">
                                                6%
                                                <i class="fa fa-chevron-up"></i>
                                            </div>
                                            <div class="h1 m-0">43</div>
                                            <div class="text-muted mb-3">Data providers</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-hospitals-tab-icon">
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
                        <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-ambulance-tab-icon">
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

                        <div class="tab-pane fade" id="pills-oxygen-icon" role="tabpanel" aria-labelledby="pills-oxygen-tab-icon">
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

                        <div class="tab-pane fade" id="pills-medicine-icon" role="tabpanel" aria-labelledby="pills-medicine-tab-icon">
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

                        <div class="tab-pane fade" id="pills-misc-icon" role="tabpanel" aria-labelledby="pills-misc-tab-icon">
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
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Wish to do a more detailed search?
                    </h4>
                </div>
                <div class="card-body">

                    <p class="mb-4">
                        Our database contains X data points. You can search through them with a keywords of your own.
                    </p>

                    <button id="searchKeywordsButton" onclick="searchKeywords();" class="btn btn-danger btn-block">
                        Search
                    </button>

                    <script>
                        function searchKeywords() {
                            var searchKeywordsButton = document.getElementById('searchKeywordsButton');
                            searchKeywordsButton.innerHTML = "Feature not included yet";
                        }
                    </script>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-right text-danger">
                        1284
                    </div>
                    <h4 class="">{{ $currentlocation->name }}</h4>
                    <p class="text-muted">Update rate</p>
                    <div class="pull-in sparkline-fix">
                        <div id="lineChart"></div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="col-md-4">
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
                    <button class="btn btn-danger btn-block">
                        Add
                    </button>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Not COVID-19 Positive? There are <strong>12 ways</strong> you can help
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Overall Status</div>
                    <div class="card-category">
                        Latest information according to COVID API data for {{ $currentlocation->name }}
                    </div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <h6 class="fw-bold mt-3 mb-0">Active</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Recovered</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Vaccinated</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Tweet Streams</div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">Total Streams Recorded</h6>
                                <h3 class="fw-bold">{{App\Http\Controllers\API\StatsAPI::dataInput()['total']}}</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="chart-container">
                                <canvas id="totalIncomeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
        <div class="col-md-8">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Frequently Asked Questions</div>
                        <div class="card-tools">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" id="faq_query" name="query" class="form-control" placeholder="Search">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary" onclick="search();" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function search() {
                                        var query = document.getElementById('faq_query').value;
                                        alert(query);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($faqs as $faq)
                        <div class="d-flex">
                            <div class="flex-1 ml-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">
                                    {{ $faq->title }}
                                </h6>
                                <span class="text-muted">
                                    By: {{ $faq->author->name }}
                                </span>
                                <br><br>
                                    @foreach (json_decode($faq->categories) as $cat)
                                        @php
                                            $category = \App\Models\Category::find($cat);
                                        @endphp
                                        @if ($category)
                                        <span class="badge badge-primary">
                                            {{ $category->name }}
                                        </span>
                                        @endif
                                    @endforeach
                            </div>
                            <div class="float-right pt-1">
                                <small class="text-muted">{{ $faq->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                    @empty
                        <div class="alert alert-danger">
                            Whoops! No FAQs added for {{ $currentlocation->name }} yet.
                        </div>
                    @endforelse
                </div>
                <div class="card-footer">
                    {{ $faqs->appends(['search' => Request::get('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
