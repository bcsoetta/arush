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
Route::resource('/admin/libur-nasional','LiburNasionalController');

//DOKUMEN
Route::resource('/dokumen','DokumenController');
Route::post('/dokumen/pembatalan/{id}', 'DokumenController@pembatalan')->name('dokumen.pembatalan');
Route::post('/dokumen/terima/{id}', 'DokumenController@penomoranDokumen')->name('dokumen.terima');
Route::get('/jaminan/dokumen/{id}', 'DokumenController@jaminan')->name('dokumen.jaminan');
Route::get('/importir', 'DokumenController@importir');
Route::get('/dataDokumen', 'DokumenController@dataDokumen')->name('dokumen.data');
Route::get('/dokumen-proses', 'DokumenController@prosesDokumen')->name('dokumen.proses');
Route::get('/cek-dokumen', 'DokumenController@cekDokumen')->name('dokumen.cekDokumen');
Route::post('/proses-cek-dokumen', 'DokumenController@prosesCekDokumen')->name('dokumen.prosesCekDokumen');
Route::get('/cek-dokumen-npwp/{npwp}','DokumenController@cekNpwp')->name('dokumen.cekNpwp');

//DOKUMEN PELENGKAP
Route::resource('/dokumen-pelengkap','DokumenPelengkapController')->middleware('auth');

//SPPB
Route::post('/SPPB/putus/{id}','SPPBController@putusSppb')->name('putus.sppb.index');

//GATE
Route::get('/gateout','GateOutController@index')->name('gateout.index');
Route::get('/gateout/data','GateOutController@data')->name('gateout.data');
Route::get('/gateout/search','GateOutController@search')->name('gateout.search');
Route::get('/gateout/create/{id}','GateOutController@create')->name('gateout.create');
Route::post('/gateout/store/{id}','GateOutController@store')->name('gateout.store');

//IP
Route::get('/instruksi-pemeriksaan/index','IPController@index')->name('instruksi-pemeriksaan.index');
Route::get('/instruksi-pemeriksaan/create/{id}','IPController@create')->name('instruksi-pemeriksaan.create');
Route::post('/instruksi-pemeriksaan/store/{id}','IPController@store')->name('instruksi-pemeriksaan.store');
Route::get('/instruksi-pemeriksaan/show/{id}','IPController@show')->name('instruksi-pemeriksaan.show');
Route::get('/instruksi-pemeriksaan/edit/{id}','IPController@edit')->name('instruksi-pemeriksaan.edit');
Route::patch('/instruksi-pemeriksaan/update/{id}','IPController@update')->name('instruksi-pemeriksaan.update');
Route::get('/instruksi-pemeriksaan/search','IPController@search')->name('instruksi-pemeriksaan.search');
Route::get('/instruksi-pemeriksaan/data','IPController@dataIp')->name('instruksi-pemeriksaan.dataIp');

//LHP
Route::get('/lhp','LHPController@index')->name('lhp.index');
Route::get('/lhp/data','LHPController@dataLhp')->name('lhp.dataLhp');
Route::get('/lhp/{id}','LHPController@show')->name('lhp.show');
Route::get('/lhp/show/{id}','LHPController@showTab')->name('lhp.show.tab');
Route::get('/lhp/create/{id}','LHPController@create')->name('lhp.create');
Route::post('/lhp/{id}','LHPController@store')->name('lhp.store');
Route::get('/lhp/{id}/edit','LHPController@edit')->name('lhp.edit');
Route::patch('/lhp/{id}/update','LHPController@update')->name('lhp.update');
Route::get('/lhp/detail-barang/{id}/edit','LHPController@detailBarangEdit')->name('lhp.detailBarangEdit');
Route::patch('/lhp/detail-barang/{id}/update', 'LHPController@detailBarangUpdate')->name('lhp.detailBarangUpdate');
Route::get('/lhp/photo/{id}/edit','LHPController@photoEdit')->name('lhp.photoEdit');
Route::delete('/lhp/photo/{id}/delete','LHPController@photoDestroy')->name('lhp.photoDestroy');
Route::post('/lhp/add-photo/{dok_id}/{lhp_id}/{id}/','LHPController@addPhoto')->name('lhp.addPhoto');

//?
Route::get('/pemeriksa','PemeriksaController@index')->name('pemeriksa.index');
Route::get('/pemeriksa/create','PemeriksaController@create')->name('pemeriksa.create');

//JAMINAN
Route::get('jaminan', 'JaminanController@index')->name('jaminan.index');
Route::get('jaminan/create', 'JaminanController@create')->name('jaminan.create');
Route::post('jaminan/store', 'JaminanController@store')->name('jaminan.store');
Route::get('jaminan/show/{id}', 'JaminanController@show')->name('jaminan.show');
Route::get('jaminan/edit/{id}', 'JaminanController@edit')->name('jaminan.edit');
Route::post('jaminan/update/{id}', 'JaminanController@update')->name('jaminan.update');
Route::post('jaminan/tambahdokumen/{id}', 'JaminanController@tambahDokumen')->name('jaminan.tambah');
Route::get('/jaminan/perhitungan/{id}','JaminanController@perhitunganJaminan')->name('jaminan.hitung');
Route::post('/jaminan/perhitungan/{id}','JaminanController@perhitunganJaminanSimpan')->name('jaminan.hitung.simpan');
Route::get('/jaminan/attachjaminantodokumen/{jaminan_id}/{dokumen_id}','JaminanController@attachJaminanToDokumen')->name('jaminan.attachJaminanToDokumen');
Route::get('/jaminan/datajaminanterusmenerus','JaminanController@dataJaminanTerusMenerus')->name('jaminan.data.terus');
Route::get('/dataJaminan', 'JaminanController@dataJaminan')->name('jaminan.data');
Route::get('/dataJaminanShow/{dokumen_id}', 'JaminanController@dataJaminanShow')->name('jaminan.data.show');
Route::get('/unlink-jaminan/{jaminan_id}/{dokumen_id}', 'JaminanController@unlink')->name('jaminan.unlink');


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
Route::get('/cetak/bpj/{jaminan_id}/{dokumen_id}', 'CetakController@bpj')->name('cetak.bpj');
Route::get('/cetak/form-cetak-jaminan-harian/', 'CetakController@formCetakJaminanHarian')->name('cetak.formCetakJaminanHarian');
Route::post('/cetak/store-cetak-jaminan-harian/', 'CetakController@storeJaminanHarian')->name('cetak.storeJaminanHarian');
Route::get('/cetak/cetak-ba-jaminan-harian/{id}', 'CetakController@cetakBaJaminan')->name('cetak.cetakBaJaminan');
Route::get('/cetak/cetak-lampiran-ba-jaminan-harian/{id}', 'CetakController@cetakLampiranBa')->name('cetak.cetakLampiranBa');

//PENDOK
Route::get('pendok/index', 'PendokController@index')->name('pendox.index');
Route::get('pendok/data', 'PendokController@data')->name('pendok.data');
Route::get('pendok/search', 'PendokController@search')->name('pendok.search');
Route::get('pendok/create/{id}', 'PendokController@create')->name('pendok.create');
Route::post('pendok/store/{id}', 'PendokController@store')->name('pendok.store');
Route::get('pendok/edit/{id}', 'PendokController@edit')->name('pendok.edit');
Route::post('pendok/update/{id}', 'PendokController@update')->name('pendok.update');

//ABESENSI
Route::get('absensi/index', 'AbsensiController@index')->name('absensi.index');
Route::post('absensi/ubah/{id}', 'AbsensiController@ubahKehadiran')->name('absensi.ubah');

//SEARCH
Route::get('search', 'SearchController@index')->name('search.index');
Route::get('search/data', 'SearchController@search')->name('search.data');
Route::get('autocomplete/importir', 'SearchController@importir')->name('auto.importir');
Route::get('autocomplete/ppjk', 'SearchController@ppjk')->name('auto.ppjk');

//USER
//ganti password
Route::get('/profile/{user}', 'UsersController@show')->name('profile');
Route::post('/profile-update/{user}', 'UsersController@update');
Route::get('/change-password', 'Auth\UpdatePasswordController@show')->name('change-password');
Route::post('/change-password', 'Auth\UpdatePasswordController@update')->name('change-password.store');
Route::get('/reset-password', 'Auth\UpdatePasswordController@reset')->name('reset-password');
Route::post('/reset-password-store', 'Auth\UpdatePasswordController@storeReset')->name('reset-password.store');

//LAPORAN
Route::get('/laporan-dokumen', 'LaporanController@dokumen')->name('laporan.dokumen');
Route::get('/laporan-jaminan', 'LaporanController@jaminan')->name('laporan.jaminan');
Route::get('/laporan-jaminan-harian', 'LaporanController@harian')->name('laporan.harian');
Route::get('/laporan-jaminan-harian-antara', 'LaporanController@hariAntara')->name('laporan.hariAntara');
Route::get('/laporan-dokumen-belum-definitif', 'LaporanController@belumDefinitif')->name('laporan.belumDefinitif');
Route::get('/laporan-dokumen-belum-dateout', 'LaporanController@belumGateOut')->name('laporan.belumGateOut');
Route::get('/laporan-jaminan-terus-menerus', 'LaporanController@terusmenerus')->name('laporan.terusMenerus');
Route::get('/laporan-download-form', 'LaporanController@formDownload')->name('laporan.formDownload');
Route::get('/laporan-download-dokumen', 'LaporanController@downloadDokumen')->name('laporan.downloadDokumen');
Route::get('/laporan-download-detail', 'LaporanController@downloadDetail')->name('laporan.downloadDetail');
// Route::get('/laporan-dokumen-jaminan', 'LaporanController@jaminanDokumen')->name('laporan.dokumenJaminan');

//DASHBOARD
Route::get('/dashboard', 'DashBoardController@index')->name('dashboard.index');
Route::get('/dashboard/test', 'DashBoardController@test')->name('dashboard.test');

//MY DOKUMEN
Route::resource('/mydokumen','MyDokumenController')->middleware('auth');
Route::get('/dataMyDokumen', 'MyDokumenController@dataDokumen')->name('mydokumen.data')->middleware('auth');