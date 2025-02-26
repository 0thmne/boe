<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::get('/demande', [FormController::class, 'showForm']);
Route::post('/request', [FormController::class, 'submitForm']);
Route::get('admin/demande/details/{uuid}', [FormController::class, 'showDetails']); 
Route::get('/admin/demandes', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin', [AdminController::class, 'index']);
Route::get('admin/add-agent', [AdminController::class, 'showAddAgentForm'])->name('add-agent.form');
Route::post('admin/add-agent', [AdminController::class, 'storeAgent'])->name('add-agent.store');
Route::get('admin/demande/edit/{uuid}', [AdminController::class, 'showEditForm'])->name('edit.form');
Route::post('admin/demande/edit/{uuid}', [AdminController::class, 'updateRequest'])->name('edit.update');
