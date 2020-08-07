{{-- partial fomr --}}
<div class="row">
    <div class="col-md-6">
        <h3>Importir :</h3>
        <div class="form-group {{ $errors->has('importir_nm') ? ' has-error' : '' }}">
            <label for="importir_npwp">Nama</label>
            <input type="text" class="form-control" name="importir_nm" value="{{ old('importir_nm') }}" placeholder="nama" id="importir_nm" autofocus>
            @if ($errors->has('importir_nm'))
            <span class="help-block">
                {{ $errors->first('importir_nm') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('importir_npwp') ? ' has-error' : '' }}">
            <label for="importir_npwp">NPWP</label>
            <input type="text" class="form-control" name="importir_npwp" value="{{ old('importir_npwp') }}" placeholder="npwp" id="importir_npwp">
            @if ($errors->has('importir_npwp'))
            <span class="help-block">
                {{ $errors->first('importir_npwp') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('importir_alamat') ? ' has-error' : '' }}">
            <label for="importir_alamat">Alamat</label>
            <textarea class="form-control" rows="2" name="importir_alamat" placeholder="alamat" id="importir_alamat">{{ old('importir_alamat') }}</textarea>
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
            <input type="text" class="form-control" name="ppjk_nm" value="{{ old('ppjk_nm') }}" placeholder="nama" id="ppjk_nm" autofocus>
            @if ($errors->has('ppjk_nm'))
            <span class="help-block">
                {{ $errors->first('ppjk_nm') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('ppjk_npwp') ? ' has-error' : '' }}">
            <label for="ppjk_npwp">NPWP</label>
            <input type="npwp" class="form-control" name="ppjk_npwp" value="{{ old('ppjk_npwp') }}" id="ppjk_npwp" placeholder="npwp">
            @if ($errors->has('ppjk_npwp'))
            <span class="help-block">
                {{ $errors->first('ppjk_npwp') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('ppjk_alamat') ? ' has-error' : '' }}">
            <label for="ppjk_alamat">Alamat</label>
            <textarea class="form-control" rows="2" name="ppjk_alamat" placeholder="alamat" id="ppjk_alamat" >{{ old('ppjk_alamat') }}</textarea>
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
                <option selected></option>
                @foreach($pengangkut as $angkut)
                <option value="{{$angkut->id}}" {{$angkut->id == old('pengangkut') ? 'selected':''}}>{{$angkut->kode}} - {{$angkut->pesawat}}</option>
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
            <input type="text" class="form-control" name="tiba_tgl" value="{{ old('tiba_tgl') }}" placeholder="tanggal">
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
        <div class="form-group {{ $errors->has('hawb_no') ? ' has-error' : '' }}">
            <label for="importir_npwp">No. HAWB</label>
            <input type="text" class="form-control" name="hawb_no" value="{{ old('hawb_no') }}" placeholder="nomor hawb">
            @if ($errors->has('hawb_no'))
            <span class="help-block">
                {{ $errors->first('hawb_no') }}
            </span>
            @endif
        </div>            
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('hawb_tgl') ? ' has-error' : '' }}" id="tgl">
            <label for="importir_npwp">Tgl. HAWB</label>
            <input type="text" class="form-control" name="hawb_tgl" value="{{ old('hawb_tgl') }}" placeholder="tgl hawb">
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
        <div class="form-group {{ $errors->has('kmsn_jmlh') ? ' has-error' : '' }}">
            <label for="importir_npwp">Jumlah kemasan</label>
            <input type="text" class="form-control" name="kmsn_jmlh" value="{{ old('kmsn_jmlh') }}" placeholder="jumlah kemasan">
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
            <input type="text" class="form-control" name="kmsn_jenis" value="{{ old('kmsn_jenis') }}" placeholder="Jenis kemasan">
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
            <input type="text" class="form-control" name="brutto" value="{{ old('brutto') }}" placeholder="brutto">
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
            <input type="text" class="form-control" name="netto" value="{{ old('netto') }}" placeholder="netto">
            @if ($errors->has('netto'))
            <span class="help-block">
                {{ $errors->first('netto') }}
            </span>
            @endif
        </div>
    </div>
</div>
{{--BC 11--}}

<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('no_bc_11') ? ' has-error' : '' }}">
            <label for="importir_npwp">No BC 11</label>
            <input type="text" class="form-control" name="no_bc_11" value="{{ old('no_bc_11') }}" placeholder="no bc 11">
            @if ($errors->has('no_bc_11'))
            <span class="help-block">
                {{ $errors->first('no_bc_11') }}
            </span>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->has('pos_bc_11') ? ' has-error' : '' }}">
            <label for="importir_npwp">Pos</label>
            <input type="text" class="form-control" name="pos_bc_11" value="{{ old('pos_bc_11') }}" placeholder="pos bc 11">
            @if ($errors->has('pos_bc_11'))
            <span class="help-block">
                {{ $errors->first('pos_bc_11') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('sub_pos_bc_11') ? ' has-error' : '' }}">
            <label for="importir_npwp">Sub Pos</label>
            <input type="text" class="form-control" name="sub_pos_bc_11" value="{{ old('sub_pos_bc_11') }}" placeholder="Sub Pos BC 11">
            @if ($errors->has('sub_pos_bc_11'))
            <span class="help-block">
                {{ $errors->first('sub_pos_bc_11') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('tgl_bc_11') ? ' has-error' : '' }} input_tgl">
            <label for="importir_npwp">Tgl Bc 11</label>
            <input type="text" class="form-control" name="tgl_bc_11" value="{{ old('tgl_bc_11') }}" placeholder="tgl Bc 11">
            @if ($errors->has('tgl_bc_11'))
            <span class="help-block">
                {{ $errors->first('tgl_bc_11') }}
            </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('partial_manifes') ? ' has-error' : '' }}">
            <label>Partial Manifes</label>
            <select class="form-control pilih-select" name="partial_manifes">
                <option value="N" {{ old('partial_manifes') == 'N' ? 'selected':''}}>Tidak</option>
                <option value="Y" {{ old('partial_manifes') == 'Y' ? 'selected':''}}>Ya</option>                
            </select>
            @if ($errors->has('partial_manifes'))
            <span class="help-block">
                {{ $errors->first('partial_manifes') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('partial_ke') ? ' has-error' : '' }}">
            <label>Partial ke-</label>
            <select class="form-control pilih-select" name="partial_ke">
                <option value="" selected></option>
                <option value="1" {{ old('partial_ke') == '1' ? 'selected':''}}>1</option>
                <option value="2" {{ old('partial_ke') == '2' ? 'selected':''}}>2</option>                
                <option value="3" {{ old('partial_ke') == '3' ? 'selected':''}}>3</option>                
                <option value="4" {{ old('partial_ke') == '4' ? 'selected':''}}>4</option>                
                <option value="5" {{ old('partial_ke') == '5' ? 'selected':''}}>5</option>                
                <option value="6" {{ old('partial_ke') == '6' ? 'selected':''}}>6</option>                
                <option value="7" {{ old('partial_ke') == '7' ? 'selected':''}}>7</option>                
                <option value="8" {{ old('partial_ke') == '8' ? 'selected':''}}>8</option>                
                <option value="9" {{ old('partial_ke') == '9' ? 'selected':''}}>9</option>                
                <option value="10" {{ old('partial_ke') == '10' ? 'selected':''}}>10</option>                
            </select>
            @if ($errors->has('partial_manifes'))
            <span class="help-block">
                {{ $errors->first('partial_manifes') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('jumlah_kemasan_partial') ? ' has-error' : '' }}">
            <label for="importir_npwp">Jumlah Kemasan Partial</label>
            <input type="text" class="form-control" name="jumlah_kemasan_partial" value="{{ old('jumlah_kemasan_partial') }}" placeholder="jumlah partial yang datang">
            @if ($errors->has('jumlah_kemasan_partial'))
            <span class="help-block">
                {{ $errors->first('jumlah_kemasan_partial') }}
            </span>
            @endif
        </div>            
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('jenis_kemasan_partial') ? ' has-error' : '' }}">
            <label for="importir_npwp">Jenis kemasan Partial</label>
            <input type="text" class="form-control" name="jenis_kemasan_partial" value="{{ old('jenis_kemasan_partial') }}" placeholder="">
            @if ($errors->has('jenis_kemasan_partial'))
            <span class="help-block">
                {{ $errors->first('jenis_kemasan_partial') }}
            </span>
            @endif
        </div>            
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3>Lokasi</h3>
        <div class="form-group {{ $errors->has('lokasi') ? ' has-error' : '' }}">
            <label for="lokasi">Lokasi Barang TPS</label>
            <select class="form-control pilih-select" name="lokasi">
                <option value="" selected></option>
                @foreach($lokasi as $tempat)
                <option value="{{$tempat->id}}" {{$tempat->id == old('lokasi') ? 'selected':''}}>{{$tempat->kode}}-{{$tempat->nama}}</option>
                @endforeach
            </select>
            @if ($errors->has('lokasi'))
            <span class="help-block">
                {{ $errors->first('lokasi') }}
            </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('lokasi_periksa_gudang_importir') ? ' has-error' : '' }}">
            <label for="lokasi">Lokasi Periksa Gudang Importir</label>
            <select class="form-control pilih-select" name="lokasi_periksa_gudang_importir">
                <option value="N" {{ old('lokasi_periksa_gudang_importir') == 'N' ? 'selected':''}}>Tidak</option>
                <option value="Y" {{ old('lokasi_periksa_gudang_importir') == 'Y' ? 'selected':''}}>Ya</option>                
            </select>
            @if ($errors->has('lokasi_periksa_gudang_importir'))
            <span class="help-block">
                {{ $errors->first('lokasi_periksa_gudang_importir') }}
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
             <input type="text" class="form-control" name="no_fasilitas" value="{{ old('no_fasilitas') }}" placeholder="nomor">
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
             <input type="text" class="form-control" name="tgl_fasilitas" value="{{ old('tgl_fasilitas') }}" placeholder="tanggal">
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
            <textarea class="form-control" rows="2" name="ket_fasilitas" placeholder="keterangan">{{ old('ket_fasilitas') }}</textarea>
            @if ($errors->has('ket_fasilitas'))
            <span class="help-block">
                {{ $errors->first('ket_fasilitas') }}
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('no_fasilitas') ? ' has-error' : '' }}">
            <label><input type="checkbox" value="check" name="setuju-trm" checked> Dengan mengklik tombol simpan, saya Menyatakan data yang saya isikan adalah benar dan mengikuti ketentuan yang ada</label>
        </div>
    </div>
</div>
<hr>

<div class="form-group" id="btn_kirim">
    <div>
        <button type="submit" class="btn btn-primary main-color-bg pull-right" onclick="konfirm()">
            Simpan
        </button>
    </div>
</div>