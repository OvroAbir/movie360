<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('homepage');
});
*/
Route::get('/', 'HomePageController@getHomePageInfos');

Route::auth();

Route::get('/searchpage', function() {
	return view('searchpage');
});

Route::get('/movies', 'MoviePageController@getAllMovies');
Route::post('/searchMovie', 'SearchMovieController@searchMovie');
Route::post('/movies/{movie_id}/add_coment', 'MoviePageController@addComment');
Route::get('/movies/{movie_id}', 'MoviePageController@getMovie');
Route::get('/home', 'HomeController@index');

Route::get('/actors/{actor_id}', 'ActorPageController@getActor');
Route::get('/actors', 'ActorPageController@getAllActor');

Route::get('/edit', 'EditDatabaseController@getChoicePage');
Route::get('/edit/add/movie', 'EditDatabaseController@getInsertMoviePage');
Route::post('/edit/add/movie/blah', 'EditDatabaseController@insertMovie');
Route::get('/edit/addactorinmovie', 'EditDatabaseController@getInsertActorInMoviePage');
Route::post('/edit/addactorinmovie', 'EditDatabaseController@insertActorInMovie');
Route::get('/edit/add/actor', 'EditDatabaseController@getInsertActorPage');
Route::post('/edit/add/actor', 'EditDatabaseController@insertActor');
Route::get('/edit/add/director', 'EditDatabaseController@getInsertDirectorPage');
Route::get('/edit/add/production_house', 'EditDatabaseController@getInsertProdPage');
Route::post('/edit/add/dirprod', 'EditDatabaseController@insertDirectorProd');

Route::get('/edit/delete/{object}', 'EditDatabaseController@getDeletePage');
Route::post('/edit/delete/{object}', 'EditDatabaseController@deleteObject');

Route::get('/edit/update/movie/{movie_id}', 'EditDatabaseController@getUpdateMoviePage');
Route::get('/edit/update/movie', 'EditDatabaseController@getUpdateMoviePageList');
Route::post('/edit/update/movie', 'EditDatabaseController@updateMovie');

Route::get('/edit/reporting', 'ReportController@getMpdf');
Route::get('/edit/upgradeuser', 'EditDatabaseController@getUpgradeUserPage');
Route::post('/edit/upgradeuser', 'EditDatabaseController@upgradeUser');\

Route::get('/directors', 'EditDatabaseController@getDirList');
Route::get('/producers', 'EditDatabaseController@getProdList');
