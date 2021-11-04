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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name','nom');
            $table->renameColumn('password','motDePasse');
            $table->string('login')->after('id');
            $table->string('prenom')->after('name');
            $table->string('tel')->after('password')->nullable();
            $table->integer('idRole');
            $table->string('idEntreprise')->nullable();
        });
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
