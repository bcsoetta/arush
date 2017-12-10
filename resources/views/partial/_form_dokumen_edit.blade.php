{{-- partial fomr --}}
<div class="row">
    <div class="col-md-6">
        <h3>Importir :</h3>
        <div class="form-group {{ $errors->has('importir_nm') ? ' has-error' : '' }}">
            <label for="importir_npwp">Nama</label>
            <input type="text" class="form-control" name="importir_nm" value="{{ $dokumen->importir_nm }}" placeholder="nama" autofocus>
            @if ($errors->has('importir_nm'))
            <span class="help-block">
                {{ $errors->first('importir_nm') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('importir_npwp') ? ' has-error' : '' }}">
            <label for="importir_npwp">NPWP</label>
            <input type="text" class="form-control" name="importir_npwp" value="{{ $dokumen->importir_npwp }}" placeholder="npwp">
            @if ($errors->has('importir_npwp'))
            <span class="help-block">
                {{ $errors->first('importir_npwp') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('importir_alamat') ? ' has-error' : '' }}">
            <label for="importir_alamat">Alamat</label>
            <textarea class="form-control" rows="2" name="importir_alamat" placeholder="alamat">{{ $dokumen->importir_alamat }}</textarea>
            @if ($errors->has('importir_alamat'))
            <span class="help-block">
                {{ $errors->first('importir_alamat') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <h3>PPJK :</h3>
        <div class="form-group {{ $errors->has('ppjk_nm') ? ' has-error' : '' }}">
            <label for="ppjk_nm">Nama</label>
            <input type="text" class="form-control" name="ppjk_nm" value="{{ $dokumen->ppjk_nm }}" placeholder="nama" autofocus>
            @if ($errors->has('ppjk_nm'))
            <span class="help-block">
                {{ $errors->first('ppjk_nm') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('ppjk_npwp') ? ' has-error' : '' }}">
            <label for="ppjk_npwp">NPWP</label>
            <input type="npwp" class="form-control" name="ppjk_npwp" value="{{ $dokumen->ppjk_npwp }}" placeholder="npwp">
            @if ($errors->has('ppjk_npwp'))
            <span class="help-block">
                {{ $errors->first('ppjk_npwp') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('ppjk_alamat') ? ' has-error' : '' }}">
            <label for="ppjk_alamat">Alamat</label>
            <textarea class="form-control" rows="2" name="ppjk_alamat" placeholder="alamat">{{ $dokumen->ppjk_alamat }}</textarea>
            @if ($errors->has('ppjk_alamat'))
            <span class="help-block">
                {{ $errors->first('ppjk_alamat') }}
            </span>
            @endif
        </div>
    </div>
</div>

<h3>Pengangkut :</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('pengangkut') ? ' has-error' : '' }}">
            <label for="importir_npwp">Kode</label>
            <select class="form-control" name="pengangkut" id="angkut">
                @foreach($pengangkut as $angkut)
                <option value="{{$angkut->id}}" {{ $dokumen->pengangku_id == $angkut->id ? 'selected': '' }}>{{$angkut->kode}} - {{$angkut->pesawat}}</option>
                @endforeach
            </select>
            @if ($errors->has('pengangkut'))
            <span class="help-block">
                {{ $errors->first('pengangkut') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('tiba_tgl') ? ' has-error' : '' }}" id="tgl">
            <label for="importir_npwp">Tanggal Tiba</label>
            <input type="text" class="form-control" name="tiba_tgl" value="{{ $dokumen->tiba_tgl }}" placeholder="tanggal">
            @if ($errors->has('tiba_tgl'))
            <span class="help-block">
                {{ $errors->first('tiba_tgl') }}
            </span>
            @endif
        </div>            
    </div>
</div>

<h3>Manifest :</h3>
<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('mawb_no') ? ' has-error' : '' }}">
            <label for="importir_npwp">No. MAWB</label>
            <input type="text" class="form-control" name="mawb_no" value="{{ $dokumen->mawb_no }}" placeholder="nomor mawb">
            @if ($errors->has('mawb_no'))
            <span class="help-block">
                {{ $errors->first('mawb_no') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('mawb_tgl') ? ' has-error' : '' }}" id="tgl">
            <label for="importir_npwp">Tgl. MAWB</label>
            <input type="text" class="form-control" name="mawb_tgl" value="{{ $dokumen->mawb_tgl }}" placeholder="tgl mawb">
            @if ($errors->has('mawb_tgl'))
            <span class="help-block">
                {{ $errors->first('mawb_tgl') }}
            </span>
            @endif
        </div>            
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('hawb_no') ? ' has-error' : '' }}">
            <label for="importir_npwp">No. HAWB</label>
            <input type="text" class="form-control" name="hawb_no" value="{{ $dokumen->hawb_no }}" placeholder="nomor hawb">
            @if ($errors->has('hawb_no'))
            <span class="help-block">
                {{ $errors->first('hawb_no') }}
            </span>
            @endif
            <span>jika tidak ada HAWB isi dengan MAWB</span>
        </div>            
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('hawb_tgl') ? ' has-error' : '' }}" id="tgl">
            <label for="importir_npwp">Tgl. HAWB</label>
            <input type="text" class="form-control" name="hawb_tgl" value="{{ $dokumen->hawb_tgl }}" placeholder="tgl hawb">
            @if ($errors->has('hawb_tgl'))
            <span class="help-block">
                {{ $errors->first('hawb_tgl') }}
            </span>
            @endif
        </div>            
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('bc11_no') ? ' has-error' : '' }}">
            <label for="importir_npwp">Nomor BC11</label>
            <input type="text" class="form-control" name="bc11_no" value="{{ $dokumen->bc11_no }}" placeholder="bc11 nomor">
            @if ($errors->has('bc11_no'))
            <span class="help-block">
                {{ $errors->first('bc11_no') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('bc11_pos') ? ' has-error' : '' }}">
            <label for="importir_npwp">BC11 Pos</label>
            <input type="text" class="form-control" name="bc11_pos" value="{{ $dokumen->bc11_pos }}" placeholder="bc11 pos">
            @if ($errors->has('bc11_pos'))
            <span class="help-block">
                {{ $errors->first('bc11_pos') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('bc11_sub') ? ' has-error' : '' }}">
            <label for="importir_npwp">BC11 Sub</label>
            <input type="text" class="form-control" name="bc11_sub" value="{{ $dokumen->bc11_sub }}" placeholder="bc11 sub" >
            @if ($errors->has('bc11_sub'))
            <span class="help-block">
                {{ $errors->first('bc11_sub') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('bc11_tgl') ? ' has-error' : '' }}" id="tgl">
            <label for="importir_npwp">Tgl BC11</label>
            <input type="text" class="form-control" name="bc11_tgl" value="{{ $dokumen->bc11_tgl }}" placeholder="Tanggal BC11">
            @if ($errors->has('bc11_tgl'))
            <span class="help-block">
                {{ $errors->first('bc11_tgl') }}
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('kmsn_jmlh') ? ' has-error' : '' }}">
            <label for="importir_npwp">Jumlah kemasan</label>
            <input type="text" class="form-control" name="kmsn_jmlh" value="{{ $dokumen->kmsn_jmlh }}" placeholder="jumlah kemasan">
            @if ($errors->has('kmsn_jmlh'))
            <span class="help-block">
                {{ $errors->first('kmsn_jmlh') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('kmsn_jenis') ? ' has-error' : '' }}">
            <label for="importir_npwp">Jenis kemasan</label>
            <input type="text" class="form-control" name="kmsn_jenis" value="{{ $dokumen->kmsn_jenis }}" placeholder="Satuan kemasan">
            @if ($errors->has('kmsn_jenis'))
            <span class="help-block">
                {{ $errors->first('kmsn_jenis') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('brutto') ? ' has-error' : '' }}">
            <label for="importir_npwp">Brutto</label>
            <input type="text" class="form-control" name="brutto" value="{{ $dokumen->brutto }}" placeholder="brutto">
            @if ($errors->has('brutto'))
            <span class="help-block">
                {{ $errors->first('brutto') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('netto') ? ' has-error' : '' }}">
            <label for="importir_npwp">Netto</label>
            <input type="text" class="form-control" name="netto" value="{{ $dokumen->netto }}" placeholder="netto">
            @if ($errors->has('netto'))
            <span class="help-block">
                {{ $errors->first('netto') }}
            </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3>Lokasi</h3>
        <div class="form-group {{ $errors->has('lokasi') ? ' has-error' : '' }}">
            <label for="lokasi">Lokasi</label>
            <select class="form-control" name="lokasi" id="pilih">
                @foreach($lokasi as $tempat)
                <option value="{{$tempat->id}}" {{ $dokumen->lokasi_id == $tempat->id ? 'selected': '' }}>{{$tempat->kode}}-{{$tempat->nama}}</option>
                @endforeach
            </select>
            @if ($errors->has('lokasi'))
            <span class="help-block">
                {{ $errors->first('lokasi') }}
            </span>
            @endif
        </div>
    </div>
</div>

<h3>Fasilitas</h3>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('no_fasilitas') ? ' has-error' : '' }}">
            <label for="lokasi">Nomor</label>
             <input type="text" class="form-control" name="no_fasilitas" value="{{ $dokumen->no_fasilitas }}" placeholder="nomor">
            @if ($errors->has('no_fasilitas'))
            <span class="help-block">
                {{ $errors->first('no_fasilitas') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('tgl_fasilitas') ? ' has-error' : '' }}" id="tgl">
            <label for="lokasi">Tanggal</label>
             <input type="text" class="form-control" name="tgl_fasilitas" value="{{ $dokumen->tgl_fasilitas }}" placeholder="tanggal">
            @if ($errors->has('tgl_fasilitas'))
            <span class="help-block">
                {{ $errors->first('tgl_fasilitas') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('ket_fasilitas') ? ' has-error' : '' }}">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" rows="2" name="ket_fasilitas" placeholder="keterangan">{{ $dokumen->ket_fasilitas }}</textarea>
            @if ($errors->has('ket_fasilitas'))
            <span class="help-block">
                {{ $errors->first('ket_fasilitas') }}
            </span>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <div>
        <button type="submit" class="btn btn-primary main-color-bg pull-right">
            Simpan
        </button>
    </div>
</div>