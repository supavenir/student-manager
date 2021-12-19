<?php

namespace App\Http\Controllers;

use App\Models\Suivi;
use App\Models\Niveau;
use App\Models\Rubrique;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class SuiviController extends Controller
{
  public function addSuivi(Request $request, int $idContrat)
  {
    $lastContrat = $this->getLastSuiviByContrat($idContrat);
    if (count($request->all()) > 1) {
      $rubriques = $this->getAllRubriquesWithCriteres();
      $niveaux = $this->getAllNiveaux();
      $suivi = new Suivi();
      $suivi->idContrat = $idContrat;
      $suivi->dateS = new \DateTime();
      $suivi->commentaire = $request["suivi-comment"] ? $request["suivi-comment"] : null;
      $suivi->statut = "Pending";
      $suivi->save();
      $suiviComplet = true;
      if($lastContrat == null){
        foreach ($rubriques as $rubrique) {
          foreach ($rubrique->criteres()->get() as $critere) {
            $evaluated = false;
            foreach ($niveaux as $niveau) {
              if ($request[$rubrique->id . "-" . $critere->id . "-" . $niveau->id]) {
                $evaluated = true;
                $evaluation = new Evaluation();
                $evaluation->idCritere = $critere->id;
                $evaluation->idNiveau = $niveau->id;
                $evaluation->idSuivi = $suivi->id;
                $evaluation->sens = null;
                $evaluation->commentaire = $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  ? $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  : null;
                $evaluation->save();
              }
            }
            if (!$evaluated && $suiviComplet) $suiviComplet = false;
          }
        }
      }else{
        foreach($rubriques as $rubrique){
          foreach($rubrique->criteres()->get() as $critere){
            $evaluated = false;
            if($request->has($rubrique->id."-".$critere->id."-selection")){
              $niveau = Niveau::find($request->get($rubrique->id . "-" . $critere->id . "-selection"));
              if($niveau != null){
                $evaluated = true;
                $evaluation = new Evaluation();
                $evaluation->idCritere = $critere->id;
                $evaluation->idNiveau = $niveau->id;
                $evaluation->idSuivi = $suivi->id;
                $evaluation->sens = $request->has($rubrique->id . "-" . $critere->id)
                ? $request->get($rubrique->id . "-" . $critere->id)
                : null;
                $evaluation->commentaire = $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  ? $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  : null;
                $evaluation->save();
              }
            }
            if(!$evaluated && $suiviComplet) $suiviComplet = false;
          }
        }
      }

      if ($suiviComplet) {
        $suivi->statut = "OK";
        $suivi->update();
      }
    }
    return redirect()->route('contrats-details', ["id" => $idContrat]);
  }

  public function editSuivi(Request $request, int $idContrat, int $idSuivi)
  {
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
          if ($evaluation != null) {
            $evaluated = true;
            foreach ($request->all() as $key => $value) {
              if ($key == '_token') continue;
              $keyExploded = explode("-", $key);
              if ($keyExploded[0] == $rubrique->id && $keyExploded[1] == $critere->id && $keyExploded[2] != 'comment') {
                $niveauId = $keyExploded[2];
                $evaluation->where([
                  'idCritere' => $critere->id,
                  'idNiveau' => $evaluation->idNiveau,
                  'idSuivi' => $suivi->id
                ])->update(['idNiveau' => $niveauId, 'commentaire' => $request[$rubrique->id . "-" . $critere->id . "-comment"]]);
                break;
              }
            }
          } else {
            foreach ($niveaux as $niveau) {
              if ($request[$rubrique->id . "-" . $critere->id . "-" . $niveau->id]) {
                $evaluated = true;
                $evaluation = new Evaluation();
                $evaluation->idCritere = $critere->id;
                $evaluation->idNiveau = $niveau->id;
                $evaluation->idSuivi = $suivi->id;
                $evaluation->sens = null;
                $evaluation->commentaire = $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  ? $request[$rubrique->id . "-" . $critere->id . "-comment"]
                  : null;
                $evaluation->save();
              }
            }
          }
          if (!$evaluated && $suiviComplet) $suiviComplet = false;
        }
      }
      if ($suiviComplet) {
        $suivi->statut = "OK";
      }
    }
    $suivi->update();
    return redirect()->route('contrats-details', ["id" => $idContrat]);
  }

  public function getById($id): Suivi
  {
    return Suivi::where('id', $id)->first();
  }

  public function getLastSuiviByContrat($id){
    return Suivi::where('idContrat', $id)->orderBy('dateS', 'desc')->first();
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
