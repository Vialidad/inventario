@extends('layouts.master')

@section('content')

    <h1>
        Carga <a href="{{ url('/carga') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:1%;">Volver</a>
        <a href="{{ url('/p9/'.$carga->id) }}" class="btn btn-default pull-right btn-sm" target='_blank'><span class="glyphicon glyphicon-print"></span> P9</a>
    </h1>

    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Fecha:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($carga->fecha)) }}" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Tipo Comp:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $carga->tipo_comp }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nro:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $carga->nro }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Proveedor:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $carga->proveedor->nombre }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Cod P9:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $carga->cod_p9 }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Importe</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value=" $ {{ $carga->importe }}"  disabled="disabled">
            </div>
        </div>
    </div>

    <br>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th class="info">Sub Cuenta</th>
                <th class="info">Nombre</th>
                <th class="info">Marca</th>
                <th class="info">Modelo</th>
                <th class="info">Nro Serie</th>
                <th class="info">Nro Patrimonio</th>
                <th class="info">Detalle</th>
                <th class="info">Importe</th>
                <th class="info">Accion</th>
            </thead>
            <tbody>
                @foreach($carga->producto as $item)
                <tr  class="active">
                <td>{{ $item->subcuenta->nombre }}</td>
                <td> {{ $item->nombre }}</td>
                <td> {{ $item->marca->nombre }}</td>
                <td> {{ $item->modelo->nombre }}</td>
                <td> {{ $item->nro_serie }}</td>
                <td> {{ $item->id_patrimonial }}</td>
                <td> {{ $item->detalle }}</td>
                <td> {{ $item->importe }}</td>
                <td><a href="{{ url('/producto/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection
