<?php 
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\Stop_CityContorller;
use App\Http\Controllers\AuthController;

// Authantication 

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/add_Cities', [CityController::class, 'add_Cities']);
    Route::post('/add_Trips', [TripController::class, 'add_Trips']);
    Route::get('/show_trips', [TripController::class, 'show_trips']);
    Route::post('/add_Stops_Cities', [Stop_CityContorller::class, 'add_Stops_Cities']);
    Route::post('/add_buses', [BusController::class, 'add_buses']);
    Route::post('/book_seat', [BookingController::class, 'storebooking']);
    Route::get('/available_seats', [SeatController::class, 'getAvailableSeats']);
});