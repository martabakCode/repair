<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle"
         style="opacity: .8">
        <span class="brand-text font-weight-light">Repair</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                @if (auth()->user()->level == 'admin'||auth()->user()->level == 'teknisi')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p> Master <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mesin.index') }}" class="nav-link">
                                <p>Mesin</p>
                            </a>
                        </li>
                        @if (auth()->user()->level == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <p>User</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('teknisi.index') }}" class="nav-link">
                                <p>Teknisi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-book"></i>
                        <p> Transaksi <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('perbaikan.index') }}" class="nav-link">
                                <p>Perbaikan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p> Laporan <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('perbaikan.indexLaporan') }}" class="nav-link">
                                <p>Laporan Perbaikan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif (auth()->user()->level == 'user')
                <li class="nav-item">
                    <a href="{{ route('user.perbaikan.create') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <p>Permintaan Perbaikan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.perbaikan.index') }}" class="nav-link">
                        <i class="fas fa-copy"></i>
                        <p>Appoval Repair</p>
                    </a>
                </li>
                @endif
                @endauth

            </ul>
        </nav>
    </div>
</aside>
