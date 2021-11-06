<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\ContratController;

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

Route::get("/contrats/{id}/suivis/new", function ($id) {
    $controller = new SuiviController();
    return view("suivi-add-form", [
        'rubriques' => $controller->getAllRubriquesWithCriteres(),
        'niveaux' => $controller->getAllNiveaux(),
        'idContrat' => $id
    ]);
})->name('add-suivi');

Route::post('/contrats/{idContrat}/suivis/new', [SuiviController::class, 'getSuiviPosted'])->name('add-suivi-post');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
