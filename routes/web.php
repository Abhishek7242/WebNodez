<?php

use App\Http\Controllers\PricingController;
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

Route::get('/', function () {
    return view('frontend.home');
});
Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});
Route::get('/about-us', function () {
    return view('frontend.about-us');
});
Route::get('/terms&conditions', function () {
    return view('frontend.terms_conditions');
});
Route::get('/privacy-policy', function () {
    return view('frontend.privacy_policy');
});
Route::get('/blogs', function () {
    return view('frontend.blogs');
});
Route::get('/portfolio', function () {
    return view('frontend.portfolio');
});

// Route to list all services
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');

// Route to show a single service
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');


Route::get('/pricing/{service}', [PricingController::class, 'index'])->name('pricing.index');