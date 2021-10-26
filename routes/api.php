<?php

use App\Http\Controllers\api\{
    AuthController,
    CategoriesController,
    ActivityController,
    CommentController,
    UserActivityController,
    UsersController,
    DailyChallengeController,
    NewPasswordController,
    EmailVerificationController,
    LikesController,
    UploadImageController,
    UpdateProfileController,
    LeaderboardController,
    UserActivities,
};
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
//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);

Route::get('/user-activities', [UserActivityController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);

//Private routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify']);
    Route::post('change-password', [NewPasswordController::class, 'newPassword']);

    Route::resource(
        'users',
        UsersController::class,
        ['except' => ['store', 'destroy']]
    );

    Route::get('/activities', [ActivityController::class, 'index']);
    Route::get('/activities/search/{name}', [ActivityController::class, 'search']);
    Route::get('/activities/category/{category}', [ActivityController::class, 'category']);

    Route::get('/like', [LikesController::class, 'index']);
    Route::post('/like', [LikesController::class, 'like']);
    Route::post('/unlike', [LikesController::class, 'unlike']);

    Route::resource(
        'comments',
        CommentController::class,
        ['only' => ['store', 'destroy']]
    );

    Route::resource(
        'user-activities',
        UserActivityController::class,
        ['except' => ['index']]
    );
    Route::get('/user-activities/category/{id}', [UserActivityController::class, 'category']);
    Route::get('/user-activities/user/{id}', [UserActivityController::class, 'user']);
    Route::get('/user-activities/search/{name}', [UserActivityController::class, 'search']);
    Route::get('/user-activities/date/{date}', [UserActivityController::class, 'date']);
    Route::get('/user-activities/sort/{type}', [UserActivityController::class, 'sort']);
    Route::post('/AddUserActivity', [UserActivityController::class, 'AddUserActivity']);
    Route::delete('/user-activities', [UserActivityController::class, 'destroy']);
 

    Route::get('/daily-challenges', [DailyChallengeController::class, 'index']);
    Route::get('/daily-challenges/search/{name}', [DailyChallengeController::class, 'search']);
    Route::get('/daily-challenges/sort/{type}', [DailyChallengeController::class, 'sort']);
    Route::get('/daily-challenge', [DailyChallengeController::class, 'date']);

    Route::post('/image', [UploadImageController::class, 'store']);
    Route::post('/uploadBase64', [UploadImageController::class, 'uploadBase64']);
    Route::post('/update-profile', [UpdateProfileController::class, 'ProfileUpdate']);

    Route::get('/leaderboard', [LeaderboardController::class, 'index']);
    Route::get('/UserActivities', [UserActivities::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
