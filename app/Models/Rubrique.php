<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rubrique
 * 
 * @property int $id
 * @property string|null $nom
 * 
 * @property Collection|Critere[] $criteres
 *
 * @package App\Models
 */
class Rubrique extends Model
{
	protected $table = 'rubrique';
	public $timestamps = false;

	protected $fillable = [
		'nom'
	];

	public function criteres()
	{
		return $this->hasMany(Critere::class, 'idRubrique');
	}
}
