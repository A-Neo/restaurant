<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Main;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->name('admin.')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::get('/articles/only', 'ArticleController@onlyTrash')->name('article.only');
    Route::post('/articles/restore/{id}', 'ArticleController@restoreModel')->name('article.restore');
    Route::post('/articles/fulldelete/{id}', 'ArticleController@fullDelete')->name('article.full.delete');

    Route::get('/pages/only', 'PageController@onlyTrash')->name('page.only');
    Route::post('/pages/restore/{id}', 'PageController@restoreModel')->name('page.restore');
    Route::post('/pagse/fulldelete/{id}', 'PageController@fullDelete')->name('page.full.delete');

    Route::get('/banquets/only', 'BanquetController@onlyTrash')->name('banquet.only');
    Route::post('/banquets/restore/{id}', 'BanquetController@restoreModel')->name('banquet.restore');
    Route::post('/banquets/fulldelete/{id}', 'BanquetController@fullDelete')->name('banquet.full.delete');

    Route::get('/foods/only', 'FoodController@onlyTrash')->name('food.only');
    Route::post('/foods/restore/{id}', 'FoodController@restoreModel')->name('food.restore');
    Route::post('/foods/fulldelete/{id}', 'FoodController@fullDelete')->name('food.full.delete');

    Route::get('/products/only', 'ProductController@onlyTrash')->name('product.only');
    Route::post('/products/restore/{id}', 'ProductController@restoreModel')->name('product.restore');
    Route::post('/products/fulldelete/{id}', 'ProductController@fullDelete')->name('product.full.delete');

    // Специфические маршруты
    Route::get('/categories/type/{type?}', 'CategoryController@type')->name('categories.type');
    Route::get('/products/delivery', 'ProductController@delivery')->name('products.delivery');
    Route::get('/products/images/{id}', 'ProductController@destroyImages')->name('products.destroy.images');
    Route::get('/products/search', 'ProductController@search')->name('products.search');
    Route::post('/articles/slide/{id}', 'ArticleController@deleteSlide')->name('article.delete.slide');
    Route::post('/articles/gallery/{id}', 'ArticleController@deleteGallery')->name('article.delete.gallery');
    Route::post('/pages/{page}/delete-slide', 'PageController@deleteSlide')->name('pages.delete.slide');
    Route::post('/banquets/slide/{id}', 'BanquetController@deleteSlide')->name('banquet.delete.slide');

    // Ресурсы в основном пространстве Admin
    Route::resources([
        '/banners' => 'BannerController',
        '/settings' => 'SettingController',
        '/foods' => 'FoodController',
        '/beverages' => 'BeverageController',
        '/categories' => 'CategoryController',
        '/products' => 'ProductController',
        '/rubrics' => 'RubricController',
        '/articles' => 'ArticleController',
        '/pages' => 'PageController',
        '/callbacks' => 'CallbackController',
        '/messages' => 'MessageController',
        '/orders' => 'OrderController',
        '/users' => 'UserController',
        '/deliveries' => 'DeliveryZoneController',
        '/algoritms' => 'AlgoritmController',
        '/banquets' => 'BanquetController',
    ]);
    // Ресурсы в пространстве имен Admin\Main
    Route::namespace('Main')->group(function () {
        Route::resources([
            '/abouts' => 'AboutController',
            '/additions' => 'AdditionController',
            '/reservations' => 'ReservationController',
            '/chefs' => 'ChefController',
            '/reviews' => 'ReviewController',
        ]);
    });
});
