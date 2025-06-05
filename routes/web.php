<?php

use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManageBlogController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\UserChatsController;
use App\Models\Blog;
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
Route::get('/user-chats/{visitor_id}', [UserChatsController::class, 'oldMessage'])->name('user.chats.old');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.create');
    Route::get('/admin/manage-blogs', [AdminManageBlogController::class, 'index'])->name('admin.blog.list');
    Route::get('/admin/blog/create', [AdminManageBlogController::class, 'newBlog'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [AdminManageBlogController::class, 'saveBlog'])->name('admin.blog.store');
    Route::get('/admin/blog/edit/{id}', [AdminManageBlogController::class, 'editBlog'])->name('admin.blog.edit');
    Route::put('/admin/blog/update/{id}', [AdminManageBlogController::class, 'updateBlog'])->name('admin.blog.update');
    Route::post('/admin/upload-image', [AdminManageBlogController::class, 'uploadImage'])->name('admin.upload.image');
    Route::get('/admin/user-ai-chats', [UserChatsController::class, 'userAIChats'])->name('admin.user-ai-chats');
    Route::post('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.edit');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::post('/admin/heartbeat', [AdminController::class, 'heartbeat'])->name('admin.heartbeat');

    Route::get('/admin/manage-admins', [AdminController::class, 'manageAdmins'])->name('admin.manage-admins');
    Route::get('/admin/contact-details', [FormSubmissionController::class, 'contactDetails'])->name('admin.contact-details');
    Route::get('/admin/contact/{id}', [FormSubmissionController::class, 'getContactDetails']);
    Route::put('/admin/contact/{id}/mark-replied', [FormSubmissionController::class, 'markReplied']);
    Route::delete('/admin/contact/delete/{id}', [FormSubmissionController::class, 'deleteMessage'])->name('contact.message.delete');
    Route::get('/admin/blog/view/{id}', [AdminManageBlogController::class, 'viewBlog'])->name('admin.blog.view');
});







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
Route::get('/blogs', [AdminManageBlogController::class, 'blogs'])->name('blogs');

Route::get('/blog/{slug}', function ($slug) {
    $blog = Blog::where('slug', $slug)->firstOrFail();
    return view('frontend.blog-page', compact('blog'));
});

Route::get('/portfolio', function () {
    return view('frontend.portfolio');
});

// Route to list all services
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');

// Route to show a single service
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');


Route::get('/pricing/{service}', [PricingController::class, 'index'])->name('pricing.index');