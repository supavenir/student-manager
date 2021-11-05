<?php

use App\Http\Controllers\ContratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
})->name('accueil');

Route::get("/users", function(){
    $controller = new UserController();
    return view("users", ['users' => $controller->findAll(), "toto"=>"<p>toto</p>"]);
})->name('etudiants');

Route::get("/users/{id}", function ($id) {
    $controller = new UserController();
    return view("user", ['user' => $controller->getById($id)]);
})->name('etudiants-details');

Route::get("/contrats/{id}", function ($id) {
    $controller = new ContratController();
    return view("contrat", ['contrat' => $controller->getById($id)]);
})->name('contrats-details');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
