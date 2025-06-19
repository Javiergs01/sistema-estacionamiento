<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Renta;
use Livewire\Component;

class VentasDiarias extends Component
{
    public $fecha_ini, $fecha_fin;

    public function render()
    {



        $ventas = Renta::leftjoin('tarifas as t', 't.id', 'rentas.tarifa_id')
            ->leftjoin('users as u', 'u.id', 'rentas.user_id')
            ->select('rentas.*', 't.costo as tarifa', 't.descripcion as vehiculo', 'u.nombre as usuario')
            ->where('estatus', 'CERRADO')
            ->whereDate('rentas.created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->paginate(10);


        $total = Renta::whereDate('rentas.created_at', Carbon::today())->where('estatus', 'CERRADO')->sum('total');

        return view('livewire.reportes.ventas-diarias', [
            'info' => $ventas,
            'sumaTotal' => $total
        ])->extends('layouts.template')->section('content');
    }
}
