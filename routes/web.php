<?php

use App\Mail\TestMail;
use App\Mail\TestMailMarkdown;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Notification\WelcomeEmailNotification;

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
    return view('welcome');
});
    

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');


Route::group(['middleware' => ['auth']], function () {

    
    //dashboard admin dan manajer
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //dashboard pegawai
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'indexPegawai'])->name('homePegawai')->middleware('role:Pegawai');

    //menu gudang
    //Route::get('/menugudang', 'App\Http\Controllers\MenuGudangController@index')->name('menugudang')->middleware('role:Pegawai');

    //change password
    // Route::get('/change-password', 'App\Http\Controllers\PasswordController@changePassword')->name('change-password');
    // Route::post('/update-password', 'App\Http\Controllers\PasswordController@updatePassword')->name('update-password');

    //users
    Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
    Route::get('user/list', [UserController::class, 'getUser'])->name('user.list');
    Route::get('/user/create', 'App\Http\Controllers\UserController@create');
    Route::get('/user/{user}', 'App\Http\Controllers\UserController@show');
    Route::post('/user', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::delete('/user/{user}', 'App\Http\Controllers\UserController@destroy');
    Route::get('/user/{user}/edit', 'App\Http\Controllers\UserController@edit');
    Route::patch('/user/{user}', 'App\Http\Controllers\UserController@update');
    Route::get('/user/status/{user}', 'App\Http\Controllers\UserController@status');
    
    //roles
    Route::get('/role', 'App\Http\Controllers\RoleController@index')->name('role.index');
    Route::get('/role/create', 'App\Http\Controllers\RoleController@create');
    Route::get('/role/{role}/show', 'App\Http\Controllers\RoleController@show');
    Route::post('/role', 'App\Http\Controllers\RoleController@store')->name('role.store');
    Route::delete('/role/{role}', 'App\Http\Controllers\RoleController@destroy');
    Route::get('/role/{role}/edit', 'App\Http\Controllers\RoleController@edit');
    Route::patch('/role/{role}', 'App\Http\Controllers\RoleController@update');
    
    //menu
    Route::get('/menu', 'App\Http\Controllers\MenuController@indexMenu')->name('menu.index')->middleware('role:Admin');
    Route::get('/menu/create', 'App\Http\Controllers\MenuController@createMenu');
    Route::post('/menu', 'App\Http\Controllers\MenuController@storeMenu')->name('menu.store');
    Route::delete('/menu/{menu}', 'App\Http\Controllers\MenuController@destroyMenu');
    Route::get('/menu/{menu}/edit', 'App\Http\Controllers\MenuController@editMenu');
    Route::patch('/menu/{menu}', 'App\Http\Controllers\MenuController@updateMenu');

});

Auth::routes(['verify' => true]);

/* Route Contoh */
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
