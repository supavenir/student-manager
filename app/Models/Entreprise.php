<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entreprise
 * 
 * @property int $id
 * @property string|null $raisonSociale
 * @property string|null $adresse
 * @property string|null $cp
 * @property string|null $ville
 * @property string|null $tel
 * @property string|null $email
 * 
 * @property Collection|Contrat[] $contrats
 * @property Collection|Utilisateur[] $utilisateurs
 *
 * @package App\Models
 */
class Entreprise extends Model
{
	protected $table = 'entreprise';
	public $timestamps = false;

	protected $fillable = [
		'raisonSociale',
		'adresse',
		'cp',
		'ville',
		'tel',
		'email'
	];

	public function contrats()
	{
		return $this->hasMany(Contrat::class, 'idEntreprise');
	}

	public function utilisateurs()
	{
		return $this->hasMany(Utilisateur::class, 'idEntreprise');
	}
}
