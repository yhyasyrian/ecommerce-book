<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Nav Item - User Information -->
    <div class="nav-item dropdown no-arrow ml-auto">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle"
                 src="{{asset('theme/img/undraw_profile.svg')}}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in" style="right: unset;left: 0"
             aria-labelledby="userDropdown">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
            <button class="dropdown-item" type="submit">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                تسجيل خروج
            </button>
            </form>
        </div>
    </div>
</nav>
