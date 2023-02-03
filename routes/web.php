<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;

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
    return view('welcome');
});

// Create routes to create, edit, delete, and view contacts
Route::get('/contacts', [ContactsController::class, 'index']);
Route::get('/contacts/create', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);
Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit']);
Route::put('/contacts/{contact}', [ContactsController::class, 'update']);
Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);
Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
