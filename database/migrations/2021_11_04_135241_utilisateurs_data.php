<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UtilisateursData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $utilisateurs = \App\Models\Utilisateur::all();

        foreach ($utilisateurs as $u ){
            $user = new \App\Models\User();

            $user->nom = $u->nom;
            $user->prenom = $u->prenom;
            $user->login = $u->login;
            $user->email = $u->email;
            $user->motDePasse = bcrypt($u->motDePasse);
            $user->tel = null;
            $user->idRole = $u->idRole;
            $user->idEntreprise = $u->idEntreprise;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
