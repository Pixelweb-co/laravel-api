<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ValidationCtrl;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/demo',function(Request $request){

    return 'hola mundo';

});

Route::post('/validate', [ValidationCtrl::class, 'validateRequest']);

