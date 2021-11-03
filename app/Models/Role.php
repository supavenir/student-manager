<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string|null $libelle
 * 
 * @property Collection|Utilisateur[] $utilisateurs
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'role';
	public $timestamps = false;

	protected $fillable = [
		'libelle'
	];

	public function utilisateurs()
	{
		return $this->hasMany(Utilisateur::class, 'idRole');
	}
}
