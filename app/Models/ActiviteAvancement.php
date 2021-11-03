<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActiviteAvancement
 * 
 * @property int $idVisite
 * @property int $idActivite
 * @property string|null $avancement
 * 
 * @property Visite $visite
 * @property Activite $activite
 *
 * @package App\Models
 */
class ActiviteAvancement extends Model
{
	protected $table = 'activite_avancement';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idVisite' => 'int',
		'idActivite' => 'int'
	];

	protected $fillable = [
		'avancement'
	];

	public function visite()
	{
		return $this->belongsTo(Visite::class, 'idVisite');
	}

	public function activite()
	{
		return $this->belongsTo(Activite::class, 'idActivite');
	}
}
