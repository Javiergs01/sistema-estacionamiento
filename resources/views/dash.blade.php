@extends('layouts.template')
@section('content')
<div id="content" class="main-content">



	<div class="row mt-4">
		<div class="col-lg-8">
			<div class="layout-px">
				<div class="widget-content-area">
					<div class="widget-one">
						<!-- Helper/Metodo  genera un DIV con un id unico y es donde se monta el gráfico   -->
						{!! $chartVentaxMes->container() !!}


						<!-- Helper/Metodo incluye el javascript del package Larapex-->
						<script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>

						<!-- Helper/Metodo toma la información enviada desde el controlador en formato json y genera un script para renderizar el gráfico -->
						{{ $chartVentaxMes->script() }}
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="layout-px">
				<div class="widget-content-area">
					<div class="widget-one">
						{!! $chartVentaSemanal->container() !!}

						<script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>

						{{ $chartVentaSemanal->script() }}
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 mt-2">
			<div class="layout-px">
				<div class="widget-content-area">
					<div class="widget-one">
						{!! $chartBalancexMes->container() !!}

						<script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>

						{{ $chartBalancexMes->script() }}
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
@endsection