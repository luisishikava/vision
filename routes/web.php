<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisionController;

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


Route::get('/vision/check-image', [VisionController::class, 'checkImage']);
Route::post('/vision/check-image-success', [VisionController::class, 'checkImageSuccessPost']);


Route::get('/vision/check-qrcode', [VisionController::class, 'checkQrcode']);
Route::post('/vision/check-qrcode-success', [VisionController::class, 'checkQrcodePost']);




Route::get('/vision/string', [VisionController::class, 'string']);

Route::get('/vision/qrcode', [VisionController::class, 'qrCode']);



Route::get('/vision/api-google-image{image}', [VisionController::class, 'apiGooglmage']);
