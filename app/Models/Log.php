<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * 
 * @property int $id
 * @property Carbon|null $dateL
 * @property string|null $action
 * @property int|null $idElement
 * @property int $idUtilisateur
 * 
 * @property Utilisateur $utilisateur
 *
 * @package App\Models
 */
class Log extends Model
{
	protected $table = 'log';
	public $timestamps = false;

	protected $casts = [
		'idElement' => 'int',
		'idUtilisateur' => 'int'
	];

	protected $dates = [
		'dateL'
	];

	protected $fillable = [
		'dateL',
		'action',
		'idElement',
		'idUtilisateur'
	];

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
	}
}
