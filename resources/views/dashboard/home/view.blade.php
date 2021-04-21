@extends('layouts.atlantis')
@section('title', 'Dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" integrity="sha512-SJw7jzjMYJhsEnN/BuxTWXkezA2cRanuB8TdCNMXFJjxG9ZGSKOX5P3j03H6kdMxalKHZ7vlBMB4CagFP/de0A==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<style>
    .leaflet-pulsing-icon {
    border-radius: 100%;
    box-shadow: 1px 1px 8px 0 rgba(0,0,0,0.75);
    }
    .leaflet-pulsing-icon:after {
    content: "";
    border-radius: 100%;
    height: 300%;
    width: 300%;
    position: absolute;
    margin: -100% 0 0 -100%;
    }
    @keyframes pulsate {
    0% {
    transform: scale(0.1, 0.1);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    }
    50% {
    opacity: 1;
    -ms-filter: none;
    filter: none;
    }
    100% {
    transform: scale(1.2, 1.2);
    opacity: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    }
    }

    #mapid { height: 200px; }
 </style>
 @endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://rawgit.com/mapshakers/leaflet-icon-pulse/master/src/L.Icon.Pulse.js"></script>


<script>
    var map = L.map('mapid', {
        center: [13, 80],
        zoom: 4
    });

    var pulsingIcon_currentlocation = L.icon.pulse({
   		iconSize: [12,12],
              fillColor: 'red',
              color: 'red',
              animate: true,
              heartbeat: 1
   	});


   	var current_location_pulsing_marker = L.marker([13, 80],{
           icon: pulsingIcon_currentlocation
           }).bindTooltip("Resource location").addTo(map);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
	maxZoom: 19,
	attribution: '&copy; {{ config("app.name") }}'
    }).addTo(map);

</script>
@endsection
@section('content')
<div class="panel-header bg-success-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-8 col-md-6">
                <h2 class="text-white pb-2 fw-bold">{{ config('app.name') }}</h2>
                <h5 class="text-white op-7 mb-2">State Wise COVID19 Resources. Awareness is the first step in this battle.</h5>
            </div>

            <div class="col-md-4 text-right">
                <a href="{{ route('home.report', $resource->id) }}" class="btn btn-lg btn-white hvr-bounce-in">
                    Report this resource <i class="ml-2 fa fa-exclamation-triangle text-danger"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>
                            How to reach them?
                            <br>
                            <small>
                                Last updated {{ $resource->updated_at->diffForHumans() }}
                            </small>
                        </h3>
                    </div>
                </div>

                <div class="form-group">
                    <a href="#" class="btn btn-sm btn-block btn-success">
                        Call {{ $resource->phone }} <i class="fas fa-phone"></i>
                    </a>

                    <a href="#" class="btn btn-sm btn-block btn-warning">
                        Copy {{ $resource->phone }} <i class="fas fa-clipboard"></i>
                    </a>

                    <a href="#" class="btn btn-sm btn-block btn-primary">
                        Tweet this <i class="fab fa-twitter"></i>
                    </a>

                    <a href="#" class="btn btn-sm btn-block btn-dark">
                        Visit {{ $resource->url }} <i class="fas fa-link"></i>
                    </a>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $resource->title }}
                    </h4>
                </div>
                <div class="card-body">
                    {!! $resource->body !!}

                    <hr>

                    <div id="mapid">

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
