<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li>
                <p class="fw-bold text-white m-0"><span id="date"></span> <span id="time"></span></p>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            {{-- <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    src="{{ getUserLogin()->foto ? getUserLogin()->foto : asset('img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1" width="30" height="30">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ getUserLogin()->name }}</div>
            </a> --}}
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                {{-- <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a> --}}
                <a href="#" class="dropdown-item has-icon text-danger" data-toggle="modal"
                    data-target="#modal-logout" data-backdrop="static" data-keyboard="false">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
