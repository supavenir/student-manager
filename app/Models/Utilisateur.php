<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $email
 * @property string|null $motDePasse
 * @property string|null $prenom
 * @property string|null $nom
 * @property string|null $tel
 * @property int $idRole
 * @property int|null $idEntreprise
 *
 * @property Role $role
 * @property Entreprise|null $entreprise
 * @property Collection|Contrat[] $contrats
 * @property Collection|Log[] $logs
 * @property Collection|Tutorat[] $tutorats
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateur';
	public $timestamps = false;

	protected $casts = [
		'idRole' => 'int',
		'idEntreprise' => 'int'
	];

	protected $fillable = [
		'login',
		'email',
		'motDePasse',
		'prenom',
		'nom',
		'tel',
		'idRole',
		'idEntreprise'
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
