<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllertController;
use App\Http\Controllers\KadesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KetuaRtController;
use App\Http\Controllers\KetuaRwController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestLoginController;
use App\Http\Controllers\OrderSuratController;
use App\Http\Controllers\BeritaAcaraController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post("register", [RegisterController::class, 'register']);


Route::post("rtregister", [KetuaRtController::class, 'rtregister']);
Route::post("rtlogin",    [KetuaRtController::class, 'rtlogin']);
Route::get("rtcheck",     [KetuaRtController::class, 'rtcheck']);
Route::post("countwargaRT", [KetuaRtController::class, 'countwargaRT']);
Route::post("hitungKK", [KetuaRtController::class, 'hitungKK']);
Route::post("countSuratRT", [KetuaRtController::class, 'countSuratRT']);

//  Warga - Berita
Route::post("wargaGetBerita", [KetuaRwController::class, 'getBerita']);


// RT - BERITA
Route::post("rtBerita", [KetuaRTController::class, 'getBerita']);
Route::post("rtStoreBerita", [KetuaRTController::class, 'storeBerita']);
Route::post("rtUpdatedBerita/{id}", [KetuaRTController::class, 'updateBerita']);
Route::delete("rtDeleteBerita/{id}", [KetuaRTController::class, 'dropBerita']);


Route::get("warga", [WargaController::class, 'warga']);
Route::get("wargaorder", [WargaController::class, 'wargaorder']);
Route::post("wargaregister", [WargaController::class, 'wargaregister']);
Route::post("wargalogin",    [WargaController::class, 'wargalogin']);
Route::post("cariiwarga",    [WargaController::class, 'cariiwarga']);
Route::get("wargacheck",     [WargaController::class, 'wargacheck']);
Route::post("wargart",  [WargaController::class, 'wargart']);
Route::post("updatewarga/{id}",  [WargaController::class, 'updatewarga']);
Route::post("updateProfileWarga",  [WargaController::class, 'update']);
Route::post("updateKKWarga/{id}",  [WargaController::class, 'updateKKWarga']);
Route::post("updateKTPWarga/{id}",  [WargaController::class, 'updateKTPWarga']);
Route::post("wargaposttoken",    [WargaController::class, 'postTokenDevice']);

Route::delete("hapuswarga/{id}",  [WargaController::class, 'hapuswarga']);
Route::post("ambilwarga",  [WargaController::class, 'ambilwarga']);
Route::get("exportWargaALL", [WargaController::class, 'exportWargaALL']);
Route::get("exportWarga/{id}", [WargaController::class, 'exportWarga']);

Route::post("wargaEditLampiran/{id}",  [OrderSuratController::class, 'wargaEditLampiran']);

// RW
Route::post("rwregister", [KetuaRwController::class, 'register']);
Route::post("rwlogin",    [KetuaRwController::class, 'login']);
Route::post("rwupdate",    [KetuaRwController::class, 'update']);
Route::get("rwcheck",     [KetuaRwController::class, 'check']);

// RW - SURAT
Route::get("rwExportSurat/{id}", [KetuaRwController::class, 'exportSurat']);
Route::post("rwcountSurat", [KetuaRwController::class, 'countSurat']);


// RW - Warga

Route::get("rwExportWarga/{id}", [KetuaRwController::class, 'exportWarga']);
Route::post("rwcountKK", [KetuaRwController::class, 'countKK']);

// RW- RT
Route::post("rtregister", [KetuaRtController::class, 'rtregister']);
Route::post("rwRT",  [KetuaRwController::class, 'getRT']);
Route::post("rwWarga",  [KetuaRwController::class, 'getWargaTiapRT']);
Route::post("updateRT", [KetuaRtController::class, 'update']);


// RW- Berita

Route::post("rwStoreBerita", [KetuaRwController::class, 'storeBerita']);
Route::post("rwGetBerita", [KetuaRwController::class, 'getBerita']);
Route::post("rwUpdateBerita/{id}", [KetuaRwController::class, 'updateBerita']);
Route::delete("rwDeleteBerita/{id}", [KetuaRwController::class, 'deleteBerita']);


// SURAT

Route::post("rwGetSurat", [KetuaRwController::class, 'getSurat']);


Route::get("rtall",  [KetuaRwController::class, 'rtall']);
Route::post("storeRT",  [KetuaRwController::class, 'storeRT']);
Route::get("rtall",  [KetuaRwController::class, 'rtall']);
Route::get("searchwarga", [KetuaRwController::class, 'searchwarga']);
Route::get("searchRTwarga", [KetuaRtController::class, 'searchRTwarga']);
Route::get("countwarga", [KetuaRwController::class, 'countwarga']);


Route::get("searchSuratRT", [OrderSuratController::class, 'searchSuratRT']);
Route::get("searchSurat", [OrderSuratController::class, 'searchSurat']);

Route::post("ordersurat", [OrderSuratController::class, 'ordersurat']);
Route::post("rtScheck",  [OrderSuratController::class, 'rtScheck']);
Route::post("wargaScheck",  [OrderSuratController::class, 'wargaScheck']);
Route::post("rtSvalidasi/{id}",  [OrderSuratController::class, 'rtSvalidasi']);
Route::post("kirimSurat/{id}",  [OrderSuratController::class, 'kirimSurat']);

Route::post("rtSEditKomentar/{id}",  [OrderSuratController::class, 'rtEditKomentar']);

Route::post("rtSvalidasi/{id}",  [OrderSuratController::class, 'rtSvalidasi']);
Route::get("rwScheck",  [OrderSuratController::class, 'rwScheck']);
Route::post("rwvalidasi/{id}",  [OrderSuratController::class, 'rwvalidasi']);
Route::post("rwSEditKomentar/{id}",  [OrderSuratController::class, 'rwEditKomentar']);

Route::get("exportSuratRT/{id}", [OrderSuratController::class, 'exportSuratRT']);
Route::get("exportSuratRW", [OrderSuratController::class, 'exportSuratRW']);

Route::post("rwberita", [KetuaRWController::class, 'getberita']);


Route::post("storeBerita", [BeritaAcaraController::class, 'storeBerita']);
Route::get("getBerita", [BeritaAcaraController::class, 'getBerita']);
Route::delete("dropBerita/{id}",  [BeritaAcaraController::class, 'dropBerita']);
Route::post("updateBerita/{id}", [BeritaAcaraController::class, 'updateBerita'] );



// KADES

Route::post("kadeslogin", [KadesController::class, 'kadeslogin']);
Route::post("kadesUbahProfile", [KadesController::class, 'update']);
Route::post("kadesregister", [KadesController::class, 'kadesregister']);
Route::post("kadesberita", [KadesController::class,'getberita']);
Route::post("kadesRT",  [KadesController::class, 'getRT']);
Route::post("kadesWarga",  [KadesController::class, 'getWarga']);
Route::get("kadesRW",  [KadesController::class, 'getRW']);
Route::get("kadescountKK", [KadesController::class, 'countKK']);
Route::get("kadescountSurat", [KadesController::class, 'countSurat']);
Route::get("kadesExportSurat", [KadesController::class, 'exportSurat']);
Route::get("kadesExportWarga", [KadesController::class, 'exportWarga']);
Route::post("kadesStoreBerita", [KadesController::class, 'storeBerita']);
Route::post("kadesUpdateBerita/{id}", [KadesController::class, 'updateBerita']);
Route::delete("kadesDeleteBerita/{id}", [KadesController::class, 'deleteBerita']);


// Kades -- Surat
Route::get("kadesGetSurat", [KadesController::class, 'getSurat']);
Route::post("kadesSEditKomentar/{id}",  [OrderSuratController::class, 'kadesEditKomentar']);

Route::post("kadesValidasi/{id}",  [OrderSuratController::class, 'kadesValidasi']);
Route::post("kadesPermission/{id}",  [OrderSuratController::class, 'kadesPermission']);
Route::post("kadesUploadFile/{id}",  [OrderSuratController::class, 'kadesUploadFile']);


// ALlert

Route::post("storeAllert", [AllertController::class, 'store']);

Route::post("postAllert", [AllertController::class, 'storeAllert']);



// TEST
Route::post("register", [RegisterController::class, 'register']);
Route::post("testlogin",    [TestLoginController::class, 'testlogin']);


Route::post("adminregister", [AdminController::class, 'adminregister']);
Route::post("adminlogin", [AdminController::class, 'adminlogin']);




// Warga - Surat

Route::post("tambahLampiranSatu/{id}",  [OrderSuratController::class, 'tambahLampiranSatu']);
Route::post("tambahLampiranDua/{id}",  [OrderSuratController::class, 'tambahLampiranDua']);
Route::post("tambahLampiranTiga/{id}",  [OrderSuratController::class, 'tambahLampiranTiga']);
Route::post("tambahLampiranEmpat/{id}",  [OrderSuratController::class, 'tambahLampiranEmpat']);
Route::post("tambahLampiranLima/{id}",  [OrderSuratController::class, 'tambahLampiranLima']);
Route::post("tambahLampiranEnam/{id}",  [OrderSuratController::class, 'tambahLampiranEnam']);
Route::post("tambahLampiranTujuh/{id}",  [OrderSuratController::class, 'tambahLampiranTujuh']);



Route::GET("downloadFileKades/{filename}",  [OrderSuratController::class, 'downloadFileKades']);


// Allert

Route::post("wargaposttoken", [AllertController::class, 'postTokenDevice']);
Route::post("postNotification", [AllertController::class, 'fixx']);

