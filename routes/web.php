<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('website.index');
});

Route::middleware('verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', 'UserController');
    Route::resource('cities', 'CityController');
    Route::resource('services', 'ServiceController');
    Route::resource('inquiries', 'InquiryController');
    Route::resource('opinions', 'OpinionController');
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');

    Route::get('/customer_opinions', [ProfileController::class, 'customer_opinions'])->name('customer_opinions');
    Route::get('/customer_opinions/{id}', [ProfileController::class, 'customer_opinion'])->name('customer_opinion');

    Route::get('/customer_inquiries', [ProfileController::class, 'customer_inquiries'])->name('customer_inquiries');
    Route::get('/customer_inquiries/{id}', [ProfileController::class, 'customer_inquiry'])->name('customer_inquiry');

    Route::get('/petsitter_opinions', [ProfileController::class, 'petsitter_opinions'])->name('petsitter_opinions');
    Route::get('/petsitter_opinions/{id}', [ProfileController::class, 'petsitter_opinion'])->name('petsitter_opinion');

    Route::get('/petsitter_inquiries', [ProfileController::class, 'petsitter_inquiries'])->name('petsitter_inquiries');
    Route::get('/petsitter_inquiries/{id}', [ProfileController::class, 'petsitter_inquiry'])->name('petsitter_inquiry');

    Route::get('/petsitter_inquiries/{id}/answer', [ProfileController::class, 'answer_to_inquiry'])->name('answer_to_inquiry');
    Route::patch('/send_answer/{id}', [ProfileController::class, 'send_answer'])->name('send_answer');
});

Route::get('/search', 'WebsiteController@search')->name('website.search');
Route::post('/search_results', 'WebsiteController@search_results')->name('website.search_results');
Route::get('/show_profile/{id}', 'WebsiteController@show_profile')->name('website.show_profile');
Route::post('/create_inquiry', 'WebsiteController@create_inquiry')->name('website.create_inquiry');
Route::get('/add_opinion/{id}', 'WebsiteController@add_opinion')->name('website.add_opinion');

Route::post('/create_opinion', 'WebsiteController@create_opinion')->name('website.create_opinion');

require __DIR__.'/auth.php';