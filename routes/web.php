<?php

use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;

//Front
Route::get('/{page?}',[FrontController::class,'index'])->name('front.home');
Route::get('nosotros',[FrontController::class,'about'])->name('front.about');
Route::get('contacto',[FrontController::class,'contact'])->name('front.contact');

//Contact detail
Route::get('individual/{contactId}',[FrontController::class,'contact_detail'])->name('front.contact.detail');

//Account
Route::get('create',[FrontController::class,'account_create'])->name('front.account.create');
Route::get('login',[FrontController::class,'account_login'])->name('front.account.login');
Route::get('forgot',[FrontController::class,'account_forgot'])->name('front.account.forgot');

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

