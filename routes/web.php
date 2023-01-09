<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ForntentController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
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

// Route::get('/', function () {
//     return view('protfolio.frontent.protfolio_master');
// });
Route::get('/',[ForntentController::class,'index']);
Route::post('/forntent/store/',[ForntentController::class,'store']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('protfolio.admin.index');
    })->name('dashboard');
// ==========about===================
    Route::get('/about/view',[AboutController::class,'index'])->name('about.view');
    Route::post('/about/store/',[AboutController::class,'store'])->name('about.store');
    Route::get('/about/show/',[AboutController::class,'Show'])->name('about.show');

    // ==========services===================
    Route::get('/service/view',[ServicesController::class,'index'])->name('service.view');
    Route::post('/service/store/',[ServicesController::class,'store'])->name('service.store');
    Route::get('/service/show/',[ServicesController::class,'Show'])->name('service.show');
    // =================portfolio==========================
    Route::get('/portfolio/view',[PortfolioController::class,'index'])->name('portfolio.view');
    Route::post('/portfolio/store/',[PortfolioController::class,'store'])->name('portfolio.store');
    Route::get('/portfolio/show/',[PortfolioController::class,'Show'])->name('portfolio.show');
    // ===================contacts==================
    Route::get('/contact/view',[ContactsController::class,'index'])->name('contact.view');
    Route::post('/contact/store/',[ContactsController::class,'store'])->name('contact.store');
    Route::get('/contact/show/',[ContactsController::class,'Show'])->name('contact.show');
});
