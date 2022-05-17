<?php
USE \App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\MailController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//

//AUTHENTIFICATION

    Route::post('/login' , [LoginController::class , 'login']);
Route::post('/forgot' , [LoginController::class , 'recoverPassword']);
    Route::post('/register' , [\App\Http\Controllers\api\v1\RegisterController::class , 'register']);


// Users

Route::middleware('auth:api')->group( function (){

    Route::prefix('users')->group(function(){
        Route::get('all' , [\App\Http\Controllers\api\v1\UserController::class , 'index']);

    });

    // DOCUMENT ROUTES

    Route::post('document' , [\App\Http\Controllers\api\v1\DocumentController::class , 'store']);
    Route::get('documentByUser' , [\App\Http\Controllers\api\v1\DocumentController::class , 'getDocumentsByUser']);
    Route::get('documentByProject' , [\App\Http\Controllers\api\v1\DocumentController::class , 'getDocumentByProject']);
    Route::post('documentDelete' , [\App\Http\Controllers\api\v1\DocumentController::class , 'deleteDocument']);
    Route::post('documentsDelete' , [\App\Http\Controllers\api\v1\DocumentController::class , 'deleteDocuments']);

    // PROJECT ROUTE

    Route::post('project' , [\App\Http\Controllers\api\v1\ProjectController::class , 'addProject']);
    Route::post('projectUpdate' , [\App\Http\Controllers\api\v1\ProjectController::class , 'updateProject']);
    Route::post('projectDelete' , [\App\Http\Controllers\api\v1\ProjectController::class , 'deleteProject']);
    Route::get('project' , [\App\Http\Controllers\api\v1\ProjectController::class , 'getProjectById']);
    Route::get('projectUser/{id}' , [\App\Http\Controllers\api\v1\ProjectController::class , 'getProjectByUser']);

});

Route::get('send-mail', [MailController::class, 'index']);
