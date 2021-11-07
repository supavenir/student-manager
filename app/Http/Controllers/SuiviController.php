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

  public function addSuivi(Request $request, int $idContrat){
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

  public function editSuivi(Request $request, int $idContrat, int $idSuivi){
    $suivi = $this->getById($idSuivi);
    if (count($request->all()) > 1) {
      $rubriques = $this->getAllRubriquesWithCriteres();
      $niveaux = $this->getAllNiveaux();
      $suivi->dateS = new \DateTime();
      $suivi->commentaire = $request["suivi-comment"] ? $request["suivi-comment"] : null;
      $suivi->statut = "Pending";
      $suivi->update();
      $suiviComplet = true;
      foreach ($rubriques as $rubrique) {
        foreach ($rubrique->criteres()->get() as $critere) {
          $evaluated = false;
          $evaluation = $suivi->getEvaluation($critere->id);
          if($evaluation != null && $request[$rubrique->id . "-" . $critere->id . "-" . $evaluation->niveau()->first()->id]){
            $evaluated = true;
          }else{
            foreach ($niveaux as $niveau) {
              if ($request[$rubrique->id . "-" . $critere->id . "-" . $niveau->id]) {
                $evaluated = true;
                if ($evaluation == null) $evaluation = new Evaluation();
                $evaluation->idCritere = $critere->id;
                $evaluation->idNiveau = $niveau->id;
                $evaluation->idSuivi = $suivi->id;
                $evaluation->sens = 0;
                $evaluation->commentaire = $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  ? $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  : "";
                $evaluation->id != null ? $evaluation->update() : $evaluation->save();
              }
            }
          }
          if (!$evaluated && $suiviComplet) $suiviComplet = false;
        }
      }
      if ($suiviComplet) {
        $suivi->statut = "OK";
        $suivi->update();
      }
    }
    return redirect()->route('contrats-details', ["id" => $idContrat]);
  }

  public function getById($id): Suivi
  {
    return Suivi::where('id', $id)->first();
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