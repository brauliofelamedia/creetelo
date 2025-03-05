<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WorldController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\SkillController;

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

Route::get('/countries',[WorldController::class,'countries']);
Route::get('/states/{country_id}',[WorldController::class,'states']);
Route::get('/cities/{country_id}/{state_id}',[WorldController::class,'cities']);

//Interests
Route::post('/interests/create', [InterestController::class, 'create'])->name('api.interest.create');

//Skills
Route::post('/skills/create', [SkillController::class, 'create'])->name('api.skill.create');