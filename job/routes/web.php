<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//All Listings
Route::get('/', [ListingController::class,'index']);

//Show Create Form
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

//Store Listing data
Route::post('/listings', [ListingController::class,'store'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

//Update Listing
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

//Manage Listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

//Single Listing
Route::get('/listings/{listing}', [ListingController::class,'show'])->name('listings.show');

//Show Register/Create Form
Route::get('/register',[UserController::class,'create'])->name('create');

//Create New User
Route::post('/users',[UserController::class,'store'])->name('store');

//Log User Out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//Show Login Form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//LogIn User
Route::post('/users/authenticate',[UserController::class,'authenticate']);

Route::post('/applications', [JobApplicationController::class, 'store'])->name('applications.store');
