<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrat
 * 
 * @property int $id
 * @property Carbon|null $dateD
 * @property Carbon|null $dateF
 * @property int $idProfesseur
 * @property int $idEtudiant
 * @property int $idEntreprise
 * 
 * @property Utilisateur $utilisateur
 * @property Entreprise $entreprise
 * @property Collection|Suivi[] $suivis
 * @property Collection|Tutorat[] $tutorats
 * @property Collection|Visite[] $visites
 *
 * @package App\Models
 */
class Contrat extends Model
{
	protected $table = 'contrat';
	public $timestamps = false;

	protected $casts = [
		'idProfesseur' => 'int',
		'idEtudiant' => 'int',
		'idEntreprise' => 'int'
	];

	protected $dates = [
		'dateD',
		'dateF'
	];

	protected $fillable = [
		'dateD',
		'dateF',
		'idProfesseur',
		'idEtudiant',
		'idEntreprise'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idEtudiant');
	}

	public function entreprise()
	{
		return $this->belongsTo(Entreprise::class, 'idEntreprise');
	}

	public function suivis()
	{
		return $this->hasMany(Suivi::class, 'idContrat');
	}

	public function tutorats()
	{
		return $this->hasMany(Tutorat::class, 'idContrat');
	}

	public function visites()
	{
		return $this->hasMany(Visite::class, 'idContrat');
	}
}
