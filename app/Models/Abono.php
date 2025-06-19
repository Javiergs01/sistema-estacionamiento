<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $fillable = ['user_id', 'monto', 'cuenta_id'];

    protected $table = 'abonos';


    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }
}
