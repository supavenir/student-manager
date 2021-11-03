<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activite
 * 
 * @property int $id
 * @property string|null $titre
 * @property string|null $description
 * 
 * @property Collection|ActiviteAvancement[] $activite_avancements
 *
 * @package App\Models
 */
class Activite extends Model
{
	protected $table = 'activite';
	public $timestamps = false;

	protected $fillable = [
		'titre',
		'description'
	];

	public function activite_avancements()
	{
		return $this->hasMany(ActiviteAvancement::class, 'idActivite');
	}
}
