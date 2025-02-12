<?php

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
    return view('welcome');
});

use App\Http\Controllers\Admin\PinaController;
Route::controller(PinaController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('pina/create', 'add')->name('pina.add');
    Route::post('pina/create', 'create')->name('pina.create');
    Route::get('pina', 'index')->name('pina');
    Route::get('pina/edit', 'edit')->name('pina.edit');
    Route::post('pina/edit', 'update')->name('pina.update');
    Route::get('pina/delete', 'delete')->name('pina.delete');
});


//【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください
use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('profile/create', 'add')->name('profile.add');
    Route::post('profile/create', 'create')->name('profile.create');
    Route::get('profile', 'index')->name('profile.index');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});
Auth::routes();

use App\Http\Controllers\PinaController as PublicPinaController;
Route::get('/', [PublicPinaController::class, 'index'])->name('pina.index');
Route::get('/pina', [PublicPinaController::class, 'index'])->name('pina');
Route::get('/pina/pets', [PublicPinaController::class, 'showPets'])->name('pina.pet');
Route::get('/pina/bird', [PublicPinaController::class, 'showYacho'])->name('pina.bird');
