<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\ContratController;
use App\Models\Critere;
use App\Models\Rubrique;

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
    if (auth()->user() !== null){
        return view('home');
    }
    else{
        return view('auth/login');
    }
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
    $contract = \App\Models\Contrat::where('id', $id)->first();

    $eleve = \App\Models\User::where('id', $contract->idEtudiant)->first();
    return view("suivi-add-form", [
        'rubriques' => $controller->getAllRubriquesWithCriteres(),
        'niveaux' => $controller->getAllNiveaux(),
        'eleve' => $eleve,
        'idContrat' => $id
    ]);
})->name('add-suivi');

Route::get("/contrats/{id}/suivis/{idSuivi}/edit", function ($id, $idSuivi) {
    $controller = new SuiviController();
    $contract = \App\Models\Contrat::where('id', $id)->first();

    $eleve = \App\Models\User::where('id', $contract->idEtudiant)->first();
    return view("suivi-edit-form", [
        'rubriques' => $controller->getAllRubriquesWithCriteres(),
        'niveaux' => $controller->getAllNiveaux(),
        'idContrat' => $id,
        'eleve' => $eleve,
        'suivi' => $controller->getById($idSuivi)
    ]);
})->name('edit-suivi');

Route::get("/contrats/{idContrat}/evaluation/{idRubrique}/{idCritere}/history", function ($idContrat, $idRubrique, $idCritere) {
    return view("evaluation-history", [
        'rubrique' => Rubrique::where('id', $idRubrique)->first(),
        'critere' => Critere::where('id', $idCritere)->first(),
        'idContrat' => $idContrat
    ]);
})->name('evaluation-history');
Route::post('/contrats/{idContrat}/suivis/new', [SuiviController::class, 'addSuivi'])->name('add-suivi-post');
Route::post('/contrats/{idContrat}/suivis/{idSuivi}/edit', [SuiviController::class, 'editSuivi'])->name('edit-suivi-post');

Route::get('/api/contrats/{idContrat}/{idCritere}/history', function($idContrat, $idCritere){
    $controller = new ContratController();
    return response()->json($controller->getEvaluationHistoryToJson($idContrat, $idCritere));
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');





require __DIR__.'/auth.php';
