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
      $suivi->commentaire = "";
      $suivi->statut = "pending";
      $suivi->save();
      foreach ($rubriques as $rubrique){
        foreach($rubrique->criteres()->get() as $critere){
          foreach($niveaux as $niveau){
            if($request[$rubrique->id."-".$critere->id."-".$niveau->id]){
              $evaluation = new Evaluation();
              $evaluation->idCritere = $critere->id;
              $evaluation->idNiveau = $niveau->id;
              $evaluation->idSuivi = $suivi->id;
              $evaluation->sens = 0;
              $evaluation->commentaire = "";
              $evaluation->save();
            }
          }
        }
      }
    }
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