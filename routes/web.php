<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

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
Route::get('/create-symlink', function (){
    symlink(storage_path('/app/public'), public_path('storage'));
    echo "Symlink Created. Thanks";
});

Route::get('sitemap', function (){
    SitemapGenerator::create('https://sustpressclub.org/')->writeToFile('sitemap.xml');
   return 'sitemap created';
});

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/experiences', 'FrontendController@experiences')->name('experiences');
Route::get('/research', 'FrontendController@research')->name('research');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/blog/{slug}', 'FrontendController@blogView')->name('blogshow');

Auth::routes();

Route::resource('/dashboard','DashboardController');
Route::resource('/post','PostController');
Route::resource('/admin','AdminController');
Route::get('/profile','AdminController@profile')->name('profile');
Route::post('/passwordChange','AdminController@passwordChange')->name('passwordChange');
Route::resource('/settings','SettingsController');


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/config-cache', function (){
    Artisan::call('config:cache');
    return "config cache successfully";
});

Route::get('optimize', function (){
    Artisan::call('optimize');
    return "optimize successfully";
});

Route::get('optimize-clear', function (){
    Artisan::call('optimize:clear');
    return "optimize clear successfully";
});
