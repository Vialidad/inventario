@extends('layouts.master')

@section('content')

    <h1>Dependecia <a href="{{ url('/dependencia') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:1%;">Volver</a></h1>

        <hr>

     <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">ID:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $dependencia->id }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nombre:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $dependencia->nombre }}"  disabled="disabled">
            </div>
        </div>
    </div>

    <br>

    <h4>A CARGO DE:</h4>
    
    <hr>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>SubCuenta</th>
                <th>Nombre</th>
                <th>Nro Serie</th>
                <th>Nro Patrimonio</th>
                <th>Detalle</th>
            </tr>
             @foreach ($productos as $producto)
                <tr>               
                    <td>{{ $producto->subcuenta->nombre }}</td> 
                    <td> {{ $producto->nombre }} </td>
                    <td> {{ $producto->nro_serie }} </td>
                    <td> {{ $producto->id_patrimonial }} </td>
                    <td> {{ $producto->detalle }} </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
