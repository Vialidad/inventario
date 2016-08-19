@extends('layouts.master')

@section('content')

    <h1>Cuenta<a href="{{ url('/cuenta') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:1%;">Volver</a></h1>

        <hr>

     <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Codigo:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $cuenta->codigo }}"  disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Nombre:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $cuenta->nombre }}"  disabled="disabled">
            </div>
        </div>
    </div>

    <br>

    <h4>Subcuentas:</h4>
    
    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
            </tr>
             @foreach ($cuenta->subcuentas as $subcuenta)
                <tr>               
                    <td> {{ $subcuenta->id }} </td>
                    <td> {{ $subcuenta->nombre }} </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
