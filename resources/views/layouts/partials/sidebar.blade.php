<div class="sidebar sidebar-style-2" data-background-color="white">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
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
                    </div>
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
                    <a href="{{ route('admin.faq.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <p>FAQ</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Content</p>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.categories.index') }}">
                                    <span class="sub-item">Categories</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.faq.index') }}">
                                    <span class="sub-item">FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
