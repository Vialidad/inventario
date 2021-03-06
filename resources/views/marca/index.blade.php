@extends('layouts.master')

@section('content')

    <h1>Marcas <a href="{{ url('/marca/create') }}" class="btn btn-primary pull-right btn-sm">Crear Marca</a></h1>

    <hr>

    <div class="table">
        <table id="example" class="table table-condensed table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tfoor>
                <tr>
                    <th>Nombre</th>
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
          ajax: '{!! action("MarcaController@datatables") !!}',
          columns: [
                { data: 'nombre', name: 'nombre','orderable': true, 'searchable': true},
                { data: 'action', name: 'action', orderable: true, searchable:true }
          ]
    });

});

</script>



@endsection

