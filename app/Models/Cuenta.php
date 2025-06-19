<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cuenta extends Model
{

	protected $fillable = ['operadora', 'precioadulto', 'preciojr', 'preciomenor', 'total', 'estatus'];

	public function abonos()
	{
		return $this->hasMany(Abono::class);
	}
}
