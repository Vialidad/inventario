@extends('layouts.master')

@section('content')

    <h1>Marca<a href="{{ url('/marca') }}" class="btn btn-primary pull-right btn-sm" style="margin-left:1%;">Volver</a></h1>

    <hr>

     <div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Nombre:</label>
            <div class="col-sm-6">
                 <input type="text" class="form-control" value="{{ $marca->nombre }}"  disabled="disabled">
            </div>
        </div>
    </div>

@endsection
