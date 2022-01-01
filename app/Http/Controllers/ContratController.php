<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contrat;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class ContratController extends Controller
{
  public function getAllContratsNotLinkedToProfesseur($idProfesseur)
  {
    $contrats = Contrat::where('idProfesseur', '!=', $idProfesseur)->get();
    $finalResult = [];
    foreach ($contrats as $contrat){
      array_push($finalResult, array("contrat" => $contrat, "etudiant" => User::where('id', $contrat->idEtudiant)->first()));
    }
    return $finalResult;
  }

  public function getEvaluationHistory(int $idContrat, int $idCritere, bool $sortByDate)
  {
    $contrat = Contrat::where('id', $idContrat)->first();
    $suivisSorted = $sortByDate ? $contrat->suivis->sortByDesc('dateS') : $contrat->suivis;
    if (count($suivisSorted) > 0) {
      $finalResult = [];
      foreach ($suivisSorted as $suivi) {
        $evaluation = Evaluation::where([
          'idCritere' => $idCritere,
          'idSuivi' => $suivi->id
        ])->first();
        array_push($finalResult, array('suivi' => $suivi, 'evaluation' => $evaluation));
      }
      return $finalResult;
    } else {
      return [];
    }
  }

  public function getEvaluationHistoryToJson(int $idContrat, int $idCritere): array
  {
    return $this->getEvaluationHistory($idContrat, $idCritere, false);
  }

  public function getById(int $id): Contrat
  {
    return Contrat::where('id', $id)->first();
  }
}
