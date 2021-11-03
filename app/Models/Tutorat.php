<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutorat
 * 
 * @property int $idTuteur
 * @property int $idContrat
 * 
 * @property Utilisateur $utilisateur
 * @property Contrat $contrat
 *
 * @package App\Models
 */
class Tutorat extends Model
{
	protected $table = 'tutorat';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTuteur' => 'int',
		'idContrat' => 'int'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idTuteur');
	}

	public function contrat()
	{
		return $this->belongsTo(Contrat::class, 'idContrat');
	}
}
