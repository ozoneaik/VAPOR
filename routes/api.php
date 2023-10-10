<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/TestAPI', function () {
    return [
        [
            'id' => '123445',
            'name' => 'Phuwadech Panichayasopa',
        ],
        [
            'id' => '678910',
            'name' => 'John Doe',
        ],
        [
            'id' => '111214',
            'name' => 'Jane Smith',
        ],
    ];
});
