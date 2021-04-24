<div class="sidebar sidebar-style-2" data-background-color="white">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-heartbeat"></i>
                        <p>Dashboard</p>
                    </a>
                    {{-- <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('home') }}"">
                                    <span class="sub-item">Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('atlantis/examples/demo1/index.html') }}" target="_blank">
                                    <span class="sub-item">Theme Reference</span>
                                </a>
                            </li>
                        </ul>
                    </div> --}}
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Volunteering</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home.volunteers.index') }}">
                        <i class="fas fa-hands"></i>
                        <p>Volunteer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home.volunteers.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <p>Missions</p>
                    </a>
                </li>


                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Administration</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.twitter.index') }}">
                        <i class="fab fa-twitter"></i>
                        <p>Tweets</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.resources.index') }}">
                        <i class="fas fa-database"></i>
                        <p>Resources</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <p>FAQ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('accesscontrol.index') }}">
                        <i class="fas fa-shield-alt"></i>
                        <p>Access Control</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('activity.log') }}">
                        <i class="fas fa-history"></i>
                        <p>Activity Log</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-globe-americas"></i>
                        <p>Geography</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.geographies.districts.index') }}">
                                    <span class="sub-item">Districts</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.geographies.states.index') }}">
                                    <span class="sub-item">States & UT</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.geographies.cities.index') }}">
                                    <span class="sub-item">Cities</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
