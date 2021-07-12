<?php

use App\Http\Controllers\api\ApproveCourse;
use App\Http\Controllers\api\BestReplyController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CertificationController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\ExamController;
use App\Http\Controllers\api\InstructorController;
use App\Http\Controllers\api\InterviewerController;
use App\Http\Controllers\api\LessonController;
use App\Http\Controllers\api\QuestionController;
use App\Http\Controllers\api\RateController;
use App\Http\Controllers\api\ReplyController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\VideoController;
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

Route::post('register', [UserController::class, 'register'])->name('api.register');
Route::post('login', [UserController::class, 'login'])->name('api.login');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('api.logout');

    Route::get('profile/{user}', [UserController::class, 'profile']);

    Route::post('courses/{course}/approve', [ApproveCourse::class, 'store'])->middleware(['interviwer']);

    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    Route::apiResource('categories', CategoryController::class, ['except' => ['index', 'show']])->middleware('admin');

    Route::apiResource('courses', CourseController::class);

    Route::get('exam/{exam}', [ExamController::class, 'show']);

    Route::get('certifications/{certification}', [CertificationController::class, 'show']);

    Route::post('exams/{exam}/submit-exams', [CertificationController::class, 'store']);

    Route::post('rate/{course}', [RateController::class, 'store']);

    Route::post('course/comment/{course}', [CommentController::class, 'course']);

    Route::post('video/comment/{video}', [CommentController::class, 'video']);

    Route::post('lesson/comment/{lesson}', [CommentController::class, 'lesson']);

    Route::delete('comment/{comment}', [CommentController::class, 'destroy']);

    Route::apiResource('instructors', InstructorController::class, ['except' => ['update']]);

    Route::post('best-reply/{reply}', [BestReplyController::class, 'store']);

    Route::apiResource('questions', QuestionController::class);

    Route::apiResource('replys', ReplyController::class, ['except' => ['index', 'show']]);

    Route::apiResource('lessons', LessonController::class, ['except' => ['index']]);

    Route::apiResource('interviews', InterviewerController::class, ['except' => ['update']]);

    Route::apiResource('videos', VideoController::class, ['except' => ['index']]);
});
