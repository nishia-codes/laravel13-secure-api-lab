
<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', function (Request $request) {
        return response()->json([
            'message' => 'This is a protected route.',
            'user' => $request->user(),
        ]);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Part C: Protected routes
    Route::get('/students', function () {
        return response()->json([
            'message' => 'Students list accessed successfully.',
        ]);
    })->middleware('role:admin,student');

    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome Admin!',
        ]);
    })->middleware('admin');

    Route::get('/student/dashboard', function () {
        return response()->json([
            'message' => 'Welcome Student!',
        ]);
    })->middleware('role:student');
});

Route::get('/sample', function () {
    return response()->json([
        'message' => 'This is a sample route.',
    ]);
});

Route::get('/hello', function () {
    return response()->json([
        'message' => 'Welcome to the Laravel 13 API',
    ]);
});
