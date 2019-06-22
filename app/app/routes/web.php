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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/car', 'CarController@allcars');

Route::get('/car/{id}', 'CarController@particularcar');

Route::post('/car', 'CarController@newcar');

Route::post('newcar','CarController@newcar');//routes for all crud resource functions

Route::get('registerCar','CarController@registerCar');// register a new car
