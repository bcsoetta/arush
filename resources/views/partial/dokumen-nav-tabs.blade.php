<ul class="nav nav-tabs">
    <li role="presentation" class="@if (Request::is('dokumen-proses')) { active } @endif"><a href="{{route('dokumen.proses')}}">Proses</a></li>
    <li role="presentation" class="@if (Request::is('dokumen')) { active } @endif"><a href="{{route('dokumen.index')}}">Semua Dokumen</a></li>
</ul>