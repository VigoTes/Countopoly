@extends('Layout.Plantilla')
@section('titulo')
    Flujograma
@endsection

@section('contenido')


<h1 class="text-center">
    
    BIENVENIDO A ESTA PLANTILLA
    {{App\Cuenta::getCuentaLogeada()}}
</h1>
@endsection

