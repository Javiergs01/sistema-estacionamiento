<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = ['descripcion'];


    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class, 'tipo_id');
    }

    public function cajon()
    {
        return $this->belongsTo(Cajon::class, 'tipo_id');
    }
}
