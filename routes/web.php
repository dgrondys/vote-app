<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
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

Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/ideas/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');

Route::get('profile', [UserController::class, 'index'])->name('profile');
Route::post('avatar', [UserController::class, 'updateAvatar'])->name('updateAvatar');
Route::post('avatarDel', [UserController::class, 'deleteAvatar'])->name('deleteAvatar');
Route::post('delete', [UserController::class, 'deleteUser'])->name('deleteUser');


Route::post('profile', [ChangePasswordController::class, 'store'])->name('change.password');

require __DIR__.'/auth.php';
