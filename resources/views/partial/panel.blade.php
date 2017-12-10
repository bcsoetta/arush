<div class="row">
      @can('PENERIMAAN-DOKUMEN')
      @if($dokumen->status_id == 1)
      <a href="{{ route('dokumen.terima', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Penerimaan Dokumen</button></a>
      @endif
      @endcan
      @can('CREATE-IP')
      @if($dokumen->status_id == 2)
      <a href="{{ route('instruksi-pemeriksaan.create', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Rekam IP</button></a>
      @endif
      @endcan
      @can('PERHITUNGAN-JAMINAN')
      @if($dokumen->status_id == 4)
      <a href="{{ route('jaminan.hitung', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Perhitungan Jaminan</button></a>
      @endif
      @endcan
      @can('VIEW-JAMINAN')
      @if($dokumen->status_id == 5)
      <a href="{{ route('jaminan.index')}}"><button class="btn btn-danger pull-right" style="margin: 10px">Konfirmasi Jaminan</button></a>
      @endif
      @endcan
      @can('EDIT-SPPB')
      @if($dokumen->status_id == 6)
      <a href="{{ route('putus.sppb.index', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Putus SPPB</button></a>
      @endif
      @endcan   
</div>       