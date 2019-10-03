<ul class="nav nav-tabs">
<li {{Request::is('dokumen/*') ? 'class=active' : ''}}><a href="{{ route('dokumen.show', $dokumen->id)}}">Dokumen</a></li>
<li {{Request::is('detail-barang/index/*') ? 'class=active' : ''}}><a href="{{ route('detail.index', $dokumen->id) }}">Detail Barang</a></li>
@if($dokumen->status_id > 2 and $dokumen->status_id <= 7)
<li {{Request::is('instruksi-pemeriksaan/show/*') ? 'class=active' : ''}}><a href="{{route('instruksi-pemeriksaan.show', $dokumen->id)}}">IP</a></li>
@endif
@if($dokumen->status_id > 3 and $dokumen->status_id <= 7)
<li {{Request::is('lhp/show/*') ? 'class=active' : ''}}><a href="{{ route('lhp.show.tab', $dokumen->id)}}">LHP</a></li>
@endif

<li {{Request::is('jaminan/dokumen/*') ? 'class=active' : ''}}><a href="{{route('dokumen.jaminan', $dokumen->id)}}">Jaminan</a></li>

<li {{Request::is('cetak/*') ? 'class=active' : ''}}><a href="{{route('cetak.show', $dokumen->id)}}">Cetak</a></li>
<li {{Request::is('detail-barang/show/*') ? 'class=active' : ''}} {{Request::is('detail-barang/show/*') ? '' : 'style=display:none'}}><a href="#">Show Barang</a></li>
<li {{Request::is('instruksi-pemeriksaan/create/*') ? 'class=active' : ''}} {{Request::is('instruksi-pemeriksaan/create/*') ? '' : 'style=display:none'}}><a href="#">Rekam IP</a></li>
</ul>