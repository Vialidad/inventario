@extends('layouts.layout')

@section('content')

<h1>Consulta Stock</h1>
<hr/>

<div class="row" style="margin-bottom: 5%;">

    {!! Form::open(['url' => 'cuenta', 'class' => 'form-horizontal cuenta']) !!}
    <div class="col-lg-6">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-default btn-sm" type="button">Seleccionar Cuenta</button>
            </span>

            {!! Form::select('codigo',$cuenta, null, array('class'=>'select', 'id' => 'codigo')) !!}

        </div>
    </div><!-- /.col-lg-6 -->
    {!! Form::close() !!}

    {!! Form::open(['url' => 'subcuenta', 'class' => 'form-horizontal']) !!}
	<div class="col-lg-6">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-default btn-sm" type="button">Seleccionar SubCuenta</button>
			</span>

			{!! Form::select('cuenta_codigo',array('' => 'Seleccionar Cuenta...'), null, array('class'=>'selectize-input subcuenta','disabled'=> 'disabled', 'id'=> 'cuenta_codigo')) !!}

		</div>
	</div><!-- /.col-lg-6 -->
	{!! Form::close() !!}

</div><!-- /.row -->

<div class="table">
  <table id="example" class="table table-condensed table-bordered table-striped">
    <thead>
        <tr>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Nro Serie</th>
          <th>Nro Patrimonio</th>
          <th>Detalle</th>
          <th>Importe</th>
          <th>Fecha Alta</th>
          <th>Fecha Baja</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
          <th>Nombre</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Nro Serie</th>
          <th>Nro Patrimonio</th>
          <th>Detalle</th>
          <th>Importe</th>
          <th>Fecha Alta</th>
          <th>Fecha Baja</th>
        </tr>
    </tfoot>
  </table>
</div>
@endsection

@section('script')
	<script>

  $('#codigo').selectize({
      sortFiel: 'text'
    });

	$(document).ready(function() {
    $('#example').DataTable({
    	processing: true,
      serverSide: true,
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
      ajax: '{!! action("GeneralController@datatables") !!}',
      columns: [
          { data: 'nombre', name: 'nombre'},
          { data: 'marca_id', name: 'marca_id'},
          { data: 'modelo_id', name: 'modelo_id'},
          { data: 'nro_serie', name: 'nro_serie'},
          { data: 'id_patrimonial', name: 'id_patrimonial'},
          { data: 'detalle', name: 'detalle'},
          { data: 'importe', name: 'importe'},
          { data: 'fecha_alta', name: 'fecha_alta'},
          { data: 'fecha_baja', name: 'fecha_baja'}
      ],
      initComplete: function () {
          this.api().columns().every(function () {
              var column = this;
              var input = document.createElement("input");
              $(input).appendTo($(column.footer()).empty())
              .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column.search(val ? val : '', true, false).draw();
              });
          });
      }
    });
	});

  $('.cuenta .select').change(function(){
    $.ajax({
      url: '{!! url("stock") !!}',
      type: "post",
      data: {'codigo': $(this).val(), '_token': $('input[name=_token]').val()},
      success: function (data) {
        if (data.length == 1){
          $(".subcuenta").prop('disabled', true);

          $('.subcuenta').empty();

          $('.subcuenta').append("<option value='" + '0' + "'>" + 'Seleccionar Cuenta...' + "</option>");
        }else{
          $(".subcuenta").prop('disabled', false);

          $('.subcuenta').removeClass('selectize-input');
          
          var options = [];

          $.each(data, function(key, element) {
            options.push({
              id: key,
              nombre: element
            });
          });

          var select =
              $('#cuenta_codigo').selectize({
                valueField: 'id',
                labelField: 'nombre',
                searchField: 'nombre',
                options: options,
              });
        }
      }
    });
  });

  $(".subcuenta").change(function(){

    $( ".table" ).empty();

    html = "<table id='example' class='table table-condensed table-bordered table-striped'>";
    html += "<thead>";
    html += "<tr>";
    html += "     <th>Nombre</th>";
    html += "     <th>Marca</th>";
    html += "     <th>Modelo</th>";
    html += "     <th>Nro Serie</th>";
    html += "     <th>Nro Patrimonio</th>";
    html += "     <th>Detalle</th>";
    html += "     <th>Importe</th>";
    html += "     <th>Fecha Alta</th>";
    html += "     <th>Fecha Baja</th>";
    html += "    </tr>";
    html += "</thead>";
    html += "<tfoot>";
    html += "    <tr>";
    html += "     <th>Nombre</th>";
    html += "     <th>Marca</th>";
    html += "     <th>Modelo</th>";
    html += "     <th>Nro Serie</th>";
    html += "     <th>Nro Patrimonio</th>";
    html += "     <th>Detalle</th>";
    html += "     <th>Importe</th>";
    html += "     <th>Fecha Alta</th>";
    html += "     <th>Fecha Baja</th>";
    html += "    </tr>";
    html += "</tfoot></table>";

    $( ".table" ).append(html);

    $('#example').DataTable({
      processing: true,
      serverSide: true,
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
      ajax: '{!! url("datatables/' + $(this).val() + '") !!}',
      columns: [
          { data: 'nombre', name: 'nombre'},
          { data: 'marca_id', name: 'marca_id'},
          { data: 'modelo_id', name: 'modelo_id'},
          { data: 'nro_serie', name: 'nro_serie'},
          { data: 'id_patrimonial', name: 'id_patrimonial'},
          { data: 'detalle', name: 'detalle'},
          { data: 'importe', name: 'importe'},
          { data: 'fecha_alta', name: 'fecha_alta'},
          { data: 'fecha_baja', name: 'fecha_baja'}
      ],
      initComplete: function () {
          this.api().columns().every(function () {
              var column = this;
              var input = document.createElement("input");
              $(input).appendTo($(column.footer()).empty())
              .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column.search(val ? val : '', true, false).draw();
              });
          });
      }
    });
  });

	</script>
@endsection
