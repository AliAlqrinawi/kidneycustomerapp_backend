<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConstantsController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\ProductsController;

use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\VerificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [RegisterController::class, 'registration']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('forget-password-check-code', [ForgotPasswordController::class, 'checkForgotPasswordCode']);
Route::post('forget-password-resend-code', [ForgotPasswordController::class, 'resendForgotPasswordCode']);
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);

//constants
Route::controller(ConstantsController::class)
    ->prefix('constants')
    ->group(function () {
        Route::get('/get-all/{parent}', 'getAll');
    });

//pages
Route::controller(PagesController::class)
    ->prefix('pages')
    ->group(function () {
        Route::get('/{slug}', 'single');
    });

//posts
Route::controller(PostsController::class)
    ->prefix('posts')
    ->group(function () {
        Route::get('/all', 'all');
        Route::get('/{id}', 'single');
    });

//products
Route::controller(ProductsController::class)
    ->prefix('products')
    ->group(function () {
        Route::get('/all', 'all');
        Route::get('/{id}', 'single');
    });


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/test-auth', function () {
        return 'User is authenticated!';
    });

    Route::post('/verification', [VerificationController::class, 'verification']);
    Route::get('/resend', [VerificationController::class, 'resend']);

    Route::get('/logout', [LoginController::class, 'logout']);

});


//contact
Route::prefix('/contact-us')->group(function () {
    Route::get('/', [ContactUsController::class, 'index']);
    Route::post('/', [ContactUsController::class, 'store']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
