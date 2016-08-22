@extends('layouts.master')

@section('content')

    <h1>Subcuentas <a href="{{ url('/subcuenta/create') }}" class="btn btn-primary pull-right btn-sm">Crear Subcuenta</a></h1>

    <hr>

    <div class="table">
        <table id="example" class="table table-condensed table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Codigo Cuenta</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tfoor>
                <tr>
                    <th>Nombre</th>
                    <th>Codigo Cuenta</th>
                    <th>Accion</th>
                </tr>
            </tfoor>
        </table>
    </div>

@endsection

@section('script')

<script>

$(document).ready(function() {

    $('#example').DataTable({
          processing: true,
          serverSide: true,
          searching: true,
          autoWidth: true,
          language: { 
                processing:     "Proceso en curso...",
                search:         "Buscar&nbsp;:",
                lengthMenu:    "Paginacion&nbsp _MENU_",
                info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                infoEmpty:      "Ningún dato disponible en esta tabla",
                paginate: {
                    first:      "",
                    previous:   "Anterior",
                    next:       "Siguiente",
                    last:       ""
                }
            },
          ajax: '{!! action("SubCuentaController@datatables") !!}',
          columns: [
                { data: 'nombre', name: 'nombre','orderable': true, 'searchable': true},
                { data: 'cuenta_codigo', name: 'cuenta_codigo','orderable': true, 'searchable': true},
                { data: 'action', name: 'action', orderable: true, searchable:true }
          ]
    });

});

</script>

@endsection

