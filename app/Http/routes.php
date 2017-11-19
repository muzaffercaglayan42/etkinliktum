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

use App\Etkinlik;
use Illuminate\Http\Request;
Route::get('/etkinlikapi/{kartno}', 'EtkinlikController@etkinlikBilgi');
Route::auth();
//Route::get('/home', 'EtkinlikController@highchart');
Route::get('/register',function(){
	return redirect('/login');
});

//Route::get('/home', 'HomeController@index');

	Route::group(['middleware' => ['web']], function () {

    Route::get('/etkinlikekle', 'EtkinlikController@index');

    Route::get('/dersekle', 'EtkinlikController@DersIndex');

    Route::post('/dersekle', 'EtkinlikController@DersIndex');

    Route::get('/userekle', 'EtkinlikController@UserIndex');

    Route::get('/drs','EtkinlikController@DersEkle');

    Route::post('/drs','EtkinlikController@DersEkle');

    Route::get('/etkn','EtkinlikController@EtkinlikEkle');

    Route::post('/etkn','EtkinlikController@EtkinlikEkle');

    Route::get('/usr','EtkinlikController@UserEkle');

    Route::post('/usr','EtkinlikController@UserEkle');

    Route::post('/etkinlikekle','EtkinlikController@index');

      Route::post('/userekle','EtkinlikController@UserIndex');

    Route::get('/etkinliklistele','EtkinlikController@EtkinlikListe');

    Route::post('/etkinliklistele','EtkinlikController@EtkinlikListe');

    Route::get('/etkinlikdurumlistele','EtkinlikController@EtkinlikDurumListe');

    Route::post('/etkinlikdurumlistele','EtkinlikController@EtkinlikDurumListe');

    Route::get('/derslistele','EtkinlikController@DersListe');

    Route::post('/derslistele','EtkinlikController@DersListe');

    Route::get('/userlistele','EtkinlikController@UserListe');

    Route::post('/userlistele','EtkinlikController@UserListe');

    Route::delete('/etkn/sil/{id}', 'EtkinlikController@EtkinlikSil');

    Route::delete('/drs/sil/{id}', 'EtkinlikController@DersSil');

    Route::post('/etkn/duzelt/{id}', 'EtkinlikController@EtkinlikDuzelt');

    Route::post('/drs/duzelt/{id}', 'EtkinlikController@DersDuzelt');

    Route::delete('/usr/sil/{id}', 'EtkinlikController@UserSil');

    Route::post('/usr/duzelt/{id}', 'EtkinlikController@UserDuzelt');

    Route::get('/search/{id}', 'EtkinlikController@search');

    Route::get('/', 'EtkinlikController@index');
	
	Route::controller('/', 'EtkinlikController');
}
);


