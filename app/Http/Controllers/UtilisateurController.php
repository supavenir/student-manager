<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Collection;

class UtilisateurController extends Controller
{
    public function findAll(): Collection
    {
        return Utilisateur::all();
    }

    public function getById($id): Utilisateur
    {
        return Utilisateur::where('id', $id)->first();
    }
}
