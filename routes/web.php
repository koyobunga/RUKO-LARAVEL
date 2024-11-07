<?php

use App\Http\Controllers\AasnController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjadwalController;
use App\Http\Controllers\AkdController;
use App\Http\Controllers\MakdController;
use App\Http\Controllers\ApelakcanaanController;
use App\Http\Controllers\ArencanaController;
use App\Http\Controllers\AsertilistController;
use App\Http\Controllers\AsnController;
use App\Http\Controllers\BelumController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\MasnController;
use App\Http\Controllers\MjadwalController;
use App\Http\Controllers\MpelaksanaanController;
use App\Http\Controllers\MrekapController;
use App\Http\Controllers\MrekomController;
use App\Http\Controllers\MrencanaController;
use App\Http\Controllers\MteknisController;
use App\Http\Controllers\MuserController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PelaksanaanController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RekomController;
use App\Http\Controllers\RencanaController;
use App\Http\Controllers\SertiController;
use App\Http\Controllers\SertiListController;
use App\Http\Controllers\SudahController;
use App\Http\Controllers\TeknisController;
use App\Http\Controllers\UserController;
use App\Models\Pelaksanaan;
use App\Models\Serti;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [landingController::class, 'index']);
Route::get('/login', [UserController::class, 'login']);
Route::post('authtenticate', [UserController::class, 'auth']);


Route::post('mobile/authtenticate', [MuserController::class, 'auth']);
Route::get('mobile/login', [MuserController::class, 'index']);

Route::middleware('mobile')->group(function(){
    Route::get('mobile/offline', [MuserController::class, 'offline']);
    Route::get('mobile/logout', [MuserController::class,'logout']);
    Route::get('mobile/asn', [MasnController::class,'index']);
    Route::get('mobile/dashboard', [MasnController::class,'dashboard']);
    Route::get('mobile/setting', [MasnController::class,'setting']);
    Route::post('mobile/password', [MasnController::class, 'password']);
    
    Route::post('mobile/profile/upfoto', [MasnController::class,'upfoto']);
    Route::get('mobile/profile/foto', [MasnController::class,'foto']);
    Route::put('mobile/profile/update', [MasnController::class,'update']);
    Route::get('mobile/profile/', [MasnController::class,'profile']);
    Route::get('mobile/rencana/get', [MrencanaController::class,'get']);
    Route::resource('mobile/rencana', MrencanaController::class);
    
    Route::post('mobile/laporan/file', [MpelaksanaanController::class, 'unggah']);
    Route::get('mobile/download/pelaksanaan/{pelaksanaan:id}', [MpelaksanaanController::class, 'download']);
    Route::resource('mobile/pelaksanaan', MpelaksanaanController::class);
    
    Route::get('mobile/rekap',[MrekapController::class, 'index']);

    Route::get('mobile/akd',[MAkdController::class, 'index']);
    Route::get('mobile/akd/store', [MAkdController::class, 'store']);
    Route::get('mobile/akd/teknis/del', [MTeknisController::class, 'del']);
    Route::resource('mobile/akd/teknis', MteknisController::class);

    Route::resource('mobile/jadwal', MjadwalController::class);
    Route::resource('mobile/rekom', MrekomController::class);
    
});

Route::middleware('asn')->group(function(){
    Route::post('asn/foto', [AsnController::class, 'foto']);
    Route::post('asn/password', [UserController::class, 'password']);
    Route::get('/asn',[AsnController::class, 'index']);
    Route::get('/asn/akd',[AkdController::class, 'index']);
    Route::get('/asn/akd/store', [AkdController::class, 'store']);
    Route::get('/asn/akd/teknis/del', [TeknisController::class, 'del']);
    Route::resource('/asn/akd/teknis', TeknisController::class);
    Route::post('/asn/profile/up', [AsnController::class, 'update']);
    Route::get('/asn/sudah/add', [SudahController::class, 'add']);
    Route::get('/asn/sudah/getdata', [SudahController::class, 'getdata']);
    Route::get('/asn/sudah/delete', [SudahController::class, 'destroy']);
    Route::get('/asn/sudah', [SudahController::class, 'index']);

    Route::get('/asn/belum/add', [BelumController::class, 'add']);
    Route::get('/asn/belum/getdata', [BelumController::class, 'getdata']);
    Route::get('/asn/belum/delete', [BelumController::class, 'destroy']);
    Route::get('/asn/belum', [BelumController::class, 'index']);
    Route::get('/asn/profile', [AsnController::class, 'profile']);
    Route::get('/logoutasn', [AsnController::class, 'logout']);
    
    Route::resource('/asn/rencana', RencanaController::class);
    
    Route::resource('/asn/jadwal', JadwalController::class);
    Route::resource('/asn/rekom', RekomController::class);
    
    Route::resource('/asn/serti_list', SertiListController::class);
    
    Route::post('asn/laporan/file', [PelaksanaanController::class, 'unggah']);
    Route::get('asn/download/pelaksanaan/{pelaksanaan:id}', [PelaksanaanController::class, 'download']);
    Route::resource('asn/pelaksanaan', PelaksanaanController::class);

    Route::resource('asn/pesan', PesanController::class);
    
});

Route::middleware('admin')->group(function(){
    Route::post('admin/password', [UserController::class, 'password']);
    Route::get('admin/', [AdminController::class, 'index']);
    Route::get('admin/list/{diklat:id}', [AdminController::class, 'list']);
    Route::get('admin/logout', [AdminController::class, 'logout']);
    Route::get('admin/asn/akunon/{user:id}', [AasnController::class, 'akunon']);
    Route::get('admin/asn/akunoff/{user:id}', [AasnController::class, 'akunoff']);
    Route::get('admin/asn/hidupkan/{asn:id}', [AasnController::class, 'hidupkan']);
    
    
    Route::get('admin/asn/matikan/{asn:id}', [AasnController::class, 'matikan']);
    Route::get('admin/asn/pulihkanpassword/{asn:id}', [AasnController::class, 'pulihkanpassword']);
    Route::resource('admin/asn', AasnController::class);
    
    Route::get('admin/rencana', [ArencanaController::class, 'index']);
    Route::get('admin/rencana/{asn:id}', [ArencanaController::class, 'show']);
    Route::get('admin/rencana/destroy/{rencana:id}', [ArencanaController::class, 'destroy']);
    
    Route::get('admin/pelaksanaan', [ApelakcanaanController::class, 'index']);
    Route::get('admin/pelaksanaan/{asn:id}', [ApelakcanaanController::class, 'show']);
    Route::get('admin/pelaksanaan/destroy/{pelaksanaan:id}', [ApelakcanaanController::class, 'destroy']);
    Route::get('admin/pelaksanaan/donwload/{pelaksanaan:id}', [ApelakcanaanController::class, 'download']);
    
    Route::resource('admin/jadwal', AjadwalController::class);
    
    Route::resource('admin/diklat', DiklatController::class);
    
    Route::get('admin/rekap/view', [RekapController::class, 'view']);
    
    Route::get('admin/rekap', [RekapController::class, 'index']);
    
    
    Route::get('admin/serti/terbit/{serti:id}', [AsertilistController::class, 'terbit']);
    Route::get('admin/serti/singkron/{serti:id}', [AsertilistController::class, 'singkron']);
    Route::resource('admin/serti', SertiController::class);
    Route::resource('admin/serti_list', AsertilistController::class);
    Route::resource('admin/opd', OpdController::class);
});