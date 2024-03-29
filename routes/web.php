<?php

use App\Http\Controllers\TestMailingController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/client', function () {
    return view('rest.client');
})->name('client');
Route::get('/vanilla',  function () {
    return view('vanilla.explorer');
})->name('vanilla');
Route::get('/mail', [TestMailingController::class, 'form'])->name('mail');
Route::post('/sendmail', [TestMailingController::class, 'send'])->name('sendmail');



require __DIR__ . '/auth.php';
