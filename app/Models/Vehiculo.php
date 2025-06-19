<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = ['placa', 'modelo', 'marca', 'color', 'nota', 'tipo_id'];
}
