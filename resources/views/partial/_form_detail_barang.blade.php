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
                            <input type="hidden" name="dokumen_id" value="{{$dokumen->id}}">
                                <tr>
                                    <th style="width:200px">URAIAN BARANG</th>
                                    <td colspan="2">
                                        <textarea class="form-control {{ $errors->has('uraian_barang') ? 'salah' : '' }}" name="uraian_barang" rows="2"></textarea>
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">JUMLAH</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('kemasan_jumlah') ? 'salah' : '' }}" name="kemasan_jumlah">
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">JENIS KEMASAN</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('kemasan_jenis') ? 'salah' : '' }}" name="kemasan_jenis">
                                    </td>
                                </tr>
                                <tr >
                                    <th style="width:200px">NEGARA ASAL</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('negara_asal') ? 'salah' : '' }}" name="negara_asal">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">HS</th>
                                    <td colspan="2">
                                        <select class="form-control pilihhs {{ $errors->has('hs_code') ? 'salah' : '' }}" style=" width: 100%" placeholder="cari">
                                        </select>
                                        *pastikan HS sudah yang paling terbaru
                                    </td>
                                    <input type="text" id="hs" name="hs_code" hidden>
                                </tr>
                                <tr >
                                    <th style="width:200px">HARGA</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('harga_barang') ? 'salah' : '' }}" name="harga_barang" id="harga" value="0" style="font-size: 2.1rem;">
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">FREIGHT</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('freight') ? 'salah' : '' }}" name="freight" id="freight" value="0" style="font-size: 2.1rem;">
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">ASURANSI</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('asuransi') ? 'salah' : '' }}" name="asuransi" id="asuransi" value="0" style="font-size: 2.1rem;">
                                    </td>                    
                                </tr>
                                <tr >
                                    <th style="width:200px">CIF</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('cif') ? 'salah' : '' }}" name="cif" id="cif" readonly value="0" style="font-size: 2.1rem;">
                                    </td>                    
                                </tr>
                                <tr>
                                    <th style="width:200px">KURS</th>
                                    <td><input type="text" class="form-control {{ $errors->has('kurs_nilai') ? 'salah' : '' }}" id="kurs_nilai" name="kurs_nilai" value="0" readonly style="font-size: 2.1rem;"></td>
                                    <td>
                                        <select class="form-control pilihkurs {{ $errors->has('kurs_label') ? 'salah' : '' }}" id="pilihkurs" placeholder="Jenis kurs" style=" width: 100%">
                                            <option ></option>
                                            @foreach($kurs as $valuta)
                                            <option value="{{$valuta->nilai}}">{{$valuta->code}}</option>                                  
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" id="kurs_label" name="kurs_label" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:200px">NILAI PABEAN</th>
                                    <td colspan="2">
                                        <input type="text" class="form-control {{ $errors->has('nilai_pabean') ? 'salah' : '' }}" name="nilai_pabean" id="nilai_pabean" value="0" readonly style="font-size: 2.1rem;">
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
                                        <input type="text" class="form-control {{ $errors->has('trf_bm') ? 'salah' : '' }}" style="width:55px" name="trf_bm" value="0" id="trf_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_bm') ? 'salah' : '' }}" name="bayar_bm" value="0" id="bayar_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_bm') ? 'salah' : '' }}" name="ditanggung_pmrnth_bm" value="0" id="ditanggung_pmrnth_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_bm') ? 'salah' : '' }}" name="ditangguhkan_bm" value="0" id="ditangguhkan_bm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_bm') ? 'salah' : '' }}" name="dibebaskan_bm" value="0" id="dibebaskan_bm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPN</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_ppn') ? 'salah' : '' }}" style="width:55px" name="trf_ppn" value="0" id="trf_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_ppn') ? 'salah' : '' }}" name="bayar_ppn" value="0" id="bayar_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_ppn') ? 'salah' : '' }}" name="ditanggung_pmrnth_ppn" value="0" id="ditanggung_pmrnth_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_ppn') ? 'salah' : '' }}" name="ditangguhkan_ppn" value="0" id="ditangguhkan_ppn">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_ppn') ? 'salah' : '' }}" name="dibebaskan_ppn" value="0" id="dibebaskan_ppn">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPNBM</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_ppnbm') ? 'salah' : '' }}" style="width:55px" name="trf_ppnbm" value="0" id="trf_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_ppnbm') ? 'salah' : '' }}" name="bayar_ppnbm" value="0" id="bayar_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_ppnbm') ? 'salah' : '' }}" name="ditanggung_pmrnth_ppnbm" value="0" id="ditanggung_pmrnth_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_ppnbm') ? 'salah' : '' }}" name="ditangguhkan_ppnbm" value="0" id="ditangguhkan_ppnbm">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_ppnbm') ? 'salah' : '' }}" name="dibebaskan_ppnbm" value="0" id="dibebaskan_ppnbm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>PPH</th>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('trf_pph') ? 'salah' : '' }}" style="width:55px" name="trf_pph" value="0" id="trf_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_pph') ? 'salah' : '' }}" name="bayar_pph" value="0" id="bayar_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_pph') ? 'salah' : '' }}" name="ditanggung_pmrnth_pph" value="0" id="ditanggung_pmrnth_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_pph') ? 'salah' : '' }}" name="ditangguhkan_pph" value="0" id="ditangguhkan_pph">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_pph') ? 'salah' : '' }}" name="dibebaskan_pph" value="0" id="dibebaskan_pph">
                                    </td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('bayar_total') ? 'salah' : '' }}" value="0" name="bayar_total" id="bayar_total" style="font-size: 2.1rem;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditanggung_pmrnth_total') ? 'salah' : '' }}" value="0" name="ditanggung_pmrnth_total" id="ditanggung_pmrnth_total" style="font-size: 2.1rem;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('ditangguhkan_total') ? 'salah' : '' }}" value="0" name="ditangguhkan_total" id="ditangguhkan_total" style="font-size: 2.1rem;">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control {{ $errors->has('dibebaskan_total') ? 'salah' : '' }}" value="0" name="dibebaskan_total" id="dibebaskan_total" style="font-size: 2.1rem;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <span>* Pernyataan:</span>
                    <span>Dengan Merekam Tombol 'Simpan' Berarti User sudah memastikan bahwa Kurs dan tarif HS sudah sesuai HS terbaru dan terupdate</span>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-9 pull-right">
                            <button type="submit" class="btn btn-primary" onclick="konfirm()">Simpan</button>
                        </div>
                    </div>