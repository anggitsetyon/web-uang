<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">A4 Cellular</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('transaksi') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="/transaksi" 
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-fw fa fa-file-text"></i>
            <span>Transaksi Keuangan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('jurnal','neraca','labarugi','perubahanmodal') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan</span>
        </a>            
        <div id="laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/jurnal">Jurnal Umum</a>
                <a class="collapse-item" href="/neraca">Neraca Saldo</a>
                <a class="collapse-item" href="/labarugi">Laporan Laba Rugi</a>
                <a class="collapse-item" href="/perubahanmodal">Laporan Perubahan Modal</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::is('kategori','user*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setelan"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setelan</span>
    </a>
    <div id="setelan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/kategori">Setting Kategori</a>
            @can('create user')
                <a class="collapse-item" href="/users">Setting Akun</a>
            @endcan
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>