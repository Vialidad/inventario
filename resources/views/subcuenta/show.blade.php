@extends('layouts.master')

@section('content')

    <h1>Subcuenta <a href="{{ url('/subcuenta') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:1%;">Volver</a></h1>

    <hr>

     <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Codigo:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $subcuentum->codigo }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nombre:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $subcuentum->nombre }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Cuenta Codigo:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $subcuentum->cuenta_codigo }}-{{ $subcuentum->cuenta->nombre }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Stock:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $subcuentum->stock }}"  disabled="disabled">
            </div>
        </div>
    </div>
@endsection