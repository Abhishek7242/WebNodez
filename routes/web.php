<?php

use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManageBlogController;
use App\Http\Controllers\AdminManagePortfolio;
use App\Http\Controllers\AdminPrivacyPolicyController;
use App\Http\Controllers\AdminTermConditionController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\UserChatsController;
use App\Models\Achievement;
use App\Models\Blog;
use App\Models\CaseStudy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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

Route::post('/user-chats/broadcast', [UserChatsController::class, 'broadcast'])->name('user.chats.broadcast');
Route::post('/user-chats', [UserChatsController::class, 'storeMessage'])->name('user.chats.store');
Route::get('/user-chats/{visitor_id}', [UserChatsController::class, 'oldMessage'])->name('user.chats.old');
Route::post('/user-chats/update-active', [UserChatsController::class, 'updateUserActive'])->name('user.chats.update-active');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');




Route::middleware('auth:admin')->group(function () {

    Route::get('/admin/manage-terms', [AdminTermConditionController::class, 'manageTerms'])->name('admin.manage-terms');
    Route::get('/admin/manage-privacy', [AdminPrivacyPolicyController::class, 'managePrivacy'])->name('admin.manage-privacy');
    Route::get('/user-chats/last-active-time/{visitor_id}', [UserChatsController::class, 'getLastActiveTime'])->name('user.chats.last-active-time');
    Route::post('/user-chats/take-control', [UserChatsController::class, 'takeControl'])->name('user.chats.take-control');
    Route::post('/user-chats/admin-message', [UserChatsController::class, 'sendAdminMessage'])->name('user.chats.admin-message');
    Route::delete('/user-chats/delete/{visitor_id}', [UserChatsController::class, 'deleteChat'])->name('user.chats.delete');
    Route::get('/admin/manage-portfolio', [AdminManagePortfolio::class, 'managePortfolio'])->name('admin.manage-portfolio');
    Route::get('/admin/manage-portfolio/gallery', [AdminManagePortfolio::class, 'managePortfolioGallery'])->name('admin.manage-portfolio.gallery');
    Route::post('/admin/manage-portfolio/gallery/store', [AdminManagePortfolio::class, 'storeGallery'])->name('admin.manage-portfolio.gallery.store');
    Route::put('/admin/manage-portfolio/gallery/update/{id}', [AdminManagePortfolio::class, 'updateGallery'])->name('admin.manage-portfolio.gallery.update');
    Route::delete('/admin/manage-portfolio/gallery/delete/{id}', [AdminManagePortfolio::class, 'deleteGallery'])->name('admin.manage-portfolio.gallery.delete');
    Route::get('/admin/manage-portfolio/case-studies', [AdminManagePortfolio::class, 'manageCaseStudies'])->name('admin.manage-portfolio.case-studies');
    Route::post('/admin/manage-portfolio/case-studies/store', [AdminManagePortfolio::class, 'storeCaseStudy'])->name('admin.manage-portfolio.case-studies.store');
    Route::put('/admin/manage-portfolio/case-studies/update/{id}', [AdminManagePortfolio::class, 'updateCaseStudy'])->name('admin.manage-portfolio.case-studies.update');
    Route::delete('/admin/manage-portfolio/case-studies/delete/{id}', [AdminManagePortfolio::class, 'deleteCaseStudy'])->name('admin.manage-portfolio.case-studies.delete');
    Route::get('/admin/manage-portfolio/achievements', [AdminManagePortfolio::class, 'manageAchievements'])->name('admin.manage-portfolio.achievements');
    Route::put('/admin/manage-portfolio/achievements/update/{id}', [AdminManagePortfolio::class, 'updateAchievement'])->name('admin.manage-portfolio.achievements.update');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.create');
    Route::get('/admin/manage-blogs', [AdminManageBlogController::class, 'index'])->name('admin.blog.list');
    Route::get('/admin/blog/create', [AdminManageBlogController::class, 'newBlog'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [AdminManageBlogController::class, 'saveBlog'])->name('admin.blog.store');
    Route::get('/admin/blog/edit/{id}', [AdminManageBlogController::class, 'editBlog'])->name('admin.blog.edit');
    Route::delete('/admin/blog/delete/{id}', [AdminManageBlogController::class, 'deleteBlog'])->name('admin.blog.delete');
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
    $achievements = Cache::remember('achievements', 60 * 60 * 24 * 30, function () {
        return Achievement::all();
    });
    return view('frontend.home', compact('achievements'));
});
Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});
Route::get('/about-us', function () {
    $achievements = Cache::remember('achievements', 60 * 60 * 24 * 30, function () {
        return Achievement::all();
    });
    return view('frontend.about-us', compact('achievements'));
});
Route::get('/terms-conditions', function () {
    return view('frontend.terms_conditions');
});
Route::get('/privacy-policy', function () {
    return view('frontend.privacy_policy');
});
Route::get('/blogs', [AdminManageBlogController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [AdminManageBlogController::class, 'userBlogView'])->name('blog.view');

Route::get('/portfolio', function () {
    $blogs = Cache::remember('frontend.featured.blogs', 3600, function () {
        return Blog::where('is_featured', 1)->latest()->get();
    });
    $caseStudies = Cache::remember('case_studies_featured', 60 * 60 * 24 * 30, function () {
        return CaseStudy::where('is_featured', true)->orderBy('order', 'asc')->get();
    });
    $achievements = Cache::remember('achievements', 60 * 60 * 24 * 30, function () {
        return Achievement::all();
    });
    return view('frontend.portfolio', compact('blogs', 'caseStudies', 'achievements'));
});

// Route to list all services
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');

// Route to show a single service
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');


Route::get('/pricing/{service}', [PricingController::class, 'index'])->name('pricing.index');

// OG Images Management Routes
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/manage-og-images', [App\Http\Controllers\Admin\OgImageController::class, 'index'])->name('admin.og-images.index');
    Route::post('/og-images/upload', [App\Http\Controllers\Admin\OgImageController::class, 'upload'])->name('admin.og-images.upload');
    Route::put('/og-images/{filename}', [App\Http\Controllers\Admin\OgImageController::class, 'update'])->name('admin.og-images.update');
    Route::delete('/og-images/{filename}', [App\Http\Controllers\Admin\OgImageController::class, 'delete'])->name('admin.og-images.delete');
});
