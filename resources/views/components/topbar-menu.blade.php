<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <div class="hidden-sm"></div>
            <a href="#" class="nav-link nav-link-lg message-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-flag"></i></a>
            <div class="dropdown-menu">
                <a class="dropdown-item has-icon" href="#">English</a>
                {{-- <a class="dropdown-item has-icon" href="{{ route('change-lang',['bm']) }}">Bahasa Melayu</a> --}}
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="{{ asset("img/avatar/avatar-1.png") }}" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b>
                            <p>Hello, Bro!</p>
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Welcome to Stisla template!
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{-- <img alt="image" src="{{ asset("img/avatar/avatar-1.png") }}" class="rounded-circle mr-1"> --}}
                <div class="d-sm-none d-lg-inline-block">Hi, Admin</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                {{-- <a href="{{ route('xlogout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form action="{{ route('xlogout') }}" id="logout-form" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> --}}
            </div>
        </li>
    </ul>
</nav>