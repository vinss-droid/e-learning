<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboardAdmin') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/telkom.png') }}" alt="Logo Tels" width="100%">
        </div>
        <div class="sidebar-brand-text mx-3 user-select-none">Tels Learning</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/{{ Auth::user()->level }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        DATA LAIN-LAIN
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('kelas') }}">
            <i class="fa-solid fa-school"></i>
            <span>Daftar Kelas</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin-mapel') }}">
            <i class="fa-solid fa-book"></i>
            <span>Daftar Mapel</span>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('jadwal') }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Daftar Jadwal</span>
        </a>
    </li>

    <div class="sidebar-heading">
        DATA USER
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-users fa-cog"></i>
            <span>Daftar Pengguna</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('guru') }}">
            <i class="fas fa-users fa-cog"></i>
            <span>Daftar Guru</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>