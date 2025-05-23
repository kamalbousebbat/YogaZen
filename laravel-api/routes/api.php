<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\WooWebhookController;

Route::post('/woo/webhook', [WooWebhookController::class, 'handleWebhook']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('courses', CourseController::class);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
    Route::delete('/courses/{course}',[CourseController::class,'destroy']);


    Route::apiResource('teachers', TeacherController::class);
    Route::post('/teachers', [TeacherController::class, 'store']);
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
    Route::delete('/teachers/{teacher}',[TeacherController::class,'destroy']);


    Route::apiResource('students', StudentController::class);
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{student}', [StudentController::class, 'update']);
    Route::get('/students/{student}', [StudentController::class, 'show']);
    Route::delete('/students/{student}',[StudentController::class,'destroy']);


    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);
    Route::put('/subscriptions/{subscription}', [SubscriptionController::class, 'update']);
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show']);
    Route::delete('/subscriptions/{subscription}',[SubscriptionController::class,'destroy']);


// });
