<?php

use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth', 'web'])->group(function () {
    Route::get('/', fn () => view('admin.dashboard'));
    Route::get('/dashboard', fn () => view('admin.dashboard'));

    Route::get('/profile', App\Http\Controllers\Admin\ProfileController::class)->name('profile');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RoleAndPermissionController::class);
    Route::resource('standers', App\Http\Controllers\Admin\StanderController::class);
    Route::resource('rates', App\Http\Controllers\Admin\RateController::class);
    Route::resource('points', App\Http\Controllers\Admin\PointController::class);
    Route::resource('comments', App\Http\Controllers\Admin\CommentController::class);
});


Route::get('/', function () {
    return view('welcome');
})->middleware('guest');


Route::get('/home', [HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/u/{username}', [UserController::class, 'userProfile'])->name('userProfile');

Route::get('/u/{username}/rate', [RateController::class, 'create'])->name('rateForm');
Route::get('/rate/{id}', [RateController::class, 'show'])->name('rateShow');



Route::group(['middleware' => ['auth']], function () { 
    Route::post('/storerate', [RateController::class, 'store'])->name('storeRate');
    // Route::get('/notifications', [NotificationController::class, 'index'])->name('getNotification');
    // Route::post('/notescount', [NotificationController::class, 'count'])->name('getNotificationCount');
    // Route::post('/whois', [NotificationController::class, 'whois'])->name('whois');
    // Route::post('/approve-whois', [NotificationController::class, 'approvewhois'])->name('approvewhois');
    // Route::post('/cancel-whois', [NotificationController::class, 'cancelwhois'])->name('cancelwhois');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('editProfile');
    Route::post('/edit-profile', [UserController::class, 'storeProfile'])->name('editProfile');

    

});


Route::get('login/{provider}', [SocialController::class, 'redirect']);
Route::get('login/facebook/callback',[SocialController::class, 'Callback']);

Route::get('/search', [UserController::class, 'search'])->name('searchForm');
Route::get('login/twitter/callback', [SocialController::class, 'TwitterCallback']);
