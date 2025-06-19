<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';

    protected $fillable = ['monto', 'tipo', 'concepto', 'comprobante', 'user_id'];
}
