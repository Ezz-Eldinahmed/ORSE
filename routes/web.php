<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\web\Certify\CertificationWebController;
use App\Http\Controllers\web\Learn\CategoryWebController;
use App\Http\Controllers\web\Learn\CourseWebController;
use App\Http\Controllers\web\Learn\LessonWebController;
use App\Http\Controllers\web\Learn\QuestionWebController;
use App\Http\Controllers\web\Learn\VideoWebController;
use App\Http\Controllers\web\Mange\AdminController;
use App\Http\Controllers\web\Mange\ApproveInstructorController;
use App\Http\Controllers\web\Mange\InstructorWebController;
use App\Http\Controllers\web\Mange\InterviewerWebController;
use App\Http\Controllers\web\Mange\ResumeController;
use App\Http\Controllers\web\Certify\ExamWebController;
use App\Http\Controllers\web\Learn\JoinCourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->group(function () {
    Route::get('facebook', [LoginController::class, 'redirectToProvider']);
    Route::get('facebook/callback', [LoginController::class, 'handleProviderCallback']);
    Route::get('google', [LoginController::class, 'GoogleRedirect']);
    Route::get('google/callback', [LoginController::class, 'GoogleRedirectCallback']);
});

Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('question', [QuestionWebController::class, 'index'])->name('question.index');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('category/{category}/show', [CategoryWebController::class, 'show'])->name('category.show');
Route::get('category', [CategoryWebController::class, 'index'])->name('category.index');
Route::get('course', [CourseWebController::class, 'index'])->name('course.index');
Route::get('course/{course}', [CourseWebController::class, 'show'])->name('course.show')->middleware('courseApproved');
Route::get('lesson/{lesson}', [LessonWebController::class, 'show'])->name('lesson.show');
Route::resource('question', QuestionWebController::class)->only(['show', 'index']);

Route::middleware(['auth', 'blocked'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        Route::delete('contact/{contact}', [ContactController::class, 'destory'])->name('contact.destroy');
        Route::post('category', [CategoryWebController::class, 'store'])->name('category.store');
        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('admin/{user}', [AdminController::class, 'show'])->name('admin.show');
        Route::post('interviewer/{user}/make', [InterviewerWebController::class, 'store'])->name('store.interviewer');
        Route::resource('interviewer', InterviewerWebController::class, ['except' => ['store']]);
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('interviewer/{interviewer}/{category}/approve', [InterviewerWebController::class, 'approve'])->name('interviewer.approve');
        Route::delete('interviewer_category/{interviewer}/{category}', [InterviewerWebController::class, 'destroyCategory'])->name('interviewer_category.destroy');
    });

    Route::prefix('course')->group(function () {
        Route::post('{course}/join', [JoinCourseController::class, 'join'])->name('course.join');
        Route::post('{course}/payment', [JoinCourseController::class, 'store'])->name('payment.store');
        Route::get('list/course', [CourseWebController::class, 'all'])->name('course.list')->middleware(['interviwer']);
    });

    Route::prefix('instructor')->group(function () {
        Route::get('', [InstructorWebController::class, 'index'])->name('instructor.index')->middleware(['interviwer']);
        Route::post('{instructor}/{category}', [ApproveInstructorController::class, 'store'])->name('instructor.approve')->middleware(['interviwer']);
        Route::get('{instructor}/{category}/resume', [ResumeController::class, 'show'])->name('resume.show');
    });

    Route::middleware(['instructor'])->group(function () {
        Route::post('video/{lesson}', [VideoWebController::class, 'store'])->name('video.store');
        Route::post('course/{category}', [CourseWebController::class, 'store'])->name('course.store');
        Route::post('lesson/{course}', [LessonWebController::class, 'store'])->name('lesson.store');
        Route::resource('exam', ExamWebController::class, ['except' => ['show', 'store', 'create']]);
        Route::post('exam/{course}', [ExamWebController::class, 'store'])->name('exam.store');
        Route::get('exam/{exam}', [ExamWebController::class, 'show'])->name('exam.show');
    });

    Route::get('instructor/create', [InstructorWebController::class, 'create'])->name('instructor.create');
    Route::post('instructor', [InstructorWebController::class, 'store'])->name('instructor.store');
    Route::delete('instructor_category/{instructor}/{category}', [InstructorWebController::class, 'destroyCategory'])->name('instructor_category.destroy')->middleware(['interviwer']);
    Route::delete('instructor/{instructor}', [InstructorWebController::class, 'destroy'])->name('instructor.destroy')->middleware(['interviwer']);
    Route::resource('instructor', InstructorWebController::class)->only(['show', 'destroy'])->middleware(['interviwer']);
    Route::get('instructor/{instructor}', [InstructorWebController::class, 'show'])->name('instructor.show');

    Route::get('exam/{exam}/take', [ExamWebController::class, 'take'])->name('exam.take')->middleware('coursePurchase');
    Route::post('exam/{exam}/submit-answer', [CertificationWebController::class, 'store'])->name('exam.submit');
    Route::view('recommendation', 'recommendation')->name('recommendation');
    Route::get('notification', [NotificationsController::class, 'show'])->name('notification.show');
    Route::get('video/{video}', [VideoWebController::class, 'show'])->name('video.show')->middleware('coursePurchase');
    Route::get('certification/{certification}', [CertificationWebController::class, 'show'])->name('certification.show');

    Route::view('timeline', 'timeline')->name('timeline');

    Route::get('profile/{user}', [HomeController::class, 'profile'])->name('profile');
    Route::view('people', 'people')->name('people');

    Route::post('recommendation', [RecommendationController::class, 'store']);
});
