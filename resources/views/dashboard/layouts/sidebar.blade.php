<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion p-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard.home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">اسم الموقع</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item -->
    @foreach($linkSidebarAdmin as $title => $linkAndIconInArray)
        <li class="nav-item active">
            <a class="nav-link" href="{{routeDashboard($linkAndIconInArray['link'])}}">
                <i class="fas fa-fw {{$linkAndIconInArray['icon']}}"></i>
                <span>{{$title}}</span></a>
        </li>
    @endforeach
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
