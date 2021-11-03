<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Visite
 * 
 * @property int $id
 * @property Carbon|null $dateV
 * @property int $idContrat
 * 
 * @property Contrat $contrat
 * @property Collection|ActiviteAvancement[] $activite_avancements
 *
 * @package App\Models
 */
class Visite extends Model
{
	protected $table = 'visite';
	public $timestamps = false;

	protected $casts = [
		'idContrat' => 'int'
	];

	protected $dates = [
		'dateV'
	];

	protected $fillable = [
		'dateV',
		'idContrat'
	];

	public function contrat()
	{
		return $this->belongsTo(Contrat::class, 'idContrat');
	}

	public function activite_avancements()
	{
		return $this->hasMany(ActiviteAvancement::class, 'idVisite');
	}
}
