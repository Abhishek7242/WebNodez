<?php

use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\UserChatsController;
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

Route::post('/user-chats', [UserChatsController::class, 'storeMessage'])->name('user.chats.store');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.create');
    Route::post('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.edit');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::post('/admin/heartbeat', [AdminController::class, 'heartbeat'])->name('admin.heartbeat');

    Route::get('/admin/manage-admins', [AdminController::class, 'manageAdmins'])->name('admin.manage-admins');
    Route::get('/admin/user-ai-chats', [AdminController::class, 'userAIChats'])->name('admin.user-ai-chats');
    Route::get('/admin/contact-details', [FormSubmissionController::class, 'contactDetails'])->name('admin.contact-details');
    Route::get('/admin/contact/{id}', [FormSubmissionController::class, 'getContactDetails']);
    Route::put('/admin/contact/{id}/mark-replied', [FormSubmissionController::class, 'markReplied']);
    Route::delete('/admin/contact/delete/{id}', [FormSubmissionController::class, 'deleteMessage'])->name('contact.message.delete');
});






Route::get('/user-ai-chat', function () {});
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