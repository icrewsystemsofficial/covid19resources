@extends('layouts.atlantis')
@section('title', 'Statistics Page')
@section('js')
    <script>
        $(document).ready( function () {
            $('#resource_table').DataTable();
        });
    </script>
@endsection
@section('content')
<div class="page-inner">
    <div class="page-header mt-2">
        <h4 class="page-title">Statistics</h4>
    </div>
    <p>
        This is a collection of how much data we have handled and processed.
    </p>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fa fa-check-circle text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category"> Verified Resources</p>
                                        <h4 class="card-title" id="verified">{{ $resources_verified}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Tweets</p>
                                        <h4 class="card-title" id="pending">{{ $tweetstotal }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category"> Total Users</p>
                                        <h4 class="card-title" id="refuted">{{ $userstotal }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fa fa-exclamation-triangle text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Pending Resources</p>
                                                <h4 class="card-title" id="verified">{{ $resources_pending}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-sm-12 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fab fa-twitter"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Verified Tweets</p>
                                                <h4 class="card-title" id="pending">{{ $tweetsverified }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-sm-12 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-hands-helping"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category"> Volunteers</p>
                                                <h4 class="card-title" id="refuted">{{ $usersvolunteer }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fa fa-times-circle text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Spam Resources</p>
                                                        <h4 class="card-title" id="verified">{{ $resources_spam}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-sm-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fab fa-twitter"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Pending Tweets</p>
                                                        <h4 class="card-title" id="pending">{{ $tweetspending }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-sm-12 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fa-hands-helping"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Admins</p>
                                                        <h4 class="card-title" id="refuted">{{ $usersadmin}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="card card-stats card-round">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fas fa-hospital-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category">Total Resources</p>
                                                                <h4 class="card-title" id="verified">{{ $resources_pending}}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="card card-stats card-round">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="icon-big text-center">
                                                                <i class="fab fa-twitter"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-stats">
                                                            <div class="numbers">
                                                                <p class="card-category">Tweets with Inadequate Information</p>
                                                                <h4 class="card-title" id="pending">{{ $tweetsinadequate }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                  
                        
                                    </div>
            <br><br>
        </div>
    </div>
</div>
@endsection
