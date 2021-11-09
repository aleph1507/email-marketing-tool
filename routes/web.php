<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

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
    return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function() {
    Route::prefix('customers')->group(function() {
        Route::get('', [CustomerController::class, 'index'] )->name('customers.index');
        Route::get('create', [CustomerController::class, 'create'] )->name('customers.create');
        Route::post('', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::patch('{customer}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('{customer}', [CustomerController::class, 'destroy'])->name('customers.delete');
    });

    Route::prefix('customer-groups')->group(function() {
        Route::get('', [CustomerGroupController::class, 'index'] )->name('customer-groups.index');
        Route::get('create', [CustomerGroupController::class, 'create'] )->name('customer-groups.create');
        Route::post('', [CustomerGroupController::class, 'store'])->name('customer-groups.store');
        Route::get('{customerGroup}/edit', [CustomerGroupController::class, 'edit'])->name('customer-groups.edit');
        Route::patch('{customerGroup}', [CustomerGroupController::class, 'update'])->name('customer-groups.update');
        Route::delete('{customerGroup}', [CustomerGroupController::class, 'destroy'])->name('customer-groups.delete');
    });

    Route::prefix('templates')->group(function() {
        Route::get('', [TemplateController::class, 'index'] )->name('templates.index');
        Route::get('create', [TemplateController::class, 'create'] )->name('templates.create');
        Route::post('', [TemplateController::class, 'store'])->name('templates.store');
        Route::get('{template}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
        Route::patch('{template}', [TemplateController::class, 'update'])->name('templates.update');
        Route::delete('{template}', [TemplateController::class, 'destroy'])->name('templates.delete');
    });
});
