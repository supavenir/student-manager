<?php

namespace App\Http\Controllers;

use App\Models\Constants;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    public function findAll(): Collection
    {
        return User::where('idRole', Constants::ROLE_ETUDIANT)->get();
    }

    public function getById($id): User
    {
        return User::where('id', $id)->first();
    }
}
