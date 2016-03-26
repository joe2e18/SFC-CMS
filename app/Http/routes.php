<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('joe/{order_id}/{other_id}', 'RostersController@specific');
    Route::get('/', [
        'as' => 'home',
        'uses' => 'PagesController@home'
    ]);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//Route::get('rosters/{sport_id}/edit/{id}', 'RostersController@loadModal');


Route::group(['middleware' => ['auth']], function () {
    Route::get('rosters/{sport_id}/filter/{level_id}', 'RostersController@filter');
    Route::post('rosters/{sport_id}', 'RostersController@update');
    Route::put('rosters/{sport_id}', 'RostersController@show');
    Route::resource('rosters', 'RostersController');



    Route::put('games/{sport_id}', 'GamesController@show_games');
    Route::put('games/{sport_id}/filter/{level_id}', 'GamesController@show_games_filter');
    Route::post('games/{sport_id}', 'GamesController@update');

    Route::get('games/{sport_id}', 'GamesController@show');
    Route::get('games/{sport_id}/filter/{level_id}', 'GamesController@filter');
    Route::resource('games', 'GamesController');

    Route::get('schools/', 'SchoolsController@show');
    Route::resource('schools', 'SchoolsController');

    Route::post('news/{sport_id}', 'NewsController@update');
    Route::get('news/{sport_id}', 'NewsController@show');
    Route::resource('news', 'NewsController');

    Route::resource('locations', 'LocationsController');

    Route::get('sport/api/{sport_id}', 'RostersController@getPositions');
    //
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
