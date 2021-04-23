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
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
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

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});

        $('#lineChart_1').sparkline([0, 50, 55, 56, 57, 60, 70, 80, 90, 95, 250, 251, 245, 260, 230, 900, 950, 1000, 1200], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#fafafa',
			fillColor: 'rgba(255, 165, 52, .14)'
		});

        $('#lineChart_2').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});

        $('#lineChart_3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});

        $('#lineChart_4').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});


	</script>

    <script>
        function changeLocation(state) {
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
                <form action="">
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
                        What would you like to know about?
                    </h4>
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
                            <a class="nav-link" id="pills-ambulance-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                                <i class="fas fa-lungs"></i>
                                Oxygen
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-ambulance-tab-icon" data-toggle="pill" href="#pills-contact-icon" role="tab" aria-controls="pills-contact-icon" aria-selected="false">
                                <i class="fa fa-syringe"></i>
                                Medicines
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <div class="tab-pane fade active show" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-stats-tab-icon">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="card card-dark bg-danger-gradient">
                                        <div class="card-body pb-0">
                                            <div class="h1 fw-bold float-right text-white">+85%</div>
                                            <h2 class="mb-0">1237864</h2>
                                            <p class="text-white">Confirmed Cases</p>
                                            <div class="pull-in sparkline-fix">
                                                <div id="lineChart_1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-dark bg-primary-gradient">
                                        <div class="card-body pb-0">
                                            <div class="h1 fw-bold float-right text-white">+85%</div>
                                            <h2 class="mb-0">1237864</h2>
                                            <p class="text-white">Active Cases</p>
                                            <div class="pull-in sparkline-fix">
                                                <div id="lineChart_2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-dark bg-success-gradient">
                                        <div class="card-body pb-0">
                                            <div class="h1 fw-bold float-right text-white">+85%</div>
                                            <h2 class="mb-0">1237864</h2>
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
                                            <div class="h1 fw-bold float-right text-white">+85%</div>
                                            <h2 class="mb-0">1237864</h2>
                                            <p class="text-white">Deceased Cases</p>
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
                                    @forelse ($resources as $resource)
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
                                        @empty
                                        <tr>
                                            Whoops! No resources found.
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-contact-icon" role="tabpanel" aria-labelledby="pills-ambulance-tab-icon">
                            <p>Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>
                            <p> But nothing the copy said could convince her and so it didnâ€™t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Do you have <strong>verified</strong> information?
                    </h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-danger btn-block">
                        Add
                    </button>
                </div>
            </div>

            <div class="card">
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
                    <div class="card-title">Total income & spend statistics</div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                <h3 class="fw-bold">$9.782</h3>
                            </div>
                            <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                <h3 class="fw-bold">$1,248</h3>
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
                    <h2 class="mb-2">213</h2>
                    <p class="text-muted">Transactions</p>
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">User Statistics</div>
                        <div class="card-tools">
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Daily Sales</div>
                    <div class="card-category">March 25 - April 02</div>
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                        <h1>$4,578.58</h1>
                    </div>
                    <div class="pull-in">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body pb-0">
                    <div class="h1 fw-bold float-right text-warning">+7%</div>
                    <h2 class="mb-2">213</h2>
                    <p class="text-muted">Transactions</p>
                    <div class="pull-in sparkline-fix">
                        <div id="lineChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">Users Geolocation</h4>
                        <div class="card-tools">
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
                            <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                        </div>
                    </div>
                    <p class="card-category">
                    Map of the distribution of users around the world</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/id.png') }}" alt="indonesia">
                                                </div>
                                            </td>
                                            <td>Indonesia</td>
                                            <td class="text-right">
                                                2.320
                                            </td>
                                            <td class="text-right">
                                                42.18%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/us.png') }}" alt="united states">
                                                </div>
                                            </td>
                                            <td>USA</td>
                                            <td class="text-right">
                                                240
                                            </td>
                                            <td class="text-right">
                                                4.36%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/au.png') }}" alt="australia">
                                                </div>
                                            </td>
                                            <td>Australia</td>
                                            <td class="text-right">
                                                119
                                            </td>
                                            <td class="text-right">
                                                2.16%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/ru.png') }}" alt="russia">
                                                </div>
                                            </td>
                                            <td>Russia</td>
                                            <td class="text-right">
                                                1.081
                                            </td>
                                            <td class="text-right">
                                                19.65%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/cn.png') }}" alt="china">
                                                </div>
                                            </td>
                                            <td>China</td>
                                            <td class="text-right">
                                                1.100
                                            </td>
                                            <td class="text-right">
                                                20%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="{{ asset('atlantis/assets/img/flags/br.png') }}" alt="brazil">
                                                </div>
                                            </td>
                                            <td>Brasil</td>
                                            <td class="text-right">
                                                640
                                            </td>
                                            <td class="text-right">
                                                11.63%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mapcontainer">
                                <div id="map-example" class="vmap"></div>
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
                <div class="card-header">
                    <div class="card-title">Top Products</div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="{{ asset('atlantis/assets/img/logoproduct.svg') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">CSS</h6>
                            <small class="text-muted">Cascading Style Sheets</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$17</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="{{ asset('atlantis/assets/img/logoproduct.svg') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                            <small class="text-muted">The Best Donuts</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$300</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="{{ asset('atlantis/assets/img/logoproduct3.svg') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ml-2">
                            <h6 class="fw-bold mb-1">Ready Pro</h6>
                            <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-info fw-bold">+$350</h3>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="pull-in">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title fw-mediumbold">Suggested People</div>
                    <div class="card-list">
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/jm_denis.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">Jimmy Denis</div>
                                <div class="status">Graphic Designer</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/chadengle.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">Chad</div>
                                <div class="status">CEO Zeleaf</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/talha.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">Talha</div>
                                <div class="status">Front End Designer</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/mlane.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">John Doe</div>
                                <div class="status">Back End Developer</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/talha.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">Talha</div>
                                <div class="status">Front End Designer</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="item-list">
                            <div class="avatar">
                                <img src="{{ asset('atlantis/assets/img/jm_denis.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="info-user ml-3">
                                <div class="username">Jimmy Denis</div>
                                <div class="status">Graphic Designer</div>
                            </div>
                            <button class="btn btn-icon btn-primary btn-round btn-xs">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary bg-primary-gradient">
                <div class="card-body">
                    <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
                    <h1 class="mb-4 fw-bold">17</h1>
                    <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
                    <div id="activeUsersChart"></div>
                    <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small> <span>7</span></li>
                        <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/atlantis/demo.html</small> <span>10</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-title">Feed Activity</div>
                </div>
                <div class="card-body">
                    <ol class="activity-feed">
                        @forelse ($activity as $acti)
                            <li class="feed-item feed-item-secondary">
                                <time class="date" datetime="9-25">{{ $acti->updated_at->diffForHumans() }}</time>
                                <span class="text">{{ $acti->user->name }} <a href="#">"{{ $acti->activity }}"</a></span>
                            </li>                            
                        @empty
                            <div class="alert alert-danger">
                                Whoops! No Activity found {{ $currentlocation->name }} yet.
                            </div>
                        @endforelse

                        {{-- <li class="feed-item feed-item-success">
                            <time class="date" datetime="9-24">Sep 24</time>
                            <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                        </li>
                        <li class="feed-item feed-item-info">
                            <time class="date" datetime="9-23">Sep 23</time>
                            <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                        </li>
                        <li class="feed-item feed-item-warning">
                            <time class="date" datetime="9-21">Sep 21</time>
                            <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                        </li>
                        <li class="feed-item feed-item-danger">
                            <time class="date" datetime="9-18">Sep 18</time>
                            <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                        </li>
                        <li class="feed-item">
                            <time class="date" datetime="9-17">Sep 17</time>
                            <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                        </li> --}}
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Support Tickets</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="avatar avatar-online">
                            <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span class="text-warning pl-3">pending</span></h6>
                            <span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">8:40 PM</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar avatar-offline">
                            <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span class="text-success pl-3">open</span></h6>
                            <span class="text-muted">I have some query regarding the license issue.</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">1 Day Ago</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar avatar-away">
                            <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted pl-3">closed</span></h6>
                            <span class="text-muted">Is there any update plan for RTL version near future?</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">2 Days Ago</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar avatar-offline">
                            <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1">Peter Parker <span class="text-success pl-3">open</span></h6>
                            <span class="text-muted">I have some query regarding the license issue.</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">2 Day Ago</small>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar avatar-away">
                            <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                        </div>
                        <div class="flex-1 ml-3 pt-1">
                            <h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
                            <span class="text-muted">Is there any update plan for RTL version near future?</span>
                        </div>
                        <div class="float-right pt-1">
                            <small class="text-muted">2 Days Ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
