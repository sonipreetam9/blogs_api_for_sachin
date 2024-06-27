<?php
use App\Http\Controllers\BlogAPI_Controller;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsitePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Client Routes
Route::get('/', [ClientAuthController::class, 'client_login_page'])->name('client.login.page');
Route::prefix('client')->group(function () {
    Route::post('/login-post', [ClientAuthController::class, 'client_login_checking'])->name('client.login.post');

    Route::middleware(['client'])->group(function () {
        Route::get('/dashboard', [ClientController::class, 'client_dashboard'])->name('client.dashboard');
        Route::get('/logout', [ClientAuthController::class, 'client_logout'])->name('client.logout');
        Route::get('/add-blog', [BlogController::class, 'client_add_blog_page'])->name('client.add.blog');
        Route::post('/add-blog-post', [BlogController::class, 'client_add_blog_post'])->name('client.add.blog.post');
        Route::delete('/del-blog-post/{blogId}', [BlogController::class, 'client_delete_blog'])->name('client.delete.blog');
        Route::get('/edit-blog/{blogId}', [BlogController::class, 'client_edit_blog_page'])->name('client.edit.blog');
        Route::post('/edit-blog/post', [BlogController::class, 'client_edit_blog_post'])->name('client.edit.blog.post');
        Route::get('/all-blogs', [BlogController::class, 'client_all_blog_page'])->name('client.blog.list');
        Route::get('/add-blog-data/{id}', [BlogController::class, 'client_add_blog_data_page'])->name('client.add.blog.extra.data');
        Route::post('/add-blog-data/post', [BlogController::class, 'client_add_blog_data_post'])->name('client.add.blog.extra.data.post');
        Route::post('/delete-blog-data/post', [BlogController::class, 'client_delete_blog_data_post'])->name('client.delete.extra.blog.data');
        Route::get('/edit-blog-data/{blog_id}/{id}', [BlogController::class, 'client_edit_blog_data_page'])->name('client.edit.blog.extra.data.page');
        Route::post('/edit-blog-data/post', [BlogController::class, 'client_edit_blog_data_post'])->name('client.edit.blog.extra.data.post');
    });
});

// Admin Routes
Route::prefix('super-admin')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login-post', [AuthController::class, 'login_checking'])->name('login.post');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AuthController::class, 'admin_dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout.admin');
        Route::get('/add-client', [ClientController::class, 'add_client_page'])->name('admin.add.client');
        Route::post('/add-client', [ClientController::class, 'add_client_post'])->name('admin.add.client.post');
        Route::get('/all-client-list', [ClientController::class, 'all_client_list'])->name('admin.client.list');
        Route::delete('/all-client-list/{clientId}', [ClientController::class, 'delete_client'])->name('adm.delete.client');
        Route::get('/edit-client/{clientId}', [ClientController::class, 'edit_client'])->name('admin.edit.client.get');
        Route::post('/edit-client/{clientId}', [ClientController::class, 'edit_client_post'])->name('admin.edit.client.post');
        Route::get('/add-website-page/{clientId}', [WebsitePageController::class, 'add_website_page'])->name('admin.add.website.page.get');
        Route::post('/add-website-page/{clientId}', [WebsitePageController::class, 'add_website_page_insert'])->name('admin.add.website.page.post');
        Route::delete('/delete-page/{pageId}', [WebsitePageController::class, 'delete_page'])->name('adm.delete.client.website.page');
        Route::get('/edit/page/content/{clientId}/{pageId}', [WebsitePageController::class, 'edit_content_page'])->name('admin.edit.page.content.get');
        Route::post('/edit/page/content/{pageId}', [WebsitePageController::class, 'edit_content_page_post'])->name('admin.edit.website.page.content.post');
        Route::get('/js/script/page', [Controller::class, 'js_page_view'])->name('admin.js.script.page');
    });
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/all-blog/{api}', [BlogAPI_Controller::class, 'all_blog'])->name('all.blog.api');
    Route::get('/single-blog/{api}/{blogID}', [BlogAPI_Controller::class, 'single_blog'])->name('single.blog.api');
});
