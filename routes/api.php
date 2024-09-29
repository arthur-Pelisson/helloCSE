<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfilController;

// route de test pour l'application helloCSE pour savoir si l'application run correctement
Route::get('/test', function () {
    return response()->json(['test'=>'ok'], 200);
});

// prefixe pour les routes d'authentification
Route::prefix('auth')->group(function () {
  // route pour l'authentification des administrateurs
  Route::post('register',[AdminAuthController::class,'register']);
  Route::post('login',[AdminAuthController::class,'login']);
  Route::post('logout',[AdminAuthController::class,'logout'])
    ->middleware('auth:sanctum');
});

// route protected by sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
  // route for profil
  Route::post('profil',[ProfilController::class,'store']);
  Route::put('profil/{profil}',[ProfilController::class,'update']);
  Route::delete('profil/{profil}',[ProfilController::class,'destroy']);
  Route::get('profil/{profil}',[ProfilController::class,'show']);
});
Route::get('profil',[ProfilController::class,'index']);

// route profil not protected