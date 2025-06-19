<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Reporte de Rentas por Mes</title>
    <link href="{{ asset('assets/css/reportes-pdf.css') }}" rel="stylesheet" type="text/css">
    <style type="text/css">
        @page {

            /* formato página */
            margin-top: 0cm;

        }


        /* estilos pie de página */
        .footer {
            position: fixed;
            font-size: 7pt;
            color: #333333;
            left: 0px;
            right: 0px;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;

        }

        /* números de página */
        .pagenum:before {
            content: counter(page);
        }


        .mt {padding-top: 5px}

    </style>
</head>
<body style="background-color: white;">

    <!-- sección encabezado -->
    <section class="header">
        <table cellpadding="0" cellspacing="0" class="" width="100%">
            <tr>
                <td width="8%" ></td>

                <td width="92%" class="text-center">
                    <h1> {{ $empresa->nombre }}  </h1>
                </td>
            </tr>
            <tr>
                <td width="8%" style="vertical-align: top; position: relative">
                    <img src="{{ asset('images/logo.png') }}" height="120px" class="invoice-logo"/>
                </td>
                <td width="92%" class="text-center text-company" style="vertical-align: top;  font-size: 15px">
                    <span><strong>= Reporte de Rentas por Mes =</strong></span>
                    <br/>
                    <span> {{ $empresa->direccion }} </span>
                    <br/>
                    <span> Tel: {{ $empresa->telefono }}</span>
                    <br/>
                    <span>Consulta: {{\Carbon\Carbon::now()->format('d-m-Y')}}</span>
                </td>
            </tr>
        </table>

    </section>

    <!-- sección cuerpo/tabla de contenidos  -->
    <section>
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th> CÓDIGO </th>
                    <th> CLIENTE </th>
                    <th> TELÉFONO </th>
                    <th > ACCESO </th>
                    <th > T.RESTANTE </th>
                    <th > SALIDA </th>
                    <th > VEHÍCULO </th>
                    <th > ESTATUS </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($info as $r)
                <tr>
                    <td class="text-center">{{$r->barcode}}</td>
                    <td class="text-center">{{$r->cliente}}</td>
                    <td class="text-center">{{$r->telefono}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($r->acceso)->format('d-m-Y h:i:s')}}</td>
                    <td class="text-left">
                        <h7 class="text-info">Años:{{$r->restanteyears}}</h7><br>
                        <h7 class="text-info">Meses:{{$r->restantemeses}}</h7><br>
                        <h7 class="text-danger">Días:{{$r->restantedias}}</h7><br>
                        <h7 class="text-default">Horas:{{$r->restantehoras}}</h7><br>

                    </td>
                    <td class="text-center">{{\Carbon\Carbon::parse($r->salida)->format('d-m-Y h:i:s')}}</td>
                    <td class="text-left">
                        <h7 class="text-info">Placa:{{$r->placa}}</h7><br>
                        <h7 class="text-success">Modelo:{{$r->modelo}}</h7><br>
                        <h7 class="text-danger">Marca:{{$r->marca}}</h7>
                    </td>
                    <td class="text-center">
                        @if($r->estado == 'VENCIDO')
                        <h7 class="text-danger"><b>{{$r->estado}}</b></h7>
                        @else

                        @if($r->restantedias > 0)
                        @if($r->restantedias >0 && $r->restantedias <=3)
                        <h7 class="text-warning"><b>{{$r->estado}}</b></h7>
                        @else
                        <h7 class="text-success"><b>{{$r->estado}}</b></h7>
                        @endif
                        @else
                        <h7 class="text-danger"><b>{{$r->estado}}</b></h7>
                        @endif

                        @endif
                    </td>
                </tr>
                @endforeach




            </tbody>
            <tfoot>
               <tr>
                <th colspan="6"></th>
                <th class="text-right mt" colspan="3">
                    <span >Rentas Vencidas:{{$totalVencidos}}</span><br>
                    <span >Próximas a Vencer: {{$totalProximas}}</span>
                </th>
            </tr>
        </tfoot>
    </table>



</section>


<!-- sección pie de pagina y brandind -->
<section class="footer">
    <hr>
    <table cellpadding="0" cellspacing="0" class="" width="100%">
        <tr>
            <td width="20%">
                <span> Sistema de gestion de estacionamiento </span>
            </td>
            <td width="60%" class="text-center">
                Inversiones Sunup
            </td>
            <td width="20%" class="text-right">
                pagina <span class="pagenum"></span>
            </td>
        </tr>
    </table>
</section>


</body>
</html>
