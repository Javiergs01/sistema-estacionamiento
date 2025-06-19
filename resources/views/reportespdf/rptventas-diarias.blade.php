<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Reporte de Ventas Diarias</title>
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
                    <span><strong>= Reporte de Ventas Diarias =</strong></span>
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
                    <th> VEHÍCULO </th>
                    <th> ACCESO </th>
                    <th > SALIDA </th>
                    <th > TIEMPO </th>
                    <th > TARIFA </th>
                    <th > IMPORTE </th>
                    <th > SERVICIO </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($info as $r)
                <tr>
                    <td class="text-center"><p class="mb-0">{{$r->barcode}}</p></td>
                    <td class="text-center">
                        {{$r->vehiculo}}
                        @if($r->descripcion !=null)
                        <br>"{{$r->descripcion}}"
                        @endif
                    </td>
                    <td class="text-center">{{\Carbon\Carbon::parse($r->acceso)->format('d/m/Y h:m') }}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($r->salida)->format('d/m/Y h:m') }}</td>
                    <td class="text-center">{{$r->hours}} Hrs.</td>
                    <td class="text-center">${{number_format($r->tarifa,2)}}</td>
                    <td class="text-center">
                        @if($r->multa > 0)
                        ${{$r->total}} <br> (extraviado)
                        @else
                        ${{$r->total}}
                        @endif
                    </td>

                    <td class="text-center" class="text-center">
                        @if($r->vehiculo_id == null)
                        RENTA
                        @else
                        PENSIÓN
                        @endif
                    </td>
                </tr>
                @endforeach




            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class="text-right" style="vertical-align: top; padding-right: 4px;">
                        <span style="line-height: 16px;"><strong>SUMA IMPORTES</strong></span>
                    </td>
                    <td class="text-center">
                      <strong> ${{ number_format($total,2) }}    </strong>
                  </td>
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
                    <span> Sistema de gestión de estacionamiento </span>
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
