<?php

use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;

//Account
Route::get('dashboard',[UserController::class,'index'])->middleware('auth')->name('dashboard.account.index');
Route::get('dashboard/login',[UserController::class,'showLogin'])->name('dashboard.account.login');
Route::post('dashboard/login_process',[UserController::class,'login'])->name('dashboard.account.process');

//Sync contacts
Route::get('dashboard/sync',[UserController::class,'syncContacts'])->name('dashboard.sync');

//Front
Route::get('{page?}',[FrontController::class,'index'])->name('front.home');

//Contact detail
Route::get('individual/{contactId}',[FrontController::class,'contact_detail'])->name('front.contact.detail');

//Send Emails
Route::post('send-email',[FrontController::class,'send_email'])->name('front.send_email');

//Configs
Route::middleware('auth')->prefix('admin/configs')->group(function () {
    Route::get('callback', [ConfigController::class, 'callback'])->name('config.callback');
    Route::get('webhook', [ConfigController::class, 'webhook'])->name('config.webhook');
    Route::get('finish', [ConfigController::class, 'finish'])->name('config.finish');
    Route::get('connect', [ConfigController::class, 'connect'])->name('config.connect');
    Route::get('renew', [ConfigController::class, 'renewToken'])->name('config.renewtoken');
    Route::get('authorization', [ConfigController::class, 'getAuthorizationCode'])->name('config.authorization');
});