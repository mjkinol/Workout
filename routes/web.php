<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('home');

// set up the about page
Route::get('/about', 'AboutController@index');

// register a new user
Route::get('/signup', 'RegistrationController@showRegistrationForm');
Route::post('/signup', 'RegistrationController@register');

// log the player out
Route::get('/logout', 'LogoutController');

// log the player in
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@login');

// activities routes
Route::get('/activities', 'ActivitiesController@index')->name('activities');
Route::get('/activities/{id}/thread', 'ActivitiesController@discussion');

// workouts route
Route::get('/workouts', 'WorkoutsController@index')->name('workouts');
Route::get('/workouts/{id}/info', 'WorkoutsController@show')->name('workout');

// prevent guests from certain actions
Route::middleware(['auth'])->group(function () {
	// show the users profile info 
	Route::get('/profile', 'ProfileController@index');
	Route::get('/profile/{id}', 'ProfileController@user_profile');

	// protected activities routes
	Route::post('/activities', 'ActivitiesController@store');
	Route::get('/activities/new', 'ActivitiesController@create');
	Route::post('/activities/{id}/like', 'ActivitiesController@like');
	Route::post('/activities/{id}/dislike', 'ActivitiesController@dislike');

	// protected workout routes
	Route::post('/workouts/{id}/like', 'WorkoutsController@like');
	Route::post('/workouts/{id}/dislike', 'WorkoutsController@dislike');
	Route::post('/workouts', 'WorkoutsController@store');
	Route::get('/workouts/new', 'WorkoutsController@create');
	Route::get('/workouts/{id}/edit', 'WorkoutsController@edit');
	Route::post('/workouts/{id}/edit', 'WorkoutsController@update');
	Route::get('/workouts/{id}/delete', 'WorkoutsController@showDeleteConfirmation');
	Route::post('/workouts/{id}/delete', 'WorkoutsController@delete');
	Route::get('/workouts/{id}/favorite', 'WorkoutsController@showFavoriteConfirmation');
	Route::get('/workouts/{id}/unfavorite', 'WorkoutsController@showUnfavoriteConfirmation');
	Route::post('/workouts/{id}/favorite', 'WorkoutsController@favorite');
	Route::post('/workouts/{id}/unfavorite', 'WorkoutsController@unfavorite');
	Route::get('/workouts/favorites', 'WorkoutsController@favWorkoutsIndex')->name('favWorkouts');
	Route::get('/workouts/myworkouts', 'WorkoutsController@myworkoutsIndex')->name('myworkouts');

	// user routes
	Route::get('/users', 'UsersController@index')->name('users');
	Route::get('/users/{id}/subscribe', 'UsersController@showSubscribeConfirmation');
	Route::get('/users/{id}/unsubscribe', 'UsersController@showUnsubscribeConfirmation');
	Route::post('/users/{id}/subscribe', 'UsersController@subscribe');
	Route::post('/users/{id}/unsubscribe', 'UsersController@unsubscribe');

	// following page routes
	Route::get('/following', 'FollowingController@index');

	// subscribers page routes
	Route::get('/subscribers', 'SubscribersController@index');
});


