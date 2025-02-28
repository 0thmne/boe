<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

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

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/demande', [FormController::class, 'showForm']);
Route::post('/request', [FormController::class, 'submitForm']);
Route::get('admin/demande/details/{uuid}', [FormController::class, 'showDetails']); 

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/demandes', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/demande/details/{uuid}', [FormController::class, 'showDetails']);
    Route::get('/add-agent', [AdminController::class, 'showAddAgentForm'])->name('add-agent.form');
    Route::post('/add-agent', [AdminController::class, 'storeAgent'])->name('add-agent.store');
    Route::get('/demande/edit/{uuid}', [AdminController::class, 'showEditForm'])->name('edit.form');
    Route::put('/demande/edit/{uuid}', [AdminController::class, 'updateRequest'])->name('edit.update');
    Route::delete('/demande/delete/{uuid}', [AdminController::class, 'deleteRequest'])->name('admin.delete');
});

// Agent Routes
Route::middleware(['auth', 'agent'])->prefix('agent')->group(function () {
    Route::get('/requests', [AgentController::class, 'index'])->name('agent.requests');
    Route::get('/requests/{uuid}', [AgentController::class, 'show'])->name('agent.requests.show');
    Route::post('/requests/{id}/update', [AgentController::class, 'updateRequest'])->name('agent.requests.update');
});

// Language Routes
Route::post('/change-language', function (Request $request) {
    $language = $request->input('language');
    if (in_array($language, ['en', 'fr'])) {
        session(['locale' => $language]);
        app()->setLocale($language);
    }
    return redirect()->back();
})->name('change-language');

Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});