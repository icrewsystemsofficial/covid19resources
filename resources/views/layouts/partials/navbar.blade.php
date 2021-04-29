@if (cache()->get('key') == 'dark')
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
@else
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
@endif

    <div class="container-fluid">
        <div class="collapse" id="search-nav">

            <span class="text-white" id="clock-box">
                { TIME }
            </span>
            <span class="text-white" id="currentlocation_intro">
                | <span id="location">{{ $currentlocation->name }}</span>
            </span>
        </div>

        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="searchDropdown">
                    <li>
                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                            Search
                        </div>
                    </li>
                    <li>
                        <div class="d-flex justify-content-between align-items-center bg-primary">
                            <form action="{{ route('home.search.results') }}" class="navbar-form nav-search mr-md-3" >
                                <div class="input-group">
                                    <input name="query" type="text" placeholder="What are you looking for?" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn text-white fw-bold">
                                            Go
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="message-notif-scroll scrollbar-outer">
                            <div class="notif-center">

                                @php
                                    $searchQuery = array(
                                        'Delhi Oxygen',
                                        'Mumbai Hospital Beds',
                                        'Chennai Oxygen',
                                        'Fabiflu Delhi'
                                    )
                                @endphp


                                @foreach ($searchQuery as $search)
                                    <a href="{{ route('home.search.results', '?query=' . $search.'') }}" class="ml-2">
                                        <div class="notif-content text-muted">
                                            <span class="block">
                                            <i class="fa fa-line-chart"></i> {{ $search }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);">
                            Go to search module <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li id="share_link_nav" class="nav-item dropdown hidden-caret">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-share-alt"></i>
                </a>
                <div class="dropdown-menu quick-actions quick-actions-primary animated fadeIn">
                    <div class="quick-actions-header">
                        <span class="title mb-1">Share & Save lives</span>
                        <span class="subtitle">
                            We're a population of 1.3 billion people. We have enough to help each other.
                            We've done our duty by developing this tool. We're requesting you to do yours, by sharing this tool
                            with all the humans in your life.
                        </span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                        <div class="quick-actions-items">
                            <div class="row m-0">
                                <div class="col-md-12">
                                    @auth
                                        <label for="referrallink" class="mb-2">
                                            <strong>
                                                Your referral link
                                            </strong>
                                        </label>
                                        <input id="referral_link_navbar" onclick="copyReferralURL();" type="text" class="form-control" value="{{ route('generate.referrallink', auth()->user()->referral_link) }}">
                                        @if(auth()->user()->referrals > 0)
                                            <p class="mt-2 text-muted mx-auto">
                                                Your referral link was used <strong>{{ auth()->user()->referrals }} times</strong>.
                                            </p>
                                        @endif
                                    @endauth

                                    @guest
                                    <label for="referrallink" class="mb-2">
                                        <strong>
                                            Share link
                                        </strong>
                                    </label>
                                        <input id="referral_link_navbar" onclick="copyReferralURL();" type="text" class="form-control" value="{{ config('app.url') }}">

                                        <p class="mt-2 text-muted mx-auto">
                                            Login to get personalized referral link.
                                        </p>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
            </li>
            @auth
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                            <span class="avatar-title rounded-circle border border-white">{{ auth()->user()->initials }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    {{-- <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}" alt="image profile" class="avatar-img rounded"> --}}
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white">
                                          {{ auth()->user()->initials }}
                                        </span>
                                    </div>
                                </div>
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>

                                    @if(auth()->user()->hasRole('volunteer'))
                                        @if (auth()->user()->available_for_mission == 1)
                                            <span class="badge badge-success">
                                                Available for mission
                                            </span>

                                            @else
                                            <span class="badge badge-dark">
                                                Unavailable for missions
                                            </span>
                                        @endif
                                    @endif

                                    {{-- <p class="h5 text-muted">{{ auth()->user()->states->name }}</p> --}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            {{-- <a class="dropdown-item" href="{{ route('home.profile.view') }}">View Profile</a>
                            <div class="dropdown-divider"></div> --}}
                            <a class="dropdown-item" href="{{ route('home.profile.edit') }}">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <form id="logout_form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                            <a class="dropdown-item" onclick="document.getElementById('logout_form').submit()">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
            @endauth

            @guest
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link" href="{{ route('login') }}" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
            </li>
            @endguest
        </ul>
    </div>
</nav>
