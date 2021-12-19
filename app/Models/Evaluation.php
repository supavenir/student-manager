<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluation
 * 
 * @property int $idCritere
 * @property int $idNiveau
 * @property int $idSuivi
 * @property string|null $sens
 * @property string|null $commentaire
 * 
 * @property Critere $critere
 * @property Niveau $niveau
 * @property Suivi $suivi
 *
 * @package App\Models
 */
class Evaluation extends Model
{
	protected $table = 'evaluation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCritere' => 'int',
		'idNiveau' => 'int',
		'idSuivi' => 'int'
	];

	protected $fillable = [
		'sens',
		'commentaire'
	];

	public function critere()
	{
		return $this->belongsTo(Critere::class, 'idCritere');
	}

	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'idNiveau');
	}

	public function suivi()
	{
		return $this->belongsTo(Suivi::class, 'idSuivi');
	}
}
