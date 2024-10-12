<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageHandlerController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\Front\ContactUsController;


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

Route::get('/lang/{lang}', [HomeController::class, 'changeLang'])->name('home.changeLang');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('/image')->group(function () {
    Route::get('/{path}/{id}', [ImageHandlerController::class, 'getDefaultImage'])->name('image');
    Route::get('/{size}/{path}/{id}', [ImageHandlerController::class, 'getPublicImage']);
    Route::post('/upload', [ImageController::class, 'uploadImage'])->name('upload.image');
});

Route::get('/files/{link}', [FileController::class, 'getFileLink'])->name('file.getLink');
Route::post('/files/upload-file', [FileController::class, 'uploadFile'])->name('file.upload');
