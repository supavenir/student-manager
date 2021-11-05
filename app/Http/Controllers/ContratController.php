<?php

namespace App\Http\Controllers;

use App\Models\Contrat;

class ContratController extends Controller
{

  public function getById($id): Contrat
  {
    return Contrat::where('id', $id)->first();
  }
}
