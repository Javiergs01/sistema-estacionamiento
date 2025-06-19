<?php

namespace App\Models;

use App\Models\Cotizacion;
use Illuminate\Database\Eloquent\Model;


class Pago extends Model
{
    protected $fillable = ['monto', 'user_id', 'cotizacion_id'];

    protected $table = 'pagos';

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
