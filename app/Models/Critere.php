<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Critere
 * 
 * @property int $id
 * @property string|null $libelle
 * @property int $idRubrique
 * 
 * @property Rubrique $rubrique
 * @property Collection|Evaluation[] $evaluations
 *
 * @package App\Models
 */
class Critere extends Model
{
	protected $table = 'critere';
	public $timestamps = false;

	protected $casts = [
		'idRubrique' => 'int'
	];

	protected $fillable = [
		'libelle',
		'idRubrique'
	];

	public function rubrique()
	{
		return $this->belongsTo(Rubrique::class, 'idRubrique');
	}

	public function evaluations()
	{
		return $this->hasMany(Evaluation::class, 'idCritere');
	}
}
