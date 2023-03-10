<div class="main-sidebar sidebar-style-2 ">
    <aside id="sidebar-wrapper" class="">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">SLIMS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"
                    class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>      
            <li class="menu-header">Master</li>
            <li class="nav-item dropdown {{ $type_menu === 'master' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Objek</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pasien') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('pasien') }}">Pasien</a>
                    </li>
                    <li class="{{ Request::is('dokter') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dokter') }}">Dokter</a>
                    </li>
                    <li class="{{ Request::is('analis') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('analis') }}">Analis</a>
                    </li>
                    <li class="{{ Request::is('ruangan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('ruangan') }}">Ruangan</a>
                    </li>
                    <li class="{{ Request::is('asuransi') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('asuransi') }}">Asuransi</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'parameter' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Pemeriksaan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('parameter') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('parameter') }}">Parameter</a>
                    </li>
                    <li class="{{ Request::is('paket_parameter') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('paket_parameter') }}">Paket Parameter</a>
                    </li>
                    <li class="{{ Request::is('grub_parameter') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('grub_parameter') }}">Grub Parameter</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'components' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Analyzer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('components-article') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('components-article') }}">Kategori Analyzer</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="nav-item dropdown {{ $type_menu === 'worklist' ? 'active' : '' }}">
                <a href="{{ url('transaksi_lab') }}"
                    class="nav-link "><i class="fas fa-th-large"></i>
                    <span>Worklist</span></a>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'order_paket' ? 'active' : '' }}">
                <a href="{{ url('order_paket') }}"
                    class="nav-link "><i class="far fa-file-alt"></i> <span>Order  Pemeriksaan</span></a>                
            </li>
            <li class="menu-header">Report</li>
            <li class="nav-item dropdown {{ $type_menu === 'auth' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Forgot Password</a>
                    </li>
                    <li class="{{ Request::is('auth-login') ? 'active' : '' }}">
                        <a href="{{ url('auth-login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('auth-login2') ? 'active' : '' }}">
                        <a class="beep beep-sidebar"
                            href="{{ url('auth-login2') }}">Login 2</a>
                    </li>
                    <li class="{{ Request::is('auth-register') ? 'active' : '' }}">
                        <a href="{{ url('auth-register') }}">Register</a>
                    </li>
                    <li class="{{ Request::is('auth-reset-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-reset-password') }}">Reset Password</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('credits') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Credits</span>
                </a>
            </li>

            <li class="menu-header">System</li>
            <li class="nav-item dropdown {{ $type_menu === 'auth' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Forgot Password</a>
                    </li>
                    <li class="{{ Request::is('auth-login') ? 'active' : '' }}">
                        <a href="{{ url('auth-login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('auth-login2') ? 'active' : '' }}">
                        <a class="beep beep-sidebar"
                            href="{{ url('auth-login2') }}">Login 2</a>
                    </li>
                    <li class="{{ Request::is('auth-register') ? 'active' : '' }}">
                        <a href="{{ url('auth-register') }}">Register</a>
                    </li>
                    <li class="{{ Request::is('auth-reset-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-reset-password') }}">Reset Password</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('credits') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Settings</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
