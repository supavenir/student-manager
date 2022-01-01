<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller {

  public function setAffectationProfesseurToContrats(Request $request)
  {
    $contrats = explode("-", $request->get('contrats-choosen'));
    foreach ($contrats as $contratId){
      if($contratId != null){
        $contrat = Contrat::where('id', $contratId)->first();

        $contrat->update([
          'idProfesseur' => $request->get('select-professeur')
        ]);
      }
    }
    return redirect()->route('affectation-professeur-etudiant');
  }
}