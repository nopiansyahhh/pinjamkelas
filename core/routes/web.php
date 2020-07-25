<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('auth.login');
    
});

Route::get('/tes', function () {
	return view('layouts.mahasiswa.master');
    
});

route::get('/login','AuthController@indexLogin')->name('login');
route::get('/logout','AuthController@logout');
route::post('/postlogin','AuthController@postLogin');
	//route coba ajax;
	route::get('/gedungajax','GedungController@gedungAjax');
	route::post('/gedungajaxadd','GedungController@gedungAjaxAdd');
	route::get('/gedungajaxedit/{id}/edit','GedungController@gedungAjaxEdit');
	route::post('/gedungajaxedit/{id}/update','GedungController@gedungAjaxUpdate');
	route::get('/gedungajax/{id}/delete','GedungController@gedungAjaxDel');

route::group(['middleware' => ['auth','roleCheck:administrator,']], function(){
	Route::get('/admindashboard','MahasiswaController@adminDashboard');
	route::get('/adminlist','AdminController@indexAdmin');
	route::post('/adminadd','AdminController@simpanAdmin');
	route::get('/adminlist/{id}/delete','AdminController@delAdmin');
	route::get('/adminlist/{id}/edit','AdminController@editAdmin');
	route::post('/adminlist/{id}/update','AdminController@updateAdmin');
	route::get('/dosenlist','DosenController@index');
	route::post('/dosenadd','DosenController@store');
	route::get('/datamatkul','MatkulController@index');
	route::post('/matkuladd','MatkulController@store');
	route::get('/dataabsen','AbsenController@index');
	//route mahasiswa user
	//Route::get('/mahasiswaprofile','MahasiswaController@mahasiswaProfile');
	//Route::get('/riwayatpinjaman','MahasiswaController@mahasiswaRiwayatPinjaman');

});

route::group(['middleware' => ['auth','roleCheck:dosen,']], function(){
	Route::get('/dosendashboard','DosenController@dosenDashboard')->name('dosendashboard');
	Route::get('/dosenmatkul','DosenController@dosenMatkul');
	Route::get('/dosenmatkul/{id}/detail','DosenController@detailMatkul')->name('detailmatkul');
	Route::get('/dosenabsen','DosenController@dosenAbsen');
	Route::get('/dosendata','DosenController@dataDosen')->name('dosendata');
	Route::post('/dosendataupdate','DosenController@dataDosenUpdate')->name('dosendataupdate');
	Route::get('/tappudatenonaktif/{id}','DosenController@tapNonAktif')->name('tapnonaktif');
	Route::get('/tappudateinaktif/{id}','DosenController@tapInAktif')->name('tapinaktif');
	Route::get('/tappudateoutaktif/{id}','DosenController@tapOutAktif')->name('tapoutaktif');
	Route::get('/tappudateaktif/{id}','DosenController@tapAktif')->name('tapaktif');
	Route::post('/updatestatushadir','DosenController@statusHadir')->name('statushadir');
	Route::post('/generatetapin/{id}','DosenController@generateTapIn')->name('generatetapin');
	Route::post('/generatetapout/{id}','DosenController@generateTapOut')->name('generatetapout');
	Route::get('/genstatusaktif/{id}','DosenController@genStatusAktif')->name('genaktif');
	Route::get('/genstatusdisable/{id}','DosenController@genStatusDisable')->name('gendisable');
	Route::post('/dosenabsenupdate','DosenController@dosenAbsenTopik')->name('dosenabsenupdate');
	Route::get('/dosenabsendetail','DosenController@absenDetailDosen')->name('dosenabsendetail');

});

route::group(['middleware' => ['auth','roleCheck:baak,administrator,']], function(){
	
	Route::get('/admindashboard','MahasiswaController@adminDashboard');
	//route mahasiswa admin
	route::get('/datamahasiswa','MahasiswaController@indexMahasiswa');
	Route::post('/mahasiswaadd','MahasiswaController@simpanMahasiswa');
	route::get('/datamahasiswa/{id}/delete','MahasiswaController@delMahasiswa');
	route::get('/mahasiswa/{id}/profile','MahasiswaController@editMahasiswa');
	route::post('/mahasiswa/{id}/update','MahasiswaController@updateMahasiswa');
	
	//route gedung
	route::get('/datagedung','GedungController@indexGedung');
	route::post('/gedungadd','GedungController@gedungAdd');
	Route::get('/datagedung/{id}/edit','GedungController@gedungEdit');
	Route::post('/datagedung/{id}/update','GedungController@gedungUpdate');
	route::get('/datagedung/{id}/delete','GedungController@gedungDel');
	
	//route ruangan
	route::get('/dataruangan','RuanganController@indexRuangan');
	route::post('/dataruangan/add','RuanganController@ruanganAdd');
	route::get('/dataruangan/{id}/edit','RuanganController@ruanganEdit');
	route::post('/dataruangan/{id}/update','RuanganController@ruanganUpdate');
	route::get('/dataruangan/{id}/delete','RuanganController@ruanganDel');
	Route::get('/export-statuspinjaman','RuanganController@exportStatusPinjaman');

	//route pinjamkelas
	route::get('/pinjamkelas','PinjamController@indexPinjam');
	route::get('/pinjamkelas/{id}/booking','PinjamController@pinjamViewAdd');
	route::post('/pinjamkelas/{id}/bookingadd','PinjamController@pinjamAdd');

	//route statuspinjam
	route::get('/statuspinjam','StatusPinjamController@indexStatusPinjam');
	Route::get('/konfirmasi/{id}/detail','StatusPinjamController@konfirmDetail');
	route::post('/konfirmasi/{id}/update','StatusPinjamController@konfirmUpdate');
});

route::group(['middleware' => ['auth','roleCheck:mahasiswa,baak,administrator,']], function(){

	route::get('/dashboard','MahasiswaController@dashboard');
	//route pinjamkelas
	route::get('/pinjamkelas','PinjamController@indexPinjam');
	route::get('/pinjamkelas/{id}/booking','PinjamController@pinjamViewAdd');
	route::post('/pinjamkelas/{id}/bookingadd','PinjamController@pinjamAdd');
	//route statuspinjam
	route::get('/statuspinjam','StatusPinjamController@indexStatusPinjam');

	//route mahasiswa user
	Route::get('/mahasiswaprofile/{id}/profile','MahasiswaController@mahasiswaProfile');
	route::post('/mahasiswa/{id}/update','MahasiswaController@updateMahasiswa');
	Route::get('/riwayatpinjaman','MahasiswaController@mahasiswaRiwayatPinjaman');
	Route::resource('absenmahasiswa', 'AbsenMhsCtrl');
	Route::post('/tapin','AbsenMhsCtrl@tapin')->name('tapin');
	Route::post('/tapout','AbsenMhsCtrl@tapout')->name('tapout');
	Route::post('/tokenIn/{id}','AbsenMhsCtrl@absenTokenIn')->name('absentokenin');
	Route::post('/tokenOut/{id}','AbsenMhsCtrl@absenTokenOut')->name('absentokenout');
	Route::get('/mhsdashboardabsen','AbsenMhsCtrl@dashboardmhs')->name('dashboardabsen');
});

/*
route::group(['middleware' => ['auth','roleCheck:baak,administrator,mahasiswa']], function(){
//route::group(['middleware' => ['auth','']], function(){
	//route admin list
	route::get('/adminlist','AdminController@indexAdmin');
	route::post('/adminadd','AdminController@simpanAdmin');
	route::get('/adminlist/{id}/delete','AdminController@delAdmin');
	route::get('/adminlist/{id}/edit','AdminController@editAdmin');
	route::post('/adminlist/{id}/update','AdminController@updateAdmin');

	//route mahasiswa admin
	route::get('/datamahasiswa','MahasiswaController@indexMahasiswa');
	Route::post('/mahasiswaadd','MahasiswaController@simpanMahasiswa');
	route::get('/datamahasiswa/{id}/delete','MahasiswaController@delMahasiswa');
	route::get('/mahasiswa/{id}/profile','MahasiswaController@editMahasiswa');
	route::post('/mahasiswa/{id}/update','MahasiswaController@updateMahasiswa');
	//route gedung

		route::get('/datagedung','GedungController@indexGedung');
		route::post('/gedungadd','GedungController@gedungAdd');
		Route::get('/datagedung/{id}/edit','GedungController@gedungEdit');
		Route::post('/datagedung/{id}/update','GedungController@gedungUpdate');
		route::get('/datagedung/{id}/delete','GedungController@gedungDel');
	
	//route ruangan
	route::get('/dataruangan','RuanganController@indexRuangan');
	route::post('/dataruangan/add','RuanganController@ruanganAdd');
	route::get('/dataruangan/{id}/edit','RuanganController@ruanganEdit');
	route::post('/dataruangan/{id}/update','RuanganController@ruanganUpdate');
	route::get('/dataruangan/{id}/delete','RuanganController@ruanganDel');
	Route::get('export-ruangan','RuanganController@exportRuangan');

	//route pinjamkelas
	route::get('/pinjamkelas','PinjamController@indexPinjam');
	route::get('/pinjamkelas/{id}/booking','PinjamController@pinjamViewAdd');
	route::post('/pinjamkelas/{id}/bookingadd','PinjamController@pinjamAdd');

	//route statuspinjam
	route::get('/statuspinjam','StatusPinjamController@indexStatusPinjam');
	Route::get('/konfirmasi/{id}/detail','StatusPinjamController@konfirmDetail');
	route::post('/konfirmasi/{id}/update','StatusPinjamController@konfirmUpdate');
	Route::get('export-statuspinjaman','StatusPinjamController@exportStatusPinjaman');

	//route mahasiswa user
	Route::get('/mahasiswaprofile','MahasiswaController@mahasiswaProfile');
	Route::get('/riwayatpinjaman','MahasiswaController@mahasiswaRiwayatPinjaman');
	Route::get('/riwayatcari','MahasiswaController@mahasiswaRiwayatPinjaman');
	Route::get('/dashboard','MahasiswaController@dashboard');
	Route::get('/admindashboard','MahasiswaController@adminDashboard');
});*/

Auth::routes();
