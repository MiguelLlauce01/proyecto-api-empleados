<?php

use App\Http\Controllers\employeeController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\salaryController;
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
###################################################################################
#                             APIs SIN TOKEN
###################################################################################
//Route::post('/login', [LoginApiController::class, 'login']);
//Route::post("/register", [LoginApiController::class, "register"]);
###################################################################################
#                             APIs CON TOKEN
###################################################################################
Route::apiResource('role', roleController::class);

Route::middleware(['auth:api'])->group(function () {
    //AGREGAMOS UNA RUTA PARA LA TABLA: "role"
    //'role':Cómo se va a llamar la ruta dentro del dominio; 
    //Route::apiResource('role', roleController::class);//"roleController::class": nombre del controlador que manejará la ruta

    //AGREGAMOS UNA RUTA PARA LA TABLA: "employee"
    //'employee':Cómo se va a llamar la ruta dentro del dominio; 
    //Route::apiResource('employee', employeeController::class);//"employeeController::class": nombre del controlador que manejará la ruta

    //AGREGAMOS UNA RUTA PARA LA TABLA: "salary"
    //'salary':Cómo se va a llamar la ruta dentro del dominio; 
    //Route::apiResource('salary', salaryController::class);//"roleController::class": nombre del controlador que manejará la ruta

    //PARA CERRAR SESIÓN
    //Route::post("logout", [LoginApiController::class, "logout"]);

});