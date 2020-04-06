                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed table-borderless">
                        <thead></thead>
                            <tbody>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="dokumen_id" value="{{$dokumenDetail->dokumen_id}}">
                                <tr>
                                    <th style="width:200px">URAIAN BARANG</th>
                                    <td colspan="3">
                                        <textarea class="form-control {{ $errors->has('uraian_barang') ? 'salah' : '' }}" name="uraian_barang" rows="2">{{$dokumenDetail->uraian_barang}}</textarea>
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">JUMLAH</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('kemasan_jumlah') ? 'salah' : '' }}" name="kemasan_jumlah" value="{{$dokumenDetail->kemasan_jumlah}}">
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">JENIS KEMASAN</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('kemasan_jenis') ? 'salah' : '' }}" name="kemasan_jenis" value="{{$dokumenDetail->kemasan_jenis}}">
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">NEGARA ASAL</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('negara_asal') ? 'salah' : '' }}" name="negara_asal" value="{{$dokumenDetail->negara_asal}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">HS</th>
                                    <td style="width: 120px">
                                        <input type="text" id="hs" name="hs_code" class="form-control" value="{{$dokumenDetail->hs_code}}" readonly>
                                    </td>
                                    <td colspan="2">
                                        <select class="form-control pilihhs {{ $errors->has('hs_code') ? 'salah' : '' }}" style=" width: 100%" placeholder="cari">
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr >
                                    <th style="width:200px">JENIS HARGA</th>
                                    <td colspan="3">
                                        <select class="form-control jenisharga {{ $errors->has('harga_jenis') ? 'salah' : '' }}" style=" width: 100%" name="harga_jenis" placeholder="pilih">
                                            <option value="{{$dokumenDetail->harga_jenis}}" selected>{{$dokumenDetail->harga_jenis}}</option>
                                            <option value="CIF">CIF</option>
                                            <option value="FOB">FOB</option>
                                            <option value="C&F">C&amp;F</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">HARGA</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('harga_barang') ? 'salah' : '' }} bersihkan" name="harga_barang" id="harga" value="{{$dokumenDetail->harga_barang}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">FREIGHT</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('freight') ? 'salah' : '' }}" name="freight" id="freight" value="{{$dokumenDetail->freight}}">
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">ASURANSI</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('asuransi') ? 'salah' : '' }}" name="asuransi" id="asuransi" value="{{$dokumenDetail->asuransi}}">
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">CIF</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('cif') ? 'salah' : '' }}" name="cif" id="cif" readonly value="{{$dokumenDetail->cif}}">
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">KURS</th>
                                    <td style="width: 100px">
                                        <input type="text" class="form-control {{ $errors->has('kurs_nilai') ? 'salah' : '' }}" id="kurs_nilai" name="kurs_nilai" value="{{$dokumenDetail->kurs_nilai}}" readonly>
                                    </td>
                                    <td style="width: 200px">
                                        <input type="text" class="form-control {{ $errors->has('kurs_nilai') ? 'salah' : '' }}" id="kurs_label" name="kurs_label" value="{{$dokumenDetail->kurs_label}}" readonly>
                                    </td>
                                    <td>
                                        <select class="form-control pilihkurs {{ $errors->has('kurs_label') ? 'salah' : '' }}" id="pilihkurs" placeholder="Jenis kurs" style=" width: 100%">
                                            <option value="" selected></option>
                                            @foreach($kurs as $valuta)
                                            <option value="{{$valuta->nilai}}">{{$valuta->code}}</option>                                  
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">NILAI PABEAN</th>
                                    <td colspan="3">
                                        <input type="text" class="form-control {{ $errors->has('nilai_pabean') ? 'salah' : '' }}" name="nilai_pabean" id="nilai_pabean" value="{{$dokumenDetail->nilai_pabean}}" readonly>
                                    </td>                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive tarif">
                        <table class="table table-hover table-striped table-highlight">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th style="width:20px">TARIF (%)</th>
                                    <th>DIBAYAR (Rp)</th>
                                    <th>DITANGGUNG PEMERINTAH (Rp)</th>
                                    <th>DITANGGUHKAN (Rp)</th>
                                    <th>DIBEBASKAN (Rp)</th>
                                </tr>
                                <tr>
                                    <th>BM</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" style="width:55px" name="trf_bm" value="{{$dokumenDetail->trf_bm}}" id="trf_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_bm') ? 'salah' : '' }}" name="bayar_bm" value="{{$dokumenDetail->bayar_bm}}" id="bayar_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_bm') ? 'salah' : '' }}" name="ditanggung_pmrnth_bm" value="{{$dokumenDetail->ditanggung_pmrnth_bm}}" id="ditanggung_pmrnth_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_bm') ? 'salah' : '' }}" name="ditangguhkan_bm" value="{{$dokumenDetail->ditangguhkan_bm}}" id="ditangguhkan_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_bm') ? 'salah' : '' }}" name="dibebaskan_bm" value="{{$dokumenDetail->dibebaskan_bm}}" id="dibebaskan_bm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_ppn') ? 'salah' : '' }}" style="width:55px" name="trf_ppn" value="{{$dokumenDetail->trf_ppn}}" id="trf_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_ppn') ? 'salah' : '' }}" name="bayar_ppn" value="{{$dokumenDetail->bayar_ppn}}" id="bayar_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_ppn') ? 'salah' : '' }}" name="ditanggung_pmrnth_ppn" value="{{$dokumenDetail->ditanggung_pmrnth_ppn}}" id="ditanggung_pmrnth_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_ppn') ? 'salah' : '' }}" name="ditangguhkan_ppn" value="{{$dokumenDetail->ditangguhkan_ppn}}" id="ditangguhkan_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_ppn') ? 'salah' : '' }}" name="dibebaskan_ppn" value="{{$dokumenDetail->dibebaskan_ppn}}" id="dibebaskan_ppn">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPNBM</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_ppnbm') ? 'salah' : '' }}" style="width:55px" name="trf_ppnbm" value="{{$dokumenDetail->trf_ppnbm}}" id="trf_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_ppnbm') ? 'salah' : '' }}" name="bayar_ppnbm" value="{{$dokumenDetail->bayar_ppnbm}}" id="bayar_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_ppnbm') ? 'salah' : '' }}" name="ditanggung_pmrnth_ppnbm" value="{{$dokumenDetail->ditanggung_pmrnth_ppnbm}}" id="ditanggung_pmrnth_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_ppnbm') ? 'salah' : '' }}" name="ditangguhkan_ppnbm" value="{{$dokumenDetail->ditangguhkan_ppnbm}}" id="ditangguhkan_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_ppnbm') ? 'salah' : '' }}" name="dibebaskan_ppnbm" value="{{$dokumenDetail->dibebaskan_ppnbm}}" id="dibebaskan_ppnbm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_pph') ? 'salah' : '' }}" style="width:55px" name="trf_pph" value="{{$dokumenDetail->trf_pph}}" id="trf_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_pph') ? 'salah' : '' }}" name="bayar_pph" value="{{$dokumenDetail->bayar_pph}}" id="bayar_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_pph') ? 'salah' : '' }}" name="ditanggung_pmrnth_pph" value="{{$dokumenDetail->ditanggung_pmrnth_pph}}" id="ditanggung_pmrnth_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_pph') ? 'salah' : '' }}" name="ditangguhkan_pph" value="{{$dokumenDetail->ditangguhkan_pph}}" id="ditangguhkan_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_pph') ? 'salah' : '' }}" name="dibebaskan_pph" value="{{$dokumenDetail->dibebaskan_pph}}" id="dibebaskan_pph">
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_total') ? 'salah' : '' }}" value="{{$dokumenDetail->bayar_total}}" name="bayar_total" id="bayar_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_total') ? 'salah' : '' }}" value="{{$dokumenDetail->ditanggung_pmrnth_total}}" name="ditanggung_pmrnth_total" id="ditanggung_pmrnth_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_total') ? 'salah' : '' }}" value="{{$dokumenDetail->ditangguhkan_total}}" name="ditangguhkan_total" id="ditangguhkan_total">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_total') ? 'salah' : '' }}" value="{{$dokumenDetail->dibebaskan_total}}" name="dibebaskan_total" id="dibebaskan_total">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-9 pull-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>