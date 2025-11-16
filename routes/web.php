<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddCheckController;
use App\Http\Controllers\CheckAddedController;

use App\Http\Controllers\RespoCenterController;
use App\Http\Controllers\PayeeController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\AccountCodeController;
use App\Http\Controllers\SettingsController;


Route::get('/', [AdminController::class, 'view'])->middleware('auth');

Auth::routes();



Route::middleware(['auth'])->group(function () {
    Route::get('/add', [AddCheckController::class, 'view'])->name('addcheck.index');
    Route::post('/cheques', [AddCheckController::class, 'store'])->name('addcheck.store');

    Route::get('/added', [CheckAddedController::class, 'view'])->name('checkadded.index');
    Route::get('/checkadded/print', [CheckAddedController::class, 'print'])->name('checkadded.print');

    Route::post('/cheques/{id}/release', [CheckAddedController::class, 'release'])->name('cheques.release');
    Route::post('/cheques/{id}/return', [CheckAddedController::class, 'markReturned'])->name('cheques.return');
    Route::post('/cheques/{id}/cancelled', [CheckAddedController::class, 'markCancelled'])->name('cheques.cancel');


    Route::get('/admin', [AdminController::class, 'view'])->name('admin.dashboard.index');

    Route::post('/respocenters', [RespoCenterController::class, 'store'])->name('respocenters.store');
    Route::post('/payees', [PayeeController::class, 'store'])->name('payees.store');
    Route::post('/funds', [FundController::class, 'store'])->name('funds.store');
    Route::post('/accounts', [AccountCodeController::class, 'store'])->name('accountcodes.store');


    Route::get('settings', [SettingsController::class, 'view'])->name('settings.index'); 
    Route::get('/settings/users', [SettingsController::class, 'manageUser'])->name('settings.users'); 
    Route::post('/settings/users/store', [SettingsController::class, 'storeUser'])->name('settings.users.store'); 
    Route::post('/settings/users/update/{id}', [SettingsController::class, 'updateUser'])->name('settings.users.update');

});
