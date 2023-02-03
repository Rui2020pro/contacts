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
    // redirect to contacts list
    return redirect()->route('contacts.index');
});

// Create routes to create, edit, delete, and view contacts
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create'); 
Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact}', [ContactsController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
Route::get('/contacts/{contact}', [ContactsController::class, 'show'])->name('contacts.show');
