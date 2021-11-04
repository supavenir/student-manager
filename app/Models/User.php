<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Model
{
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
