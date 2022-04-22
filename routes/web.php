<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionController;
use App\Models\Article;
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
    if(auth()->user()){
        return view('home');
    }
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('new-company', function(){
    return view('auth.company');
})->name('add.company');

Route::post('company/add', [CompanyController::class, 'store'])->name('company.store');

Route::get('new-user', function(){
    return view('auth.register');
})->name('add.user');


Route::middleware('auth')->group(function(){


Route::view('profile', 'auth.profile')->name('profile');
Route::view('profile/password', 'auth.passwords.change')->name('password.change');

Route::view('element-new', 'element-new')->name('element.new');

Route::post('material-create', [MaterialController::class, 'create'])->name('material.create');
Route::post('job_group_create', [ElementController::class, 'create_job_group'])->name('job.group.create');
Route::post('machine_create', [ElementController::class, 'create_machine'])->name('machine.create');

Route::get('elements/groups', [ElementController::class, 'job_group_list'])->name('job.group.list');
Route::get('elements/group/{id}/turn', [ElementController::class, 'job_group_status'])->name('job.group.status');
Route::get('elements/group/{id}', [ElementController::class, 'job_group_select'])->name('job.group.select');
Route::get('elements/group/{id}/run', [ElementController::class, 'job_group_run_filter'])->name('job.group.run.filter');
Route::get('elements/group/{id}/filtr-off', [ElementController::class, 'job_group_filter_nulls'])->name('job.group.filter.nulls');
Route::post('elements/group/edit', [ElementController::class, 'job_group_edit'])->name('job.group.edit');


Route::get('elements/machines', [ElementController::class, 'machine_list'])->name('machine.list');
Route::get('elements/machine/{id}/turn', [ElementController::class, 'machine_status'])->name('machine.status');
Route::get('elements/machine/{id}', [ElementController::class, 'machine_select'])->name('machine.select');
Route::get('elements/machine/{id}/run', [ElementController::class, 'machine_run_filter'])->name('machine.run.filter');
Route::get('elements/machine/{id}/filtr-off', [ElementController::class, 'machine_filter_nulls'])->name('machine.filter.nulls');
Route::post('elements/machine/edit', [ElementController::class, 'machine_edit'])->name('machine.edit');
Route::get('material/{id}/delete', [MaterialController::class, 'delete'])->name('material.delete');

Route::post('element-create', [ElementController::class, 'create'])->name('element.create');
Route::post('elements', [ElementController::class, 'show_custom_size'])->name('element.list.custom-size');
Route::get('elements', [ElementController::class, 'show'])->name('element.list');
Route::get('element-edit/{id}', [ElementController::class, 'edit'])->name('element.edit');
Route::post('element-update', [ElementController::class, 'update'])->name('element.update');
Route::post('element-file-pdf-/{id}', [ElementController::class, 'filepdf_delete'])->name('elementfilepdf.delete');
Route::post('element-file-dxf-/{id}', [ElementController::class, 'filedxf_delete'])->name('elementfiledxf.delete');
Route::get('element/delete/{id}', [ElementController::class, 'element_delete'])->name('element.delete');


Route::post('elements-filter',[ElementController::class, 'filter'])->name('element.filter');
Route::post('add-elements-to-group', [ElementController::class, 'add_elements_to_jobgroup'])->name('addition.elements.jobgroup');
Route::post('add-elements-to-machine', [ElementController::class, 'add_elements_to_machine'])->name('addition.elements.machine');

Route::view('article-new', 'article-new')->name('article.new');
Route::put('article-create', [ArticleController::class, 'create'])->name('article.create');
Route::get('articles', [ArticleController::class, 'show'])->name('article.list');
// Route::view('articles', 'article-list')->name('article.list');
Route::get('article-edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('article-update', [ArticleController::class, 'update'])->name('article.update');
Route::get('article/delete/{id}', [ArticleController::class, 'article_delete'])->name('article.delete');


Route::get('articles-elements/{article_id}', [ArticleController::class, 'articles_elements_new'])->name('articles.elements.new');
Route::put('articles-elements-add', [ArticleController::class, 'articles_elements_add'])->name('articles_elements.add');
Route::view('article-details', 'article-details')->name('article.details');
Route::get('articles-elements-show/{id}', [ArticleController::class, 'articles_elements_show'])->name('article.details.show');
Route::get('articles-element-delete/{article_id}-{element_id}-{amount}', [ArticleController::class, 'articles_elements_delete'])->name('article.elements.delete');



Route::view('product-new', 'product-new')->name('product.new');
Route::put('product-create', [ProductController::class, 'create'])->name('product.create');
Route::get('products', [ProductController::class, 'show'])->name('product.list');
//Route::view('products', 'product-list')->name('product.list');
Route::get('product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product-update', [ProductController::class, 'update'])->name('product.update');
Route::get('product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');


Route::get('products-articles-show/{id}', [ProductController::class, 'products_articles_show'])->name('product.details.show');
Route::get('products-articles/{product_id}', [ProductController::class, 'products_articles_new'])->name('products.articles.new');
Route::put('products-articles', [ProductController::class, 'products_articles_add'])->name('products_articles.add');
Route::get('product-article-delete/{product_id}-{article_id}-{amount}', [ProductController::class, 'product_article_delete'])->name('product.article.delete');


//////////

Route::view('order-new', 'order-new')->name('order.new');
Route::put('order-create', [OrderController::class, 'create'])->name('order.create');
Route::get('orders', [OrderController::class, 'show'])->name('order.list');
//Route::view('orders', 'order-list')->name('order.list');
Route::get('order-edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::put('order-update', [OrderController::class, 'update'])->name('order.update');
Route::get('order/delete/{id}', [OrderController::class, 'order_delete'])->name('order.delete');


Route::get('orders-products-show/{id}', [OrderController::class, 'orders_products_show'])->name('order.details.show');
Route::get('orders-products/{order_id}', [OrderController::class, 'orders_products_new'])->name('orders.products.new');
Route::put('orders-products', [OrderController::class, 'orders_products_add'])->name('orders_products.add');
Route::get('order-product-delete/{order_id}-{product_id}-{amount}', [OrderController::class, 'order_product_delete'])->name('order.product.delete');







Route::view('production', 'production-show')->name('production.show');
Route::put('production-show', [ProductionController::class, 'show'])->name('production');
Route::view('inplan-prod-to-job', 'production-plan')->name('production.plan');


    Route::middleware('admin')->group(function(){

        Route::view('panel', 'admin.panel')->name('panel');
        Route::get('user-edit/{company_id}-{id}', [AdminController::class, 'user_edit'])->name('user.edit');
        Route::put('user-save', [AdminController::class, 'user_save'])->name('user.save');
        Route::get('company-edit/{id}', [AdminController::class, 'company_edit'])->name('company.edit');
        Route::put('company-save', [AdminController::class, 'company_save'])->name('company.save');
        Route::put('change-status/{user_id}', [AdminController::class, 'user_status'])->name('change.status');
    
    
    });



});









