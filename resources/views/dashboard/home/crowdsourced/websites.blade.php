@extends('layouts.atlantis')
@section('title', 'Websites')
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
var dataSet = [
["Ministry of Health and Family Welfare","<a type='button' class='btn btn-primary' href='https://www.mohfw.gov.in/covid_vaccination/vaccination/index.html'>Vist site</a>"],
["COVID19INDIA","<a type='button' class='btn btn-primary' href='https://www.covid19india.org'>Vist site</a>"],
["COVID19 Help - Chennai","<a type='button' class='btn btn-primary' href='https://chennaicovidhelp.in'>Vist site</a>"],
["Chennai Volunteers","<a type='button' class='btn btn-primary' href='http://www.chennaivolunteers.org'>Vist site</a>"],
["COVID-19 Resources","<a type='button' class='btn btn-primary' href='https://covid-resources-chi.vercel.app'>Vist site</a>"],
["Twitter Search for COVID","<a type='button' class='btn btn-primary' href='https://covid19-twitter.in'>Vist site</a>"],
    ["Covid19 Resources","<a type='button' class='btn btn-primary' href='https://covidhelp.teamsaath.me'>Vist site</a>"],
    ["dhoondh","<a type='button' class='btn btn-primary' href='https://plasmadonor.in'>Vist site</a>"],
    ["CoV19InfoHubIndia","<a type='button' class='btn btn-primary' href='https://linktr.ee/CoV19InfoHubIndia'>Vist site</a>"],
    ["Covid.army","<a type='button' class='btn btn-primary' href=''https://covid.army'>Vist site</a>"],
    ["crows sourcing data","<a type='button' class='btn btn-primary' href='https://covidfacts.in'>Vist site</a>"],
    ["Covid Fight Club","<a type='button' class='btn btn-primary' href='http://covidfacts.in'>Vist site</a>"],
    ["Life | Corona Safe ","<a type='button' class='btn btn-primary' href='https://liferesources.in/'>Vist site</a>"],
    ["Centralised Monitoring of Resources | Jharkhand ","<a type='button' class='btn btn-primary' href='http://amritvahini.in/'>Vist site</a>"],
    ["Bengaluru For Humanity | Covid-19 Resources App for Bangalore ","<a type='button' class='btn btn-primary' href='https://blrforhumanity.com/'>Vist site</a>"],



];
   $(document).ready(function() {
    $('#website').DataTable( {
        data: dataSet,
        columns: [
            { title: "Page" },
            { title: "Vist" }
        ]
    } );

} );
</script>
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
    /* Your Custom Styles Here*/
</style>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                Websites 
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="website">
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection