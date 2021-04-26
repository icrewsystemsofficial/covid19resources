@extends('layouts.atlantis')
@section('title', 'Search')
@section('js')
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                    Keyword Search
                </h1>
                <p class="text-white h4">
                    Query the {{ config('app.name') }} database directly
                </p>
            </div>

        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('home.search.results') }}" class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="col-md-12">
                            <center>
                                <div class="input-group">
                                    <input name="query" type="text" placeholder="What are you looking for?" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-search pl-4">
                                            <i class="fa fa-search search-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>
                                Powered by Algolia
                            </center>
                        </div>

                        <p class="mt-3 text-muted">
                            1. This search module uses keyword filtering. The application will directly query for
                            the exact keyword you're looking for. Might be the name of your requirement, phone number of a
                            particular hospital, beds in a locality. The entire point of this module, is to narrow down results
                            and save time, therefore, a quick tip would be to NOT use common keywords.
                            <br>
                            2. We use <a href="https://www.algolia.com" class="text-primary" target="_blank">Algolia</a> for searching, it's a PAID service
                            which ICREWSYSTEMS SOFTWARE ENGINEERING LLP is offering for free to you. Please use it wisely.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
