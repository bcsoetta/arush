<div class="row">
      @can('PENERIMAAN-DOKUMEN')
      @if($dokumen->status_id == 1)
      <form action="{{ route('dokumen.terima', $dokumen->id)}}" method="POST">
      {{ csrf_field() }}
      <button class="btn btn-danger pull-right" style="margin: 10px" type="submit" onclick="konfirm()">TERIMA DOK (BERI NOMOR)</button>
      
      </form>
      @endif
      @endcan
      @can('CREATE-IP')
      @if($dokumen->status_id == 2)
      <a href="{{ route('instruksi-pemeriksaan.create', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Rekam Instruksi Pemeriksaan (IP)</button></a>
      @endif
      @endcan
      <!-- @can('PERHITUNGAN-JAMINAN')
      @if($dokumen->status_id == 4)
      <a href="{{ route('jaminan.hitung', $dokumen->id)}}"><button class="btn btn-danger pull-right" style="margin: 10px">Perhitungan Jaminan</button></a>
      @endif
      @endcan
      @can('VIEW-JAMINAN')
      @if($dokumen->status_id == 5)
      <a href="{{ route('jaminan.index')}}"><button class="btn btn-danger pull-right" style="margin: 10px">Konfirmasi Jaminan</button></a>
      @endif
      @endcan -->
      @can('EDIT-SPPB')
      @if($dokumen->status_id == 4)
      <form action="{{ route('putus.sppb.index', $dokumen->id)}}" method="POST">
      {{ csrf_field() }}
      <button class="btn btn-danger pull-right" style="margin: 10px" onclick="konfirm()" type="submit">Putus SPPB</button>
      </form>
      @endif
      @endcan   
</div>