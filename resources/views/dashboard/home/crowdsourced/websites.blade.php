@extends('layouts.atlantis')
@section('title', 'Websites')
@section('js')
   
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
                        <table class="table">
                            <tbody>
                            <tr><td>Ministry of Health and Family Welfare</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://www.mohfw.gov.in/covid_vaccination/vaccination/index.html') }}">Vist site</a></td></tr>
                            <tr><td>COVID19INDIA</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://www.covid19india.org') }}">Vist site</a></td></tr>
                            <tr><td>COVID19 Help - Chennai</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://chennaicovidhelp.in') }}">Vist site</a></td></tr>
                            <tr><td>Chennai Volunteers</td><td> <a type="button" class="btn btn-primary" href="{{ url('http://www.chennaivolunteers.org') }}">Vist site</a></td></tr>
                            <tr><td>COVID-19 Resources</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://covid-resources-chi.vercel.app') }}">Vist site</a></td></tr>
                            <tr><td>Twitter Search for COVID</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://covid19-twitter.in') }}">Vist site</a></td></tr>
                            <tr><td>Covid19 Resources</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://covidhelp.teamsaath.me') }}">Vist site</a></td></tr>
                            <tr><td>dhoondh</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://plasmadonor.in') }}">Vist site</a></td></tr>
                            <tr><td>CoV19InfoHubIndia</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://linktr.ee/CoV19InfoHubIndia') }}">Vist site</a></td></tr>
                            <tr><td>Covid.army</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://covid.army') }}">Vist site</a></td></tr>
                            <tr><td>crows sourcing data</td><td> <a type="button" class="btn btn-primary" href="{{ url('https://covidfacts.in') }}">Vist site</a></td></tr>
                            <tr><td>Covid Fight Club</td><td> <a type="button" class="btn btn-primary" href="{{ url('http://covidfacts.in') }}">Vist site</a></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection