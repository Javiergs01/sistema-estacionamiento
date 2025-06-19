@extends('layouts.template')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @livewire('clientes-controller')
        </div>
    </div>
</div>
@endsection