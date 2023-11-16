<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEvenementenController;
use App\Http\Controllers\Admin\AdminReservationController;

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

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
Route::post('/checkout', [ReservationController::class, 'checkout'])->name('tickets.purchase');

Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.all');
Route::get('/reservation/{reservation}', [ReservationController::class, 'show'])->name('reservation.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.index');

    // Admin - Evenementen
    Route::get('/admin/evenementen', [AdminEvenementenController::class, 'show'])->name('admin.events.index');
    Route::get('/admin/evenementen/create', [AdminEvenementenController::class, 'create'])->name('admin.events.create');
    Route::post('/admin/evenementen/create', [AdminEvenementenController::class, 'store'])->name('admin.events.store');
    Route::get('/admin/evenementen/edit/{event}', [AdminEvenementenController::class, 'edit'])->name('admin.events.edit');
    Route::post('/admin/evenementen/edit/{event}', [AdminEvenementenController::class, 'update'])->name('admin.events.update');
    Route::get('/admin/evenementen/delete/{event}', [AdminEvenementenController::class, 'delete'])->name('admin.events.delete');

    // Admin - Reserveringen
    Route::get('/admin/reservations', [AdminReservationController::class, 'show'])->name('admin.reservations.index');
    Route::post('/admin/reservations/{reservation}/delete', [AdminReservationController::class, 'delete'])->name('admin.reservations.delete');
    Route::post('/admin/reservations/{reservation}/reset-scan', [AdminReservationController::class, 'resetScan'])->name('admin.reservations.reset-scan');

});

require __DIR__.'/auth.php';
