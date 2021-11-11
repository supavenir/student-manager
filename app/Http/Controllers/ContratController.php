<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Evaluation;

class ContratController extends Controller
{

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
