@if(auth()->user())
<ul class="nav navbar-nav">
    @can('VIEW-DOKUMEN')
    <li><a href="{{route('dokumen.index')}}">Dokumen</a></li>
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
    <li><a href="{{ route('pendox.index')}}">Pendok</a></li>
    @endcan
    @can('SEARCH')
    <li><a href="{{ route('search.index')}}">Pencarian</a></li>
    @endcan
    @can('SETTING')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @can('USERS')
            <li><a href="{{route('users.index')}}">Users</a></li>
            @endcan
            @can('ABSENSI')
            <li><a href="{{route('absensi.index')}}">Absensi (pemeriksa)</a></li>
            @endcan
            @can('PROFILE')
            <li><a href="{{route('profiles.index')}}">Profile</a></li>
            @endcan
            @can('KURS')
            <li><a href="{{route('kurs.index')}}">Kurs</a></li>
            @endcan
            @can('LOKASI')
            <li><a href="{{route('lokasi.index')}}">Lokasi</a></li>
            @endcan
            <li><a href="{{route('pengangkut.index')}}">Pengangkut</a></li>
            @can('ROLE')
            <li><a href="{{route('roles.index')}}">Role</a></li>
            @endcan
            @can('PERMISSION')
            <li><a href="{{route('permissions.index')}}">Permissions</a></li>
            @endcan
        </ul>
    </li>
    @endcan
</ul>
{{-- <div class="col-sm-4 col-md-4">
    <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </form>
</div> --}}
@endif

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @guest
    <li><a href="{{ route('login') }}">Login</a></li>
    <li><a href="{{ route('register') }}">Register</a></li>
    @else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
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