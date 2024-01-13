<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Rental Mobil</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Transaksi Start --}}
                <li class="nav-item {{ $title == 'Transaksi' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Transaksi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('transaksi') }}"
                                class="nav-link {{ $action == 'lihat_transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}"
                                class="nav-link {{ $action == 'tambah_transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Invoice</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Transaksi End --}}

                {{-- Pengeluaran Start --}}

                <li class="nav-item {{ $title == 'Pengeluaran' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Pengeluaran' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-wallet"></i>
                        <p>
                            Pengeluaran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('pengeluaran') }}"
                                class="nav-link {{ $action == 'lihat_pengeluaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}"
                                class="nav-link {{ $action == 'tambah_pengeluaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Pengeluaran End --}}

                {{-- Unit Kendaraan Start --}}
                <li class="nav-item {{ $title == 'Kendaraan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Kendaraan' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-car"></i>
                        <p>
                            Unit Kendaraan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/kendaraan') }}"
                                class="nav-link {{ $action == 'lihat_kendaraan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Unit Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}"
                                class="nav-link {{ $action == 'tambah_kendaraan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Unit Kendaraan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Unit Kendaraan End --}}

                {{-- Beranda Start --}}
                <li class="nav-item {{ $title == 'Beranda' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Beranda' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-chart-line"></i>
                        <p>
                            Beranda
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekap Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekap Pemasukkan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Beranda End --}}
            </ul>
        </nav>
    </div>
</aside>
