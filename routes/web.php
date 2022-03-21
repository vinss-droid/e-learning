<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeachersController;
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

// ------------------ Admin -----------------

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

    // Grades
    Route::get('/admin/daftar-tingkatan', [AdminController::class, 'grades'])->name('grades');
    Route::get('/admin/tambah-daftar-tingkatan', [AdminController::class, 'addGrades'])->name('addGrades');
    Route::post('/admin/save-daftar-tingkatan', [AdminController::class, 'saveGrades'])->name('saveGrades');
    Route::get('/admin/edit-daftar-tingkatan/{id}', [AdminController::class, 'editGrades'])->name('editGrades');
    Route::put('/admin/update-daftar-tingkatan/{id}', [AdminController::class, 'updateGrades'])->name('updateGrades');
    Route::delete('/admin/delete-daftar-tingkatan/{id}', [AdminController::class, 'deleteGrades'])->name('deleteGrades');

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

    // Mapel
    Route::get('/admin/mapel-kelas', [AdminController::class, 'jadwal'])->name('jadwal');
    Route::get('/admin/mapel-kelas/daftar-mapel-{kelas}', [AdminController::class, 'detailJadwal'])->name('detailJadwal');
    Route::post('/admin/mapel-kelas/daftar-mapel-{kelas}', [AdminController::class, 'detailJadwal'])->name('detailJadwal');
    Route::get('/admin/tambah-mapel-kelas-{kelas}', [AdminController::class, 'addJadwalKelas'])->name('addJadwalKelas');
    Route::post('/admin/tambah-mapel-kelas-{kelas}', [AdminController::class, 'addJadwalKelas'])->name('addJadwalKelas');
    Route::get('/admin/save-mapel-kelas-{kelas}', [AdminController::class, 'saveJadwalKelas'])->name('saveJadwalKelas');
    Route::post('/admin/save-mapel-kelas-{kelas}', [AdminController::class, 'saveJadwalKelas'])->name('saveJadwalKelas');
    Route::delete('/admin/delete-mapel-kelas-{kelas}/{id}', [AdminController::class, 'deleteJadwal'])->name('deleteJadwal');

});

// --------------------- Guru ----------------------

Route::group(['middleware' => ['auth', 'guru']], function () {

    Route::get('/guru', [TeachersController::class, 'index'])->name('dashboardGuru');
    Route::get('/guru/mata-pelajaran', [TeachersController::class, 'mapel'])->name('Tmapel');
    Route::get('/guru/mata-pelajaran/{grade}/tugas-mata-pelajaran-{mapel}', [TeachersController::class, 'tugasMapel'])->name('tugasMapel');
    Route::post('/guru/mata-pelajaran/{grade}/tugas-mata-pelajaran-{mapel}', [TeachersController::class, 'tugasMapel'])->name('tugasMapel');

    Route::get('/guru/mata-pelajaran/{grade}/tambah-tugas-mata-pelajaran-{mapel}', [TeachersController::class, 'addTugas'])->name('addTugas');
    Route::post('/guru/mata-pelajaran/{grade}/save-tugas-mata-pelajaran-{mapel}', [TeachersController::class, 'saveTugas'])->name('saveTugas');
    Route::get('/guru/mata-pelajaran/lihat/{grade}/tugas-mata-pelajaran-{mapel}/{week}', [TeachersController::class, 'lihatTugas'])->name('lihatTugas');
    Route::get('/guru/mata-pelajaran/download/{grade}/file-tugas-mata-pelajaran-{mapel}/{week}', [TeachersController::class, 'downloadFileTugas'])->name('downloadFileTugas');
    Route::get('/guru/mata-pelajaran/edit/{grade}/tugas-mata-pelajaran-{mapel}/{week}', [TeachersController::class, 'editTugas'])->name('editTugas');
    Route::put('/guru/mata-pelajaran/update/{grade}/tugas-mata-pelajaran-{mapel}/{week}', [TeachersController::class, 'updateTugas'])->name('updateTugas');
    Route::delete('/guru/mata-pelajaran/delete/{grade}/tugas-mata-pelajaran-{mapel}/{week}', [TeachersController::class, 'hapusTugas'])->name('hapusTugas');

});

// -------------------- Siswa --------------------

Route::group(['middleware' => ['auth', 'siswa']], function () {
    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
});
