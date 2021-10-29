<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontendController@index')->name('home');
Route::get('/object/{id}', 'FrontendController@object')->name('object');
Route::post('/roomsearch', 'FrontendController@roomSearch')->name('roomSearch');
Route::get('/room/{id}', 'FrontendController@room')->name('room');
Route::get('/article/{id}', 'FrontendController@article')->name('article');
Route::get('/person/{id}', 'FrontendController@person')->name('person');

Route::get('/searchCities', 'FrontendController@searchCities');
Route::get('/ajaxGetRoomReservations/{id}', [\App\Http\Controllers\FrontendController::class, 'ajaxGetRoomReservations']);
Route::get('/like/{likeable_id}/{type}', 'FrontendController@like')->name('like');
Route::get('/unlike/{likeable_id}/{type}', 'FrontendController@unlike')->name('unlike');
Route::post('addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment');
Route::post('makeReservation/{room_id}/{city_id}', 'FrontendController@makeReservation')->name('makeReservation');
Route::group(
    ['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'BackendController@index')->name('adminHome');
    Route::get('/myObjects', 'BackendController@myobjects')->name('myObjects');
    Route::match(['GET', 'POST'], '/saveobject/{id?}', 'BackendController@saveobject')->name('saveObject');
    Route::match(['GET', 'POST'], '/profile', 'BackendController@profile')->name('profile');
    Route::get('/saveroom', 'BackendController@saveroom')->name('saveRoom');
    Route::get('/deletePhoto/{id}', 'BackendController@deletePhoto')->name('deletePhoto');

    Route::get('/ajaxGetReservationData', 'BackendController@ajaxGetReservationData')->name('ajaxGetReservationData');
    Route::get('/confirmReservation/{id}', 'BackendController@confirmResLink')->name('confirmReservation');
    Route::get('/deleteReservation/{id}', 'BackendController@deleteResLink')->name('deleteReservation');
    Route::resource('cities', 'CityController');
}
);
Auth::routes();

