<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use App\Models\Niveau;
use App\Models\Rubrique;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class SuiviController extends Controller
{

  public function getSuiviPosted(Request $request, int $idContrat){
    if(count($request->all()) > 1){
      $rubriques = $this->getAllRubriquesWithCriteres();
      $niveaux = $this->getAllNiveaux();
      $suivi = new Suivi();
      $suivi->idContrat = $idContrat;
      $suivi->dateS = new \DateTime();
      $suivi->commentaire = $request["suivi-comment"] ? $request["suivi-comment"] : null;
      $suivi->statut = "Pending";
      $suivi->save();
      $suiviComplet = true;
      foreach ($rubriques as $rubrique){
        foreach($rubrique->criteres()->get() as $critere){
          $evaluated = false;
          foreach($niveaux as $niveau){
            if($request[$rubrique->id."-".$critere->id."-".$niveau->id]){
              $evaluated = true;
              $evaluation = new Evaluation();
              $evaluation->idCritere = $critere->id;
              $evaluation->idNiveau = $niveau->id;
              $evaluation->idSuivi = $suivi->id;
              $evaluation->sens = 0;
              $evaluation->commentaire = $request[$rubrique->id . "-" . $critere->id . "-comment"]
                                        ? $request[$rubrique->id . "-" . $critere->id . "-comment"]
                                        : "" ;
              $evaluation->save();
            }
          }
          if(!$evaluated && $suiviComplet) $suiviComplet = false;
        }
      }
      if($suiviComplet){
        $suivi->statut = "OK";
        $suivi->update();
      }
    }
    return redirect()->route('contrats-details', ["id"=>$idContrat]);
  }

  public function getAllRubriquesWithCriteres(): Collection
  {
    return Rubrique::all();
  }

  public function getAllNiveaux(): Collection
  {
    return Niveau::all();
  }
}