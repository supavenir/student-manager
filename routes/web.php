<?php

use App\Http\Controllers\UtilisateurController;
use App\Models\Utilisateur;
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
})->name('accueil');

Route::get("/users", function(){
    $controller = new UtilisateurController();
    return view("users", ['users' => $controller->findAll(), "toto"=>"<p>toto</p>"]);
});

Route::get("/users/{id}", function ($id) {
    $controller = new UtilisateurController();
    return view("user", ['user' => $controller->getById($id)]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
