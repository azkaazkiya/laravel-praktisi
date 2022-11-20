<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\AdminController;
use App\Http\Controllers\Backend\UserController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout',[AdminController::class, 'logout'])->name('admin.logout');

//semua route untuk user


route::prefix('users')->group(function(){
    Route::get('/view',[Usercontroller::class, 'UserView'])->name('user.view');
    Route::get('/add',[Usercontroller::class, 'UserAdd'])->name('user.add');
    Route::post('/store',[Usercontroller::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}',[Usercontroller::class, 'UserEdit'])->name('users.edit');
    Route::post('/update/{id}',[Usercontroller::class, 'UserUpdate'])->name('users.update');
    Route::get('/delete/{id}',[Usercontroller::class, 'UserDelete'])->name('users.delete');
}); 