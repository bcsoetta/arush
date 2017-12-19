<?php

Auth::routes();

Route::get('/','HomeController@index')->name('home');
Route::get('/home','HomeController@index')->name('home');

//SETTING
Route::resource('/admin/roles','RolesController');
Route::resource('/admin/permissions','PermissionsController');
Route::resource('/admin/users','UsersController');
Route::resource('/pengangkut','PengangkutController');
Route::resource('/user/profiles','UserProfilesController');

//DOKUMEN
Route::resource('/dokumen','DokumenController');
Route::get('/dokumen/terima/{id}', 'DokumenController@terimaDokumen')->name('dokumen.terima');
Route::get('/jaminan/dokumen/{id}', 'DokumenController@jaminan')->name('dokumen.jaminan');
Route::get('/importir', 'DokumenController@importir');

//SPPB
Route::get('/SPPB/putus/{id}','SPPBController@putusSppb')->name('putus.sppb.index');

//GATE
Route::get('/gateout','GateOutController@index')->name('gateout.index');
Route::get('/gateout/search','GateOutController@search')->name('gateout.search');
Route::get('/gateout/create/{id}','GateOutController@create')->name('gateout.create');
Route::post('/gateout/store/{id}','GateOutController@store')->name('gateout.store');

//IP
Route::get('/instruksi-pemeriksaan/index','IPController@index')->name('instruksi-pemeriksaan.index');
Route::get('/instruksi-pemeriksaan/create/{id}','IPController@create')->name('instruksi-pemeriksaan.create');
Route::post('/instruksi-pemeriksaan/store/{id}','IPController@store')->name('instruksi-pemeriksaan.store');
Route::get('/instruksi-pemeriksaan/show/{id}','IPController@show')->name('instruksi-pemeriksaan.show');
Route::get('/instruksi-pemeriksaan/edit/{id}','IPController@edit')->name('instruksi-pemeriksaan.edit');
Route::get('/instruksi-pemeriksaan/search','IPController@search')->name('instruksi-pemeriksaan.search');

//LHP
Route::get('/lhp','LHPController@index')->name('lhp.index');
Route::get('/lhp/{id}','LHPController@show')->name('lhp.show');
Route::get('/lhp/show/{id}','LHPController@showTab')->name('lhp.show.tab');
Route::get('/lhp/create/{id}','LHPController@create')->name('lhp.create');
Route::post('/lhp/{id}','LHPController@store')->name('lhp.store');

//?
Route::get('/pemeriksa','PemeriksaController@index')->name('pemeriksa.index');
Route::get('/pemeriksa/create','PemeriksaController@create')->name('pemeriksa.create');

//JAMINAN
Route::get('jaminan', 'JaminanController@index')->name('jaminan.index');
Route::get('jaminan/create', 'JaminanController@create')->name('jaminan.create');
Route::post('jaminan/store', 'JaminanController@store')->name('jaminan.store');
Route::get('jaminan/show/{id}', 'JaminanController@show')->name('jaminan.show');
Route::post('jaminan/tambahdokumen/{id}', 'JaminanController@tambahDokumen')->name('jaminan.tambah');
Route::get('/jaminan/perhitungan/{id}','JaminanController@perhitunganJaminan')->name('jaminan.hitung');
Route::post('/jaminan/perhitungan/{id}','JaminanController@perhitunganJaminanSimpan')->name('jaminan.hitung.simpan');

//DETAIL BARANG
Route::get('/detail-barang/index/{id}','DetailBarangController@index')->name('detail.index');
Route::get('/detail-barang/show/{dokumenDetail}','DetailBarangController@show')->name('detail.show');
Route::get('/detail-barang/{dokumen}/create','DetailBarangController@create')->name('detail.create');
Route::post('/detail-barang/store','DetailBarangController@store')->name('detail.store');
Route::get('/detail-barang/edit/{dokumenDetail}','DetailBarangController@edit')->name('detail.edit');
Route::patch('/detail-barang/{dokumenDetail}','DetailBarangController@update')->name('detail.update');
Route::delete('/detail-barang/{dokumenDetail}','DetailBarangController@destroy')->name('detail.destroy');

//HS
Route::get('/hs','HsController@dataHs')->name('data.hs');
// Route::get('/kurs','KursController@dataKurs')->name('data.kurs');



//LOKASI
Route::resource('lokasi', 'LokasiController');

//KURS
Route::resource('kurs', 'KursController');
Route::get('kurs-update-all', 'KursController@updateAll')->name('kurs.update.all');


//CETAK
Route::get('/cetak/show/{id}', 'CetakController@show')->name('cetak.show');
Route::get('/cetak/ip/{id}', 'CetakController@cetakIp')->name('cetak.ip');
Route::get('/cetak/lhp/{id}', 'CetakController@cetakLhp')->name('cetak.lhp');
Route::get('/cetak/ba/{id}', 'CetakController@cetakBa')->name('cetak.ba');
Route::get('/cetak/pnj/{id}', 'CetakController@cetakPnj')->name('cetak.pnj');
Route::get('/cetak/sppb/{id}', 'CetakController@sppb')->name('cetak.sppb');

//PENDOK
Route::get('pendok/index', 'PendokController@index')->name('pendox.index');
Route::get('pendok/search', 'PendokController@search')->name('pendok.search');
Route::get('pendok/create/{id}', 'PendokController@create')->name('pendok.create');
Route::post('pendok/store/{id}', 'PendokController@store')->name('pendok.store');

//ABESENSI
Route::get('absensi/index', 'AbsensiController@index')->name('absensi.index');
Route::post('absensi/ubah/{id}', 'AbsensiController@ubahKehadiran')->name('absensi.ubah');

//SEARCH
Route::get('search', 'SearchController@index')->name('search.index');
Route::get('search/data', 'SearchController@search')->name('search.data');
Route::get('autocomplete/importir', 'SearchController@importir')->name('auto.importir');
Route::get('autocomplete/ppjk', 'SearchController@ppjk')->name('auto.ppjk');