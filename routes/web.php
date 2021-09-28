<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\FrequentlyQuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth admin


    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    });
//Auth user
Route::get('/employee/register', [RegisteredUserController::class, 'create'])->name('employee.register');

Route::get('/candidate/register', [RegisteredUserController::class, 'create'])->name('candidate.register');

Route::post('/employee/register', [RegisteredUserController::class, 'store'])->name('employee.register');

Route::post('/candidate/register', [RegisteredUserController::class, 'store'])->name('candidate.register');

//User
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us');

Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::resource('/jobs', JobController::class);

Route::post('jobs/search', [JobController::class, 'searchForJob'])->name('jobs.search');

Route::get('employee/frequently-questions/index-ajax', [FrequentlyQuestionController::class, 'indexAjax'])->name('frequently-questions.index.ajax');

Route::resource('testimonies', TestimonyController::class);

//Home Ajax
Route::get('/home/careers', [HomeController::class, 'careerIndex'])->name('home.careers');

Route::get('/home/services', [HomeController::class, 'serviceIndex'])->name('home.services');



Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {

        //Admin
        Route::prefix('admin')->name('admin.')->group(function () {

            Route::resource('services', ServiceController::class);
            Route::resource('frequently-questions', FrequentlyQuestionController::class);
            Route::resource('team', TeamController::class);
            Route::resource('settings', SettingController::class, ['only' => ['edit', 'update']]);
        });

        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    Route::middleware('role:employee')->group(function () {

        //Employee
        Route::resource('employee/profile', EmployeeProfileController::class, ['as' => 'employee']);

        Route::get('employee/posts', [EmployeeProfileController::class, 'indexPost'])->name('employee.posts');

        Route::get('employee/browse-candidates', [EmployeeProfileController::class, 'browseCandidates'])->name('employee.browse-candidates');

        Route::get('employee/request-action/{job_id}/{status}', [EmployeeProfileController::class, 'requestAction'])->name('employee.request-action');

        Route::get('employee/job-requests', [EmployeeProfileController::class, 'jobRequestIndex'])->name('employee.job-request.index');
    });

    Route::middleware('role:candidate')->group(function () {

        //Job
        Route::post('job/request', [JobController::class, 'jobRequest'])->name('job.request');

        Route::post('job/cancel-request', [JobController::class, 'jobCancelRequest'])->name('job.cancel-request');


        //Candidate
        Route::resource('candidate/profile', CandidateProfileController::class, ['as' => 'candidate']);

        Route::get('candidate/job-requests', [CandidateProfileController::class, 'jobRequestIndex'])->name('candidate.job-request.index');
    });


});

