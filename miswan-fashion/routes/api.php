<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Miswan Fashion Laravel API is active',
        'timestamp' => now()->toIso8601String()
    ]);
});
