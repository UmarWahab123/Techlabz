<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RepairContactController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\AmazonController;
use App\Http\Controllers\SalesCategoryController;
use App\Http\Controllers\SalesProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

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
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/blog/{slug?}', [HomeController::class, 'post'])->name('post');
Route::post('/load-more-data', [HomeController::class, 'more_data']);
Route::get('/blog', [HomeController::class, 'post'])->name('blogpost');
Route::get('/blog/category/{slug}', [HomeController::class, 'postCategory'])->name('blogpostCategory');
Route::get('/repair-post-detail/{slug}', [HomeController::class, 'post_detail'])->name('blogpostdetail');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('about_us');
Route::get('/post-detail/{slug}', [HomeController::class, 'blog_post_detail'])->name('postdetail');

Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact_us');
Route::post('/add-contact-us', [HomeController::class, 'contact_us']);
Route::post('/add-service-contact', [HomeController::class, 'service_contact_us']);
Route::get('/service/{slug?}/{slug1?}', [HomeController::class, 'service'])->name('service');
Route::get('/brand/{slug?}', [HomeController::class, 'brand'])->name('brand');
Route::get('/product/{slug?}/{brand?}', [HomeController::class, 'product'])->name('product');
Route::get('/product-detail/{slug?}', [HomeController::class, 'product_detail'])->name('product-detail');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/create-order', [HomeController::class, 'create_order']);
Route::post('/complete-payment', [HomeController::class, 'complete_payment']);

Route::get('/sitemap.xml', [HomeController::class, 'sitemap']);


Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::post('add-to-cart', [HomeController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [HomeController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [HomeController::class, 'remove'])->name('remove.from.cart');


Route::get('/services', function () {
    return redirect('/service');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['prefix'=>'user' , 'middleware' => ['auth','verified']], function() {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/edit-profile', [UserDashboardController::class, 'edit_profile'])->name('user.profile');
    Route::get('/my-order', [UserDashboardController::class, 'my_order'])->name('user.order');
    Route::get('/my-wishlist', [UserDashboardController::class, 'my_wishlist'])->name('user.wishlist');
    Route::post('/save-profile', [UserDashboardController::class, 'saveprofile'])->name('user.save-profile');
});


Route::group(['prefix'=>'admin'], function() {
    Route::get('/login', [DashboardController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => ['auth','admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('manage-post', [DashboardController::class, 'managePost'])->name('manage-post');
    Route::get('/add-post', [DashboardController::class, 'addPost'])->name('add-post');
    Route::get('/edit-post/{id}', [DashboardController::class, 'editPost'])->name('edit-post');
    Route::post('/save-post', [DashboardController::class, 'savePost'])->name('save-post');
    Route::post('/update-post-status', [DashboardController::class, 'update_post_status'])->name('update_post_status');
    Route::post('/delete-post', [DashboardController::class, 'delete_post'])->name('delete_post');
    Route::post('/get-blog-list', [DashboardController::class, 'get_blog_list'])->name('get_blog_list');
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
    Route::post('/save-setting', [DashboardController::class, 'saveSetting'])->name('save-setting');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/save-profile', [DashboardController::class, 'saveprofile'])->name('save-profile');


    Route::get('manage-category', [DashboardController::class, 'manageCategory'])->name('manage-category');
    Route::get('/add-category', [DashboardController::class, 'addCategory'])->name('add-category');
    Route::get('/edit-category/{id}', [DashboardController::class, 'editCategory'])->name('edit-category');
    Route::post('/save-category', [DashboardController::class, 'saveCategory'])->name('save-category');
    Route::post('/get-category-list', [DashboardController::class, 'get_category_list'])->name('get_category_list');
    Route::post('/update-category-status', [DashboardController::class, 'update_category_status'])->name('update_category_status');
    Route::post('/delete-category', [DashboardController::class, 'delete_category'])->name('delete_category');



    Route::get('post/manage-post', [PostController::class, 'managePost'])->name('blog.manage-post');
    Route::get('/post/add-post', [PostController::class, 'addPost'])->name('blog.add-post');
    Route::get('/post/edit-post/{id}', [PostController::class, 'editPost'])->name('blog.edit-post');
    Route::post('/post/save-post', [PostController::class, 'savePost'])->name('blog.save-post');
    Route::post('/post/update-post-status', [PostController::class, 'update_post_status'])->name('blog.update_post_status');
    Route::post('/post/delete-post', [PostController::class, 'delete_post'])->name('blog.delete_post');
    Route::post('/post/get-blog-list', [PostController::class, 'get_blog_list'])->name('blog.get_blog_list');

    Route::get('manage-service', [PostController::class, 'manageservice'])->name('manage-service');
    Route::get('/edit-service/{id?}', [PostController::class, 'editService'])->name('edit-service');
    Route::post('/save-service', [PostController::class, 'saveService'])->name('save-service');
    Route::post('/update-service-status', [PostController::class, 'update_service_status'])->name('update_service_status');
    Route::post('/get-service-list', [PostController::class, 'get_service_list'])->name('get_service_list');

    Route::get('manage-contact', [ContactController::class, 'manageContact'])->name('manage-contact');
    Route::get('/view-contact/{id}', [ContactController::class, 'editContact'])->name('edit-contact');
    Route::post('/save-contact', [ContactController::class, 'saveContact'])->name('save-contact');
    Route::post('/get-contact-list', [ContactController::class, 'get_contact_list'])->name('get_contact_list');
    Route::post('/update-contact-status', [ContactController::class, 'update_contact_status'])->name('update_contact_status');
    Route::post('/delete-contact', [ContactController::class, 'delete_contact'])->name('delete_contact');


    Route::get('manage-email-template', [EmailController::class, 'index'])->name('manage-email-template');
    Route::post('/get-template-list', [EmailController::class, 'get_template_list'])->name('get_template_list');
    Route::get('/edit-template/{id}', [EmailController::class, 'editTemplate'])->name('edit-template');
    Route::post('/save-template', [EmailController::class, 'saveTemplate'])->name('save-template');


    Route::get('/seo-setting', [SettingController::class, 'seoSetting'])->name('seo-setting');
    Route::get('/home-setting', [SettingController::class, 'homeSetting'])->name('home-setting');
    Route::post('/save-seo-setting', [SettingController::class, 'saveSeoSetting'])->name('save-seo-setting');
    Route::post('/save-home-setting', [SettingController::class, 'savehomeSetting'])->name('save-home-setting');


    Route::get('manage-sub-service', [PostController::class, 'manageSubservice'])->name('manage-sub-service');
    Route::get('/edit-sub-service/{id?}', [PostController::class, 'editSubService'])->name('edit-sub-service');
    Route::post('/save-sub-service', [PostController::class, 'saveSubService'])->name('save-sub-service');
    Route::post('/get-sub-service-list', [PostController::class, 'get_sub_service_list'])->name('get_sub_service_list');

    Route::get('contact-service/manage-contact', [RepairContactController::class, 'manageContact'])->name('manage-repair-contact');
    Route::get('/contact-service/view-contact/{id}', [RepairContactController::class, 'editContact'])->name('edit-repair-contact');
    Route::post('/contact-service/save-contact', [RepairContactController::class, 'saveContact'])->name('save-repair-contact');
    Route::post('/contact-service/get-contact-list', [RepairContactController::class, 'get_contact_list'])->name('get_repair_contact_list');
    Route::post('/contact-service/update-contact-status', [RepairContactController::class, 'update_contact_status'])->name('update_repair_contact_status');
    Route::post('/contact-service/delete-contact', [RepairContactController::class, 'delete_contact'])->name('delete_repair_contact');


    Route::get('manage-database-backup', [BackupController::class, 'index'])->name('manage-database');

    Route::post('/make-backup', [BackupController::class, 'takeBackup'])->name('take-backup');


    Route::get('manage-deals', [AmazonController::class, 'index'])->name('manage-deals');
    Route::get('/add-deal', [AmazonController::class, 'addDeal'])->name('add-deal');
    Route::post('/save-deal', [AmazonController::class, 'saveDeal'])->name('save-deal');
    Route::post('/delete-deal', [AmazonController::class, 'delete_deal'])->name('delete_deal');
    Route::get('/edit-deal/{id?}', [AmazonController::class, 'editDeal'])->name('edit-deal');
    Route::post('/get-deals-list', [AmazonController::class, 'get_deals_list'])->name('get_deals_list');


    Route::get('manage-sales-category', [SalesCategoryController::class, 'index'])->name('manage-sales-category');
    Route::get('/add-sales-category', [SalesCategoryController::class, 'addDeal'])->name('add-sales-category');
    Route::post('/save-sales-category', [SalesCategoryController::class, 'saveDeal'])->name('save-sales-category');
    Route::post('/delete-sales-category', [SalesCategoryController::class, 'delete_deal'])->name('delete_sales-category');
    Route::get('/edit-sales-category/{id?}', [SalesCategoryController::class, 'editDeal'])->name('edit-sales-category');
    Route::post('/get-sales-category-list', [SalesCategoryController::class, 'get_deals_list'])->name('get_sales-category_list');


    Route::get('manage-brand', [BrandController::class, 'index'])->name('manage-brand');
    Route::get('/add-brand', [BrandController::class, 'addDeal'])->name('add-brand');
    Route::post('/save-brand', [BrandController::class, 'saveDeal'])->name('save-brand');
    Route::post('/delete-brand', [BrandController::class, 'delete_deal'])->name('delete_brand');
    Route::get('/edit-brand/{id?}', [BrandController::class, 'editDeal'])->name('edit-brand');
    Route::post('/get-brand-list', [BrandController::class, 'get_deals_list'])->name('get_brand_list');

    Route::post('/update-brand-status', [BrandController::class, 'update_brand_status'])->name('update_brand_status');
    

    Route::get('manage-sales-product', [SalesProductController::class, 'index'])->name('manage-sales-product');
    Route::get('/add-sales-product', [SalesProductController::class, 'addDeal'])->name('add-sales-product');
    Route::post('/save-sales-product', [SalesProductController::class, 'saveDeal'])->name('save-sales-product');
    Route::post('/delete-sales-product', [SalesProductController::class, 'delete_deal'])->name('delete_sales-product');
    Route::get('/edit-sales-product/{id?}', [SalesProductController::class, 'editDeal'])->name('edit-sales-product');
    Route::post('/get-sales-product-list', [SalesProductController::class, 'get_deals_list'])->name('get_sales-product_list');
    Route::post('/save-product-addon', [SalesProductController::class, 'saveAddon'])->name('save-product-addon');
    Route::post('/save-product-images', [SalesProductController::class, 'saveImages'])->name('save-product-images');
    Route::post('/save-product-description', [SalesProductController::class, 'saveDescription'])->name('save-product-description');
    Route::post('/delete-sales-image', [SalesProductController::class, 'delete_image'])->name('delete_sales-image');
    Route::post('/delete-addon', [SalesProductController::class, 'delete_addon'])->name('delete_addon');

    Route::get('manage-orders', [OrderController::class, 'index'])->name('manage-orders');
    Route::get('/view-sales-order/{id?}', [OrderController::class, 'editDeal'])->name('view-sales-order');
    Route::post('/save-order', [OrderController::class, 'saveDeal'])->name('save-order');
    Route::post('/complete-order', [OrderController::class, 'delete_deal'])->name('complete-order');
    Route::post('/get-sales-order-list', [OrderController::class, 'get_deals_list'])->name('get_sales-order_list');


    Route::get('manage-users', [CustomerController::class, 'index'])->name('manage-users');
    Route::post('/get-user-list', [CustomerController::class, 'get_user_list'])->name('get_user_list');
    Route::get('/edit-user/{id?}', [CustomerController::class, 'editUser'])->name('edit-user');
    Route::post('/save-user', [CustomerController::class, 'saveUser'])->name('save-user');



});

require __DIR__.'/auth.php';
