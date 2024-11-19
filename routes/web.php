<?php

use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;

//Front
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('nosotros',[FrontController::class,'about'])->name('front.about');
Route::get('contacto',[FrontController::class,'contact'])->name('front.contact');

//Contact detail
Route::get('individual/{contactId}',[FrontController::class,'contact_detail'])->name('front.contact.detail');

//Account
Route::get('create',[FrontController::class,'account_create'])->name('front.account.create');
Route::get('forgot',[FrontController::class,'account_forgot'])->name('front.account.forgot');

//Configs
Route::get('admin/configs/callback', [ConfigController::class, 'callback'])->name('config.callback');
Route::get('admin/configs/webhook', [ConfigController::class, 'webhook'])->name('config.webhook');
Route::get('admin/configs/finish', [ConfigController::class, 'finish'])->name('config.finish');
Route::get('admin/configs/connect', [ConfigController::class, 'connect'])->name('config.connect');
Route::get('admin/configs/authorization', [ConfigController::class, 'getAuthorizationCode'])->name('config.authorization');

