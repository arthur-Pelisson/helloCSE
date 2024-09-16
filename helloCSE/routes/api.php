<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// route de test pour l'application helloCSE pour savoir si l'pplication run correctement
Route::get('/test', function () {
    return response()->json(['test'=>'ok'], 200);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
