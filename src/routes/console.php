<?php

use App\Http\Route;
use Src\App\Console\DataController;

Route::console('data:seed', DataController::class, 'seed');
