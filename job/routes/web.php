<?php
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Middleware group for authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->name('register.create')->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/login', [UserController::class, 'authenticate']);

// Show the apply form
Route::get('/listings/{listing}/apply', [JobApplicationController::class, 'apply'])->name('listings.apply')->middleware('auth');

// Store the application
Route::post('/applications', [JobApplicationController::class, 'store'])->name('applications.store');

// Disable default password reset routes and define custom ones
Auth::routes(['register' => true, 'reset' => true, 'confirm' => false]);


// Custom Password Reset Routes
// Custom Password Confirmation Routes
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm.custom');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');


Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request.custom');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email.custom');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.custom');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update.custom');

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Auth registration and login routes
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('auth.register');
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('auth.register.post');

Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.login');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.login.post');

Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.logout');
