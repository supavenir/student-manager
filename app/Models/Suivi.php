<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suivi
 * 
 * @property int $id
 * @property Carbon|null $dateS
 * @property string|null $commentaire
 * @property string|null $statut
 * @property int $idContrat
 * 
 * @property Contrat $contrat
 * @property Collection|Evaluation[] $evaluations
 *
 * @package App\Models
 */
class Suivi extends Model
{
	protected $table = 'suivi';
	public $timestamps = false;

	protected $casts = [
		'idContrat' => 'int'
	];

	protected $dates = [
		'dateS'
	];

	protected $fillable = [
		'dateS',
		'commentaire',
		'statut',
		'idContrat'
	];

	public function contrat()
	{
		return $this->belongsTo(Contrat::class, 'idContrat');
	}

	public function evaluations()
	{
		return $this->hasMany(Evaluation::class, 'idSuivi');
	}
}
