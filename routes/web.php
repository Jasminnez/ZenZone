<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    ProfileController,
    UserActivityController,
    DailyChallengeController,
    ActivityController,
    CategoryController,
    UploadImageController,
    DashboardController
};
use Inertia\Inertia;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return redirect('login');
});
Route::get('/successfullPassword', function(){
    return Inertia::render('successfullPassword');
})->name('successfullPassword');

Route::resource("/uploadimage", UploadImageController::class);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::resource("/profile", ProfileController::class);

    Route::group(
        [
            'prefix'     => '',
            'middleware' => [
                'auth',
                'rodjo',
            ],
        ],
        function () {

            Route::resource("/daily-challenges",  DailyChallengeController::class);

            Route::get("/add-challenge",  function () {
                return Inertia::render('AddChallenge');
            })->name('AddChallenge');

        }
    );

    Route::group(
        [
            'prefix'     => '',
            'middleware' => [
                'auth',
                'admin',
            ],
        ],
        function () {

            Route::resource('/dashboard', DashboardController::class);

            Route::resource("/users",  UserController::class);

            Route::resource("/user-activities", UserActivityController::class);

            Route::resource("/activities", ActivityController::class);

            Route::resource("/categories", CategoryController::class);
        }
    );
});
