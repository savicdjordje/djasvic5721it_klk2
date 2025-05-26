<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Route;

Route::get('/',[ServiceController::class, 'homepage'])->name('homepage');
Route::get('/katalog-usluga',[ServiceController::class, 'catalog'])->name('catalog');

Route::controller(ContactMessageController::class)->name('contact-messages.')->prefix('/kontakt')->group(function () {
    Route::get('/', 'create')->name('create');
    Route::post('/', 'createSubmit')->name('createSubmit');
});

Route::controller(ServiceController::class)->name('services.')->prefix('/usluge')->group(function () {
    Route::get('/{id}', 'detail')->name('detail');
    Route::get('/katalog-usluga','catalog')->name('catalog');
});

Route::middleware('auth')->group(function () {
    Route::controller(ReservationController::class)->name('reservations.')->prefix('/rezerviacije')->group(function () {
        Route::get('/{service_id}', 'create')->name('create');
        Route::post('/{service_id}', 'createSubmit')->name('create-submit');
    });
});

Route::middleware(['auth', CheckRole::class . ':admin:editor'])->name('admin.')->prefix('/admin')->group(function () {

    Route::get('/',[ServiceController::class, 'dashboard'])->name('dashboard');

    Route::controller(ServiceController::class)->name('services.')->prefix('/usluge')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/{id}', 'single')->name('single');
        Route::get('/unesi', 'create')->name('create');
        Route::post('/unesi', 'createSubmit')->name('create-submit');
        Route::get('/izmeni/{id}', 'update')->name('update');
        Route::patch('/izmeni/{id}', 'updateSubmit')->name('update-submit');
        Route::post('/toggle-istakni/{id}', 'toggleFeatured')->name('toggle-featured');
        Route::delete('/obrisi/{id}', 'delete')->name('delete');
    });

    Route::controller(ServiceTypeController::class)->name('service-types.')->prefix('/tipovi-usluge')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/{id}', 'single')->name('single');
        Route::get('/unesi', 'create')->name('create');
        Route::post('/unesi', 'createSubmit')->name('create-submit');
        Route::get('/izmeni/{id}', 'update')->name('update');
        Route::patch('/izmeni/{id}', 'updateSubmit')->name('update-submit');
        Route::delete('/obrisi/{id}', 'delete')->name('delete');
    });

    Route::controller(ReservationController::class)->name('reservations.')->prefix('/rezerviacije')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/{id}', 'single')->name('single');
        Route::get('/izmeni/{id}', 'update')->name('update');
        Route::patch('/izmeni/{id}', 'updateSubmit')->name('update-submit');
        Route::post('/arhiviraj/{id}', 'archive')->name('archive');
        Route::post('/aktiviraj/{id}', 'unarchive')->name('unarchive');
    });

    Route::controller(UserController::class)->name('users.')->prefix('/korisnici')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/{id}', 'single')->name('single');
        Route::get('/izmeni/{id}', 'update')->name('update');
        Route::patch('/izmeni/{id}', 'updateSubmit')->name('update-submit');
        Route::delete('/obrisi/{id}', 'delete')->name('delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
