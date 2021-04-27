
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

    <div class="container-fluid">
        <div class="collapse" id="search-nav">
            {{-- <form class="navbar-left navbar-form nav-search mr-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pr-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search ..." class="form-control">
                </div>
            </form> --}}
            <span class="text-white" id="clock-box">
                { TIME }
            </span>
            <span class="text-white">
                | <span id="location">{{ App\Http\Controllers\API\Location::locationDisplay()->name }}</span>
            </span>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            {{-- <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                </a>
                <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                    <li>
                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                            Messages
                            <a href="#" class="small">Mark all as read</a>
                        </div>
                    </li>
                    <li>
                        <div class="message-notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="{{ asset('atlantis/assets/img/jm_denis.jpg') }}" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Jimmy Denis</span>
                                        <span class="block">
                                            How are you ?
                                        </span>
                                        <span class="time">5 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="{{ asset('atlantis/assets/img/chadengle.jpg') }}" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Chad</span>
                                        <span class="block">
                                            Ok, Thanks !
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="{{ asset('atlantis/assets/img/mlane.jpg') }}" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Jhon Doe</span>
                                        <span class="block">
                                            Ready for the meeting today...
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="{{ asset('atlantis/assets/img/talha.jpg') }}" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="subject">Talha</span>
                                        <span class="block">
                                            Hi, Apa Kabar ?
                                        </span>
                                        <span class="time">17 minutes ago</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">4</span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">You have 4 new notification</div>
                    </li>
                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                <a href="#">
                                    <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            New user registered
                                        </span>
                                        <span class="time">5 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Rahmad commented on Admin
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <img src="{{ asset('atlantis/assets/img/profile2.jpg') }}" alt="Img Profile">
                                    </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Reza send messages to you
                                        </span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                    <div class="notif-content">
                                        <span class="block">
                                            Farrah liked Admin
                                        </span>
                                        <span class="time">17 minutes ago</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item dropdown hidden-caret">
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
<<<<<<< HEAD
                                <div class="quick-actions-item">
                                    <button class="btn btn-sm btn-secondary ml-3">
                                        @php
                                        echo Share::currentPage('I am helping to fight COVID 19 by sharing / adding / verifying resource list on the COVID19 Resource Directory. Check it out, share it with people. You never know who might be in dire desperate need of this')->facebook(); 
                                        @endphp
                                    </button>
                                </div>

                                <div class="quick-actions-item">
                                    <button class="btn btn-sm btn-secondary">
                                        @php
                                        echo Share::page('www.covid19resources.in','I am helping to fight COVID 19 by sharing / adding / verifying resource list on the COVID19 Resource Directory. Check it out, share it with people. You never know who might be in dire desperate need of this')->twitter(); 
                                        @endphp
                                    </button>
                                </div>

                                <div class="quick-actions-item">
                                    <button class="btn btn-sm btn-secondary">
                                        @php
                                        echo Share::page('www.covid19resources.in','Sharing Covid Resources')->linkedin('I am helping to fight COVID 19 by sharing / adding / verifying resource list on the COVID19 Resource Directory. Check it out, share it with people. You never know who might be in dire desperate need of this'); 
                                        @endphp
                                    </button>
                                </div>
                                
                                {{-- <a class="col-6 col-md-4 p-0" href="#"> --}}
                                <div class="quick-actions-item">
                                    <button class="btn btn-sm btn-success">
                                        @php
                                            echo Share::currentPage('I am helping to fight COVID 19 by sharing / adding / verifying resource list on the COVID19 Resource Directory. Check it out, share it with people. You never know who might be in dire desperate need of this')->whatsapp();
                                        @endphp
                                    </button>
                                </div>
                                {{-- </a> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
=======
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
>>>>>>> 02edd4a9a64e86dbf542cf2e8399e9e7137c3ff8
            </li>
            @auth
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
<<<<<<< HEAD
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="..." class="avatar-img rounded-circle">
=======
                            <span class="avatar-title rounded-circle border border-white">{{ auth()->user()->initials }}</span>
>>>>>>> 02edd4a9a64e86dbf542cf2e8399e9e7137c3ff8
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
<<<<<<< HEAD
                                <div class="avatar-lg"><img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="image profile" class="avatar-img rounded"></div>
=======
                                <div class="avatar-lg">
                                    {{-- <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}" alt="image profile" class="avatar-img rounded"> --}}
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white">
                                          {{ auth()->user()->initials }}
                                        </span>
                                    </div>
                                </div>
>>>>>>> f5a609caaa08e8edaec3b7e6af8d0d29d3168377
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

