<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Renta;
use App\Models\Empresa;
use Carbon\Carbon;
use DB;


class ReportesController extends Controller
{



	public function VentasDiariasPDF(Request $request)
	{

		//obtener info empresa
		$empresa = Empresa::first();

		//obtener ventas del dia
		$info = Renta::leftjoin('tarifas as t', 't.id', 'rentas.tarifa_id')
			->leftjoin('users as u', 'u.id', 'rentas.user_id')
			->select('rentas.*', 't.costo as tarifa', 't.descripcion as vehiculo', 'u.nombre as usuario')
			->where('estatus', 'CERRADO')
			->whereDate('rentas.created_at', Carbon::today())
			->orderBy('id', 'desc')
			->get();


		//calcular suma total ventas del dia
		$total = Renta::whereDate('rentas.created_at', Carbon::today())->where('estatus', 'CERRADO')->sum('total');


		//cargamos la vista
		$pdf = PDF::loadView('reportespdf.rptventas-diarias', compact(['info', 'total', 'empresa']));

		//mostramos el reporte
		return $pdf->stream('ventas_diarias.pdf');
		//return $pdf->download('ventas_diarias.pdf'); //utiliza esta línea si deseas decargar el reporte en lugar de visualizarlo
	}




	public function VentasPorFechaPDF(Request $request, $fechai, $fechaf)
	{
		//obtenemos info de la empresa
		$empresa = Empresa::first();

		//parseamos las fechas enviadas desde la vista
		$fi = Carbon::parse($fechai)->format('Y-m-d') . ' 00:00:00';
		$ff = Carbon::parse($fechaf)->format('Y-m-d') . ' 23:59:59';

		//obtenemos info ventas
		$info = Renta::leftjoin('tarifas as t', 't.id', 'rentas.tarifa_id')
			->leftjoin('users as u', 'u.id', 'rentas.user_id')
			->select('rentas.*', 't.costo as tarifa', 't.descripcion as vehiculo', 'u.nombre as usuario')
			->where('estatus', 'CERRADO')
			->whereBetween('rentas.created_at', [$fi, $ff])
			->get();

		//calcular suma total ventas del rango de fechas
		$total = Renta::whereBetween('rentas.created_at', [$fi, $ff])->where('estatus', 'CERRADO')->sum('total');

		//cargamos la vista
		$pdf = PDF::loadView('reportespdf.rptventas-por-fecha', compact(['info', 'total', 'empresa', 'fi', 'ff']));

		//formato horizontal
		$pdf->setPaper('A4', 'landscape');
		//mostramos el reporte
		return $pdf->stream('ventas_por_fecha.pdf');
	}




	public function RentasPorVencerPDF()
	{
		$totalVencidos = 0;
		$totalProximas = 0;

		//obtenemos info de la empresa
		$empresa = Empresa::first();


		$info = Renta::leftjoin('vehiculos as v', 'v.id', 'rentas.vehiculo_id')
			->leftjoin('cliente_vehiculos as cv', 'cv.vehiculo_id', 'v.id')
			->leftjoin('users as u', 'u.id', 'cv.user_id')
			->where('rentas.vehiculo_id', '>', 0)
			->where('rentas.estatus', 'ABIERTO')
			->select(
				'rentas.*',
				'u.nombre as cliente',
				'v.placa',
				'v.modelo',
				'v.marca',
				'u.telefono',
				DB::RAW("'' as restantemeses "),
				DB::RAW("'' as restantedias "),
				DB::RAW("'' as restantehoras "),
				DB::RAW("'' as restanteyears "),
				DB::RAW("'' as dif "),
				DB::RAW("'' as estado ")
			)
			->orderBy('rentas.salida', 'asc')
			->get();

		foreach ($info as $r) {
			$start  =  Carbon::parse($r->acceso);
			$end    =  Carbon::parse($r->salida);

			if (Carbon::now()->greaterThan($end)) {
				$r->estado = "VENCIDO";
				$years = 0;
				$months = 0;
				$days = 0;
				$hours = 0;
			} else {
				$years = $start->diffInYears($end);
				$months = $start->diffInMonths($end);
				$days = $start->diffInDays($end);
				$hours = $start->diffInHours($end);
				$r->estado = ($days > 3 ? "ACTIVO" : "PRÓXIMO");
				$r->dif = Carbon::parse($r->salida)->diffForHumans();
			}

			$r->restantemeses = $months;
			$r->restantedias =  $days;
			$r->restantehoras =  $hours;
			$r->restanteyears =  $years;

			if ($days < 1) $totalVencidos++;
			if ($days > 0 && $days <= 3) $totalProximas++;
		}

		//cargamos la vista
		$pdf = PDF::loadView('reportespdf.rptrentas-proximas', compact(['info', 'empresa', 'totalVencidos', 'totalProximas']));

		//formato horizontal
		$pdf->setPaper('A4', 'landscape');
		//mostramos el reporte
		return $pdf->stream('rentas_proximas.pdf');
	}
}
