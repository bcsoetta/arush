@if(auth()->user())
<ul class="nav navbar-nav">
    @can('VIEW-DASHBOARD')
    <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
    @endcan
    @can('PJ-VIEW-MY-DOKUMEN')
    <li><a href="{{route('mydokumen.index')}}">My Dokumen</a></li>
    @endcan
    @can('VIEW-DOKUMEN')
    <li><a href="{{route('dokumen.proses')}}">Dokumen</a></li>
    @endcan
    @can('VIEW-JAMINAN')
    <li><a href="{{ route('jaminan.index')}}">Jaminan</a></li>
    @endcan
    @can('VIEW-IP')
    <li><a href="{{ route('instruksi-pemeriksaan.index')}}">Instruksi Pemeriksaan (IP)</a></li>
    @endcan
    @can('VIEW-LHP')
    <li><a href="{{ route('lhp.index')}}">Laporan Hasil Pemeriksaan (LHP)</a></li>
    @endcan
    @can('VIEW-GATE')
    <li><a href="{{ route('gateout.index')}}">Gate Out</a></li>
    @endcan
    @can('PENDOK')
    <li><a href="{{ route('pendox.index')}}">Rekam Dok Definitif</a></li>
    @endcan

    @can('LAPORAN-JAMINAN')
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{route('cetak.formCetakJaminanHarian')}}">Cetak Jaminan Hariaan</a></li>
            <li><a href="{{route('laporan.belumDefinitif')}}">Dokumen Belum Definitif</a></li>
            <li><a href="{{route('laporan.belumGateOut')}}">Dokumen Sudah SPPB, Belum Keluar</a></li>
            <li><a href="{{route('laporan.harian')}}">Jaminan Harian</a></li>
            <li><a href="{{route('laporan.formDownload')}}">Download Dokumen</a></li>
        </ul>
    </li>
    @endcan
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('change-password')}}">Change Password</a></li>
            @can('USERS')
            <li><a href="{{route('users.index')}}">Users</a></li>
            @endcan
            @can('SET-PERUSAHAAN')
            <li><a href="{{ route('perusahaan.index')}}">Perusahaan</a></li>
            @endcan
            @can('PROFILE')
            <li><a href="{{route('profiles.index')}}">Profile</a></li>
            @endcan
            @can('KURS')
            <li><a href="{{route('kurs.index')}}">Kurs</a></li>
            <li><a href="{{route('libur-nasional.index')}}">Libur Nasional</a></li>
            @endcan
            @can('LOKASI')
            <li><a href="{{route('lokasi.index')}}">Lokasi</a></li>
            @endcan
            @can('PENGANGKUT')
            <li><a href="{{route('pengangkut.index')}}">Pengangkut</a></li>
            @endcan
            @can('ROLE')
            <li><a href="{{route('roles.index')}}">Role</a></li>
            @endcan
            @can('PERMISSION')
            <li><a href="{{route('permissions.index')}}">Permissions</a></li>
            @endcan
            @can('RESET-PASSWORD')
            <li><a href="{{route('reset-password')}}">Reset Password</a></li>
            @endcan
            <li><a href="{{route('setting.show')}}">Setting</a></li>
        </ul>
    </li>
    @can('SEARCH')
    {{-- <li><a href="{{ route('search.index')}}">Pencarian <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li> --}}
    @endcan
</ul>
@endif

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @guest
    <li><a href="{{ route('login') }}">Login</a></li>
    {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
    @else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            {{-- <li><a href="{{ route('profile', Auth::user()->id) }}">Profile</a></li> --}}
            <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
@endguest
</ul>