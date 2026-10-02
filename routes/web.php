<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/'.$path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
        'Access-Control-Allow-Headers' => '*',
    ]);
})->where('path', '.*');

Route::options('storage/{path}', function () {
    return response('', 204, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
        'Access-Control-Allow-Headers' => '*',
    ]);
})->where('path', '.*');
