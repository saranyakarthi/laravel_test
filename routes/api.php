<?php
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{id}', [RecipeController::class, 'show']);

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
//Protected routes-Only authenticated users can have access to protected routes//
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/recipes', [RecipeController::class,'store']);
    Route::put('/recipes/{id}', [RecipeController::class,'update']);
    Route::delete('/recipes/{id}', [RecipeController::class,'destroy']);
});





