<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingModelController;
use App\Http\Controllers\DaftarTamuController;
use App\Http\Controllers\FasilController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisibilityController;
use App\Models\Guest;
use App\Models\Room;
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

Route::get('/', function () {
    return view('backend.login');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('room', RoomController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('service', FasilitasController::class);
    Route::resource('ser', FasilController::class);
    Route::resource('booking', GuestController::class);
    Route::get('/trans', GuestController::class.'@transaksi')->name('trans.transaksi');
    Route::resource('visit', VisibilityController::class);
    Route::resource('daftartamu', DaftarTamuController::class);
});


Route::get('/cekRelasi', function(){
    Guest::with(['Room'])->get();
});

// Route::get('karyawan', KaryawanController::class,'__invoke');
// Route::resource('role', RoleController::class);

require __DIR__.'/auth.php';
