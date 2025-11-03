<?php

use App\Livewire\Login;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {

    Route::get('/kelola-sidang', \App\Livewire\Mahasiswa\KelolaSidang::class)->name('kelola-sidang');

    Route::get('/tugas-akhir', \App\Livewire\Mahasiswa\TugasAkhirMahasiswa::class)->name('tugas-akhir');

});

Route::middleware(['auth:dosen'])->prefix('dosen')->name('dosen.')->group(function () {

    Route::get('/kelola-sidang', \App\Livewire\Dosen\KelolaSidangDosen::class)->name('kelola-sidang');

    Route::get('/tugas-akhir', \App\Livewire\Dosen\TugasAkhirDosen::class)->name('tugas-akhir');

});

Route::middleware(['auth:koordinator'])->prefix('koordinator')->name('koordinator.')->group(function () {

    Route::get('/kelola-sidang', \App\Livewire\Koordinator\KelolaSidangKoordinator::class)->name('kelola-sidang');

    Route::get('/kelola-dosen', \App\Livewire\Koordinator\KelolaDosen::class)->name('kelola-dosen');

    Route::get('/kelola-mahasiswa', \App\Livewire\Koordinator\KelolaMahasiswa::class)->name('kelola-mahasiswa');

    Route::get('/tugas-akhir', \App\Livewire\Koordinator\TugasAkhirKoordinator::class)->name('tugas-akhir');

});

Route::get('/test-mahasiswa-modal', \App\Livewire\Components\MahasiswaTableAction::class);

// Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    
//     Route::get('/daftar-sidang', \App\Livewire\Mahasiswa\DaftarSidang::class)->name('daftar-sidang');
    
//     Route::get('/pantau-sidang', \App\Livewire\Mahasiswa\PantauSidang::class)->name('pantau-sidang');

//     Route::get('/pantau-sidang/detail-sidang', \App\Livewire\Mahasiswa\DetailSidang::class)->name('detail-sidang');

// });
