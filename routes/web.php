<?php

use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectToFilamentLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

Route::get('/clear-cache', function (Request $request) {
    Artisan::call('optimize:clear');
    return 'Cache cleared successfully.';
})->middleware('auth');

//Login & Logout
Route::get('login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('filament.admin.auth.login');
})->name('logout');

//Account
Route::get('dashboard',[UserController::class,'index'])->middleware('auth')->name('dashboard.account.index');
Route::get('dashboard/login',[UserController::class,'showLogin'])->name('dashboard.account.login');
Route::put('dashboard/update',[UserController::class,'update'])->middleware('auth')->name('dashboard.account.update');
Route::put('dashboard/socials/update',[UserController::class,'social_update'])->middleware('auth')->name('dashboard.social.update');
Route::post('dashboard/socials/delete',[UserController::class,'social_delete'])->middleware('auth')->name('dashboard.social.delete');
//Route::post('dashboard/login_process',[UserController::class,'login'])->name('dashboard.account.process');

//Sync contacts
Route::get('dashboard/sync',[UserController::class,'syncContacts'])->middleware('auth')->name('dashboard.sync');

//Front
Route::get('{page?}',[FrontController::class,'index'])->middleware('auth')->name('front.home');

//Contact detail
Route::get('individual/{contactId}',[FrontController::class,'contact_detail'])->name('front.contact.detail');

//Send emails
Route::post('send-email',[FrontController::class,'send_email'])->middleware('auth')->name('front.send_email');

//Configs
Route::middleware('auth')->prefix('admin/configs')->group(function () {
    Route::get('callback', [ConfigController::class, 'callback'])->name('config.callback');
    Route::get('webhook', [ConfigController::class, 'webhook'])->name('config.webhook');
    Route::get('finish', [ConfigController::class, 'finish'])->name('config.finish');
    Route::get('connect', [ConfigController::class, 'connect'])->name('config.connect');
    Route::get('renew', [ConfigController::class, 'renewToken'])->name('config.renewtoken');
    Route::get('authorization', [ConfigController::class, 'getAuthorizationCode'])->name('config.authorization');
});
