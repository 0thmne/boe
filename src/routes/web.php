<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
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
Route::put('admin/demande/edit/{uuid}', [AdminController::class, 'updateRequest'])->name('edit.update');
Route::delete('admin/demande/delete/{uuid}', [AdminController::class, 'deleteRequest'])->name('admin.delete');

// Agent routes
Route::get('/agent/requests', [AgentController::class, 'index'])->name('agent.requests');
Route::post('/agent/requests/{uuid}/update', [AgentController::class, 'updateRequest'])->name('agent.update');

Route::post('/change-language', function (Request $request) {
    $language = $request->input('language');
    if (in_array($language, ['en', 'fr'])) {
        session(['locale' => $language]);
        app()->setLocale($language);
    }
    return redirect()->back();
})->name('change-language');

// Language switcher route
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});