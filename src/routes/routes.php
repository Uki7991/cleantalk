<?php

use App\Http\Route;
use Src\App\Console\DataController;
use Src\App\Http\Controllers\API\EmployeeController;

Route::get('/api/employees', EmployeeController::class, 'index');
Route::get('/api/employees/([\d]+)/children', EmployeeController::class, 'getChildren');
Route::post('/api/employees', EmployeeController::class, 'store');
Route::put('/api/employees/([\d]+)', EmployeeController::class, 'update');
Route::delete('/api/employees/([\d]+)', EmployeeController::class, 'destroy');
Route::get('/api/employees/search', EmployeeController::class, 'search');

