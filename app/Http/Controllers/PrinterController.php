<?php

namespace App\Http\Controllers;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Renta;
use App\Models\Tarifa;
use Carbon\Carbon;

class PrinterController extends Controller
{


	public function TicketVista_Original(Request $request)
	{
        //COMENTADO DEBIDO A QUE NO SE CYUENTA CON UNA IMPRESORA TERMICA
        /*
		$folio = str_pad($request->id, 13, "0", STR_PAD_LEFT);
		//$nombreImpresora = "TM20";
        $nombreImpresora = "EP0B2B70:L475 SERIES";
		$connector = new WindowsPrintConnector($nombreImpresora);
		$printer = new Printer($connector);


		$empresa = Empresa::all();
		$renta = Renta::find($request->id);
		$tarifa = Tarifa::find($renta->tarifa_id);

		//$nombreImpresora = "OrdersPrinter";
		$connector = new WindowsPrintConnector($nombreImpresora);
		$impresora = new Printer($connector);
		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->setTextSize(2, 2);
		//$logo = EscposImage::load("img/logo/logo255.png", false);
		//$impresora -> graphics($logo);
		//$impresora->text($empresa[0]->nombre . "\n");
		$impresora->text("ESTACIONAMIENTO\n Y PENSIÓN PLAZA\n");
		$impresora->setTextSize(1, 1);
		$impresora->text("$empresa->direccion \n");
		$impresora->text("Teléfono: $empresa->telefono \n");
		$impresora->text("** Recibo de Renta ** \n\n");

		$impresora->setJustification(Printer::JUSTIFY_LEFT);
		$impresora->text("=============================================\n");
		$impresora->text("Entrada: " . Carbon::parse($renta->created_at)->format('d/m/Y h:m:s') . "\n");
		$impresora->text("Tarifa por hora: $" . number_format($tarifa->costo, 2) . " \n");
		if (!empty($renta->descripcion)) $impresora->text('Desc: ' . $renta->descripcion . " \n");
		$impresora->text("=============================================\n");


		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->text("Por favor conservar el ticket hasta el pago, en caso de extravio se pagará una multa de $50\n\n");



		//barcode
		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->setBarcodeHeight(70);
		$impresora->setBarcodeWidth(4);
		$impresora->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
		$impresora->selectPrintMode();

		$impresora->text(' '  . "\n");
		$impresora->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
		$impresora->barcode($folio, Printer::BARCODE_JAN13);
		$impresora->feed(2);

		$impresora->text("Gracias por su preferencia ! \n");
		$impresora->text("Inversiones Sunup\n");
		$impresora->feed(3);
		$impresora->cut();
		$impresora->close();
        */
        return "Función de impresión de ticket deshabilitada temporalmente.";
	}

	public function TicketPension(Request $request)
	{
        /*
		//damos formato al folio con ceros a la izquierda
		$folio = str_pad($request->id, 7, "0", STR_PAD_LEFT);
		$nombreImpresora = "TM20"; //nombre impresora
		$connector = new WindowsPrintConnector($nombreImpresora); //creamos instancia del conector en windows
		$printer = new Printer($connector);


		$empresa = Empresa::all();
		$renta = Renta::find($request->id);
		$tarifa = Tarifa::where('tiempo', 'Mes')->select('costo')->first();
		$cliente = Renta::leftjoin('cliente_vehiculos as cv', 'cv.vehiculo_id', 'rentas.vehiculo_id')
			->leftjoin('users as u', 'u.id', 'cv.user_id')
			->select('u.nombre')
			->where('rentas.id', $renta->id)
			->first();


		//$nombreImpresora = "OrdersPrinter";
		$connector = new WindowsPrintConnector($nombreImpresora);
		$impresora = new Printer($connector);
		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->setTextSize(2, 2);
		//$logo = EscposImage::load("img/logo/logo255.png", false);
		//$impresora -> graphics($logo);
		//$impresora->text($empresa[0]->nombre . "\n");
		$impresora->text(strtoupper($empresa[0]->nombre) . "\n");
		$impresora->setTextSize(1, 1);
		$impresora->text($empresa[0]->direccion . "\n");
		$impresora->text("Teléfono:" . $empresa[0]->telefono . "\n");
		$impresora->text("** Recibo de Pensión ** \n\n");

		$impresora->setJustification(Printer::JUSTIFY_LEFT);
		$impresora->text("=============================================\n");
		$impresora->text("Cliente: " . $cliente->nombre . "\n");
		$impresora->text("Entrada: " . Carbon::parse($renta->created_at)->format('d/m/Y h:m:s') . "\n");
		$impresora->text("Salida: " . Carbon::parse($renta->salida)->format('d/m/Y h:m:s') . "\n");
		$impresora->text("Tiempo: " . $renta->hours .  ' MES(ES)' . " \n");
		$impresora->text("Tarifa: $" . number_format($tarifa->costo, 2) . " \n");
		$impresora->text("TOTAL: $" . number_format($renta->total, 2) . " \n");
		$impresora->text('Placa:' . $renta->placa . ' Marca:' . $renta->marca . ' Color:' . $renta->color . " \n");
		$impresora->text("=============================================\n");



		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->text("Por favor conservar el ticket hasta el pago, en caso de extravio se pagará una multa de $50\n\n");



		//barcode
		$impresora->selectPrintMode();
		//$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->setBarcodeHeight(80);
		$impresora->barcode($folio, Printer::BARCODE_CODE39);
		$impresora->feed(2);


		$impresora->text("Gracias por su preferencia ! \n");
		$impresora->text("Inversiones Sunup\n");
		$impresora->feed(3);
		$impresora->cut();
		$impresora->close();
        */
        return "Función de impresión de ticket deshabilitada temporalmente.";
	}




    //Este es el que ejecuta cuando selecciono manualmente el cajon y confirmo
	public function TicketVista(Request $request)
	{

        /*
		$folio = str_pad($request->id, 7, "0", STR_PAD_LEFT); //formato folio con ceros a la izquierda
		//$nombreImpresora = "TM20"; //nombre impresora
        $nombreImpresora = "EP0B2B70:L475 SERIES";
		$connector = new WindowsPrintConnector($nombreImpresora); //creamos instancia de conexión a la impresora
		$impresora = new Printer($connector); //le indicamos a la clase de impresión a cuál impresora debe mandarle el ticket

		//obtenemos la info necesaria de la db
		$empresa = Empresa::all();
		$renta = Renta::find($request->id);
		$tarifa = Tarifa::find($renta->tarifa_id);

		//centramos y seteamos el font al nombre del negocio
		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->setTextSize(2, 2);
		$impresora->text(strtoupper($empresa[0]->nombre) . "\n");
		$impresora->setTextSize(1, 1);
		$impresora->text($empresa[0]->direccion . "\n");
		$impresora->text("Teléfono:" . $empresa[0]->telefono . "\n");
		$impresora->text("** Recibo de Renta ** \n\n");

		//alineamos a la izquierda los siguientes elementos
		$impresora->setJustification(Printer::JUSTIFY_LEFT);
		$impresora->text("=============================================\n");
		$impresora->text("Entrada: " . Carbon::parse($renta->created_at)->format('d/m/Y h:m:s') . "\n");
		$impresora->text("Tarifa por hora: $" . number_format($tarifa->costo, 2) . " \n");
		if (!empty($renta->descripcion)) $impresora->text('Desc: ' . $renta->descripcion . " \n");
		$impresora->text("=============================================\n");

		//alineamos al centro los conceptos finales
		$impresora->setJustification(Printer::JUSTIFY_CENTER);
		$impresora->text("Por favor conservar el ticket hasta el pago, en caso de extravio se pagará una multa de $50\n\n");



		//seteamos el modo de impresión para cambiar el height y width del código de barras
		$impresora->selectPrintMode();
		$impresora->setBarcodeHeight(80); //altura del barcode
		$impresora->barcode($folio, Printer::BARCODE_CODE39); //especificamos el estándar code39 (7 dígitos)
		$impresora->feed(2); // generamos 2 espacios/saltos de linea en papel

		//mensaje de despedida
		$impresora->text("Gracias por su preferencia ! \n");
		$impresora->text("Inversiones Sunup\n"); //brandind
		$impresora->feed(3); //damos 3 saltos de linea
		$impresora->cut(); //cortamos papel
		$impresora->close(); //cerramos la conexión a la impresora
        */
        return "Función de impresión de ticket deshabilitada temporalmente.";
	}

	public function TicketVista2(Request $request)
	{
		//$connector = new WindowsPrintConnector('TM20');
        //$connector = new WindowsPrintConnector('EP0B2B70:L475 SERIES');
		//$printer = new Printer($connector);

        //Los barcodes dejarlo comentado
		/* Barcodes */
		/*
		$barcodes = array(
			Printer:::BARCODE_UPCA,
			Printer:::BARCODE_UPCE,
			Printer:::BARCODE_JAN13,
			Printer:::BARCODE_JAN8,
			Printer:::BARCODE_CODE39,
			Printer:::BARCODE_ITF,
			Printer:::BARCODE_CODABAR);
		*/
        /*
		$printer->selectPrintMode();
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		//$printer -> setBarcodeHeight(80);
		$printer->barcode("0000007", Printer::BARCODE_CODE39);
		$printer->feed(2);
		$printer->cut();
		$printer->close();
        */
        return "Función de impresión de ticket deshabilitada temporalmente.";
	}
}
