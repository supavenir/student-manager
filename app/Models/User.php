<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
	protected $table = 'users';

	protected $hidden = [
		'motDePasse',
		'remember_token'
	];

	protected $fillable = [
        'login',
		'nom',
        'prenom',
		'email',
		'motDePasse',
		'remember_token',
        'tel',
        'idRole',
        'idEntreprise',
	];

    public function username(){
        return 'login';
    }

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    public function fullName()
    {
        return $this->nom . " " . $this->prenom;
    }

    public function hasRole(int $idRole){
        return $this->role === $idRole;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idRole');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'idEntreprise');
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'idEtudiant');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'idUtilisateur');
    }

    public function tutorats()
    {
        return $this->hasMany(Tutorat::class, 'idTuteur');
    }
}
