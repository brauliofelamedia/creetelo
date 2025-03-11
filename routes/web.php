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
use App\Models\User;
use Illuminate\Support\Str;

Route::get('/clear-cache', function (Request $request) {
    Artisan::call('optimize:clear');
    return 'Cache cleared successfully.';
})->middleware('auth');

// Storage link command route
Route::get('/storage-link', function (Request $request) {
    try {
        Artisan::call('storage:link');
        return 'Storage link created successfully.';
    } catch (\Exception $e) {
        return 'Error creating storage link: ' . $e->getMessage();
    }
})->middleware('auth');

Route::get('/migrate', function (Request $request) {
    try {
        Artisan::call('migrate');
        return 'Migrations executed successfully.';
    } catch (\Exception $e) {
        return 'Error running migrations: ' . $e->getMessage();
    }
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
Route::get('dashboard/updateiso',[UserController::class,'changeIso'])->middleware('auth')->name('dashboard.iso.update');
Route::get('dashboard/deletastate',[UserController::class,'deleteStatesAndCities'])->middleware('auth')->name('dashboard.delete.state');
Route::get('dashboard/deletecontacts',[UserController::class,'deleteContacts'])->middleware('auth')->name('dashboard.delete.contacts');
//Route::post('dashboard/login_process',[UserController::class,'login'])->name('dashboard.account.process');

//Sync contacts
Route::get('dashboard/sync',[UserController::class,'syncContacts'])->name('dashboard.sync');
Route::get('dashboard/sync/crm',[UserController::class,'syncContactsCRM'])->middleware('auth')->name('dashboard.sync.crm');

//Front
Route::get('{page?}',[FrontController::class,'index'])->middleware('auth')->name('front.home');
Route::get('change/all',[FrontController::class,'changeCountry']);

//Webhook
Route::post('admin/create_user_weebhook',[FrontController::class,'create_user_weebhook'])->name('front.create_user_weebhook');
Route::get('dashboard/assign-password/{token}',[FrontController::class,'assign_password'])->name('front.assign_password');
Route::post('dashboard/assign',[FrontController::class,'assign_save'])->name('front.account.assign');

//Contact detail
Route::get('individual/{slug}',[FrontController::class,'contact_detail'])->middleware('auth')->name('front.contact.detail');

//Send emails
Route::post('send-email',[FrontController::class,'send_email'])->middleware('auth')->name('front.send_email');

Route::get('create-slug',function(){
    $users = User::all();
    foreach ($users as $user) {
        $user->slug = Str::slug($user->name);
        $user->save();
    }
});

//Magic logic
Route::get('magic/login',[FrontController::class,'magic'])->name('front.magic');
Route::post('magic/login/generate',[FrontController::class,'magic_generate'])->name('front.magic.generate');
Route::get('magic/login/code/{code}',[FrontController::class,'login_code'])->name('front.login.code');

//Configs
Route::middleware('auth')->prefix('admin/configs')->group(function () {
    Route::get('callback', [ConfigController::class, 'callback'])->name('config.callback');
    Route::get('webhook', [ConfigController::class, 'webhook'])->name('config.webhook');
    Route::get('finish', [ConfigController::class, 'finish'])->name('config.finish');
    Route::get('connect', [ConfigController::class, 'connect'])->name('config.connect');
    Route::get('renew', [ConfigController::class, 'renewToken'])->name('config.renewtoken');
    Route::get('authorization', [ConfigController::class, 'getAuthorizationCode'])->name('config.authorization');
});