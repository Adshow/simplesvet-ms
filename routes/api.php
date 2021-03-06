<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatologiaController;

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

Route::post('store-patologia', [PatologiaController::class,'store']);

Route::post('update-patologia', [PatologiaController::class,'update']);

Route::post('filter-patologia', [PatologiaController::class,'filter']);

Route::get('list-patologia', [PatologiaController::class,'list']);

Route::get('shelve-patologia/{patologia_id}', [PatologiaController::class,'shelve']);

Route::get('get-patologia/{patologia_id}', [PatologiaController::class,'get']);

Route::get('history-patologia/{patologia_id}', [PatologiaController::class,'history']);