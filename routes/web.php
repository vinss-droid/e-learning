<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\DashboardController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth', 'guru']], function () {
    Route::get('/guru', [AdminController::class, 'index'])->name('dashboardGuru');
});



// Admin

// Route::get('/daftar-guru', [AdminController::class, 'guru'])->name('guru');
Route::group(['middleware' => ['auth', 'admin']], function () {
    
    // User
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboardAdmin');
    Route::get('/admin/daftar-user', [AdminController::class, 'user'])->name('user');
    Route::get('/admin/tambah-user', [AdminController::class, 'addUser'])->name('addUser');
    Route::post('/admin/save-user', [AdminController::class, 'saveUser'])->name('saveUser');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::put('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

    // Kelas
    Route::get('/admin/daftar-kelas', [AdminController::class, 'kelas'])->name('kelas');
    Route::get('/admin/tambah-kelas', [AdminController::class, 'addKelas'])->name('addKelas');
    Route::post('/admin/save-kelas', [AdminController::class, 'saveKelas'])->name('saveKelas');
    Route::get('/admin/edit-kelas/{id}', [AdminController::class, 'editKelas'])->name('editKelas');
    Route::put('/admin/update-kelas/{id}', [AdminController::class, 'updateKelas'])->name('updateKelas');
    Route::delete('/admin/delete-kelas/{id}', [AdminController::class, 'deleteKelas'])->name('deleteKelas');

    // Guru
    Route::get('/admin/daftar-guru', [AdminController::class, 'guru'])->name('guru');
    Route::get('/admin/tambah-guru', [AdminController::class, 'addGuru'])->name('addGuru');
    Route::post('/admin/save-guru', [AdminController::class, 'saveGuru'])->name('saveGuru');
    Route::get('/admin/edit-guru/{id}', [AdminController::class, 'editGuru'])->name('editGuru');
    Route::put('/admin/update-guru/{id}', [AdminController::class, 'updateGuru'])->name('updateGuru');
    Route::delete('/admin/delete-guru/{id}', [AdminController::class, 'deleteGuru'])->name('deleteGuru');

    // Mapel
    Route::get('/admin/daftar-mapel', [AdminController::class, 'mapel'])->name('admin-mapel');
    Route::get('/admin/tambah-mapel', [AdminController::class, 'addMapel'])->name('addMapel');
    Route::post('/admin/save-mapel', [AdminController::class, 'saveMapel'])->name('saveMapel');
    Route::get('/admin/edit-mapel/{id}', [AdminController::class, 'editMapel'])->name('editMapel');
    Route::put('/admin/update-mapel/{id}', [AdminController::class, 'updateMapel'])->name('updateMapel');
    Route::delete('/admin/delete-mapel/{id}', [AdminController::class, 'deleteMapel'])->name('deleteMapel');

    // Jadwal
    Route::get('/admin/jadwal-kelas', [AdminController::class, 'jadwal'])->name('jadwal');
    Route::get('/admin/jadwal-kelas/detail-jadwal-{kelas}', [AdminController::class, 'detailJadwal'])->name('detailJadwal');
    Route::post('/admin/jadwal-kelas/detail-jadwal-{kelas}', [AdminController::class, 'detailJadwal'])->name('detailJadwal');
    Route::get('/admin/tambah-jadwal-kelas-{kelas}', [AdminController::class, 'addJadwalKelas'])->name('addJadwalKelas');
    Route::post('/admin/tambah-jadwal-kelas-{kelas}', [AdminController::class, 'addJadwalKelas'])->name('addJadwalKelas');
    Route::get('/admin/save-jadwal-kelas-{kelas}', [AdminController::class, 'saveJadwalKelas'])->name('saveJadwalKelas');
    Route::post('/admin/save-jadwal-kelas-{kelas}', [AdminController::class, 'saveJadwalKelas'])->name('saveJadwalKelas');
    Route::delete('/admin/delete-jadwal-kelas-{kelas}/{id}', [AdminController::class, 'deleteJadwal'])->name('deleteJadwal');

});

// Siswa

Route::group(['middleware' => ['auth', 'siswa']], function () {
    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
});
