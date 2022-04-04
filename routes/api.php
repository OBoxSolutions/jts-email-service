<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/email', [EmailController::class, 'sendEmail']);
Route::post('/email-service', [EmailServiceController::class, 'sendEmailService']);
