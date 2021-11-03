<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Niveau
 * 
 * @property int $id
 * @property string|null $libelle
 * @property int|null $rang
 * 
 * @property Collection|Evaluation[] $evaluations
 *
 * @package App\Models
 */
class Niveau extends Model
{
	protected $table = 'niveau';
	public $timestamps = false;

	protected $casts = [
		'rang' => 'int'
	];

	protected $fillable = [
		'libelle',
		'rang'
	];

	public function evaluations()
	{
		return $this->hasMany(Evaluation::class, 'idNiveau');
	}
}
