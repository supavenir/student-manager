<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UtilisateurToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->renameColumn('name','nom');
//            $table->renameColumn('password','motDePasse');
//            $table->string('login')->after('id');
//            $table->string('prenom')->after('name');
//            $table->string('tel')->after('password')->nullable();
//            $table->integer('idRole');
//            $table->string('idEntreprise')->nullable();
//        });

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
    }
}
