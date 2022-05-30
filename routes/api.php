<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function(){

   Route::post('login', 'Auth\\LoginJwtController@login')->name('login');
   Route::get('logout', 'Auth\\LoginJwtController@logout')->name('logout');
   Route::get('refresh', 'Auth\\LoginJwtController@logout')->name('logout');

   Route::group(['middleware'=>['jwt.auth']], function(){

    Route::name('imovel')->group(function(){

        Route::resource('imovel', 'ImovelController'); #index

     });

     Route::name('usuarios')->group(function(){

         Route::resource('usuarios', 'UserController'); #index

      });

      Route::name('categoria.')->group(function(){

         Route::get('categoria/{id}/imovel', 'CategoriaController@imovel' );
         Route::resource('categoria', 'CategoriaController'); #index

      });



      Route::name('fotos.')->prefix('fotos')->group(function(){
         Route::delete('/{$id}', 'ImovelFotoControle@remove')->name('delete');
         Route::put('/set-thumb{$fotoId}/{imovelId}', 'ImovelFotoControle@setThumb')->name('delete');

       });



   });
});

