<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sb Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    @can('admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Pegawai</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('obat*') ? 'active' : '' }}">
            <a class="nav-link" href="/obat">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Obat</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('tindakan*') ? 'active' : '' }}">
            <a class="nav-link" href="/tindakan">
                <i class="fas fa-fw fa-table"></i>
                <span>Tindakan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Kunjungan</span></a>
        </li>
    @endcan

    @can('petugas_pendaftaran')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('pendaftaran') ? 'active' : '' }}">
            <a class="nav-link" href="/pendaftaran">
                <i class="fas fa-fw fa-table"></i>
                <span>Daftar Kunjungan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('pendaftaran-pasien') ? 'active' : '' }}">
            <a class="nav-link" href="/pendaftaran-pasien">
                <i class="fas fa-fw fa-table"></i>
                <span>Pendaftaran Pasien</span></a>
        </li>
    @endcan

    @can('dokter')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('dokter') ? 'active' : '' }}">
            <a class="nav-link" href="/dokter">
                <i class="fas fa-fw fa-table"></i>
                <span>Menu Dokter</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('checkin') ? 'active' : '' }}">
            <a class="nav-link" href="/checkin">
                <i class="fas fa-fw fa-table"></i>
                <span>Check-in Pasien</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('resep') ? 'active' : '' }}">
            <a class="nav-link" href="/resep">
                <i class="fas fa-fw fa-table"></i>
                <span>Tambah Resep</span></a>
        </li>
    @endcan

    @can('kasir')
        <!-- Nav Item - Tables -->
        <li class="nav-item {{ Request::is('tindakan*') ? 'active' : '' }}">
            <a class="nav-link" href="/tindakan">
                <i class="fas fa-fw fa-table"></i>
                <span>Menu Kasir</span></a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->

</ul>
