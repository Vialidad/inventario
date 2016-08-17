<html>

<body>
<h1>NOTA DE TRANSFERENCIA Nº:&nbsp; {{ $data->codigo }}</h1>
<table width="100%"><br>
  <tr>
    <td>Transfiere:</td>
    <td>Dependencia que Transfiere:</td>
    <td>FECHA:</td>
  </tr>
  <tr>
    <td>{{ $data->transfiere }}</td>
    <td>{{ $data->transfiere_adependencia }}</td>
    <td>{{ $data->fecha }}</td>
  </tr>
  <tr>
    <td>Recibe:</td>
    <td>Dependencia que Recibe:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    @if($data->agente != null)
      <td>{{ $data->agente->apellido }} {{ $data->agente->nombre }}</td>
      <td>{{ $data->agente->dependencia->nombre }}</td>  
    @endif

    @if($data->deposito != null)
      <td>{{ $data->deposito->nombre }}</td>
      <td>{{ $data->deposito->dependencia->nombre }}</td>  
    @endif

    @if($data->dependencia != null)
      <td>{{ $data->dependencia->nombre }}</td>
      <td>{{ $data->dependencia->nombre }}</td>  
    @endif
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table border="1" width="100%">
  <tr>
    <th>Cant.</th>
    <th>UM</th>
    <th>Denominacion</th>
    <th>Caracteristicas</th>
    <th>Cod. Ident.</th>
    <th>Nº P9</th>
    <th>Pr.Unit.</th>
  </tr>
   @foreach($data->producto as $item)    
      <tr>
          <td>&nbsp; 1</td>
          <td>&nbsp; un </td>
          <td>&nbsp;{{ $item->subcuenta->nombre }} </td>
          <td>  
              <p>&nbsp; Marca:{{ $item->marca->nombre }}</p>
          		<p>&nbsp; Modelo:{{ $item->modelo->nombre }}</p> 
              <p>&nbsp; Detalle: {{ $item->detalle }}</p>
          </td>
          <td>&nbsp; {{ $item->id_patrimonial }}</td>
          <td>&nbsp; {{ $item->carga->cod_p9 }}</td>
          <td>&nbsp;$ {{ $item->importe }}</td>
      </tr>
    @endforeach
</table>
<br></br><br></br><br></br><br></br>
<table width="100%" border="0">
  <tr>
    <th align="center" valign="middle" scope="col">----------------------</th>
    <th align="center" valign="middle" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th align="center" valign="middle" scope="col">----------------------</th>
    <th align="center" valign="middle" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th align="center" valign="middle" scope="col">----------------------</th>
    <th align="center" valign="middle" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th align="center" valign="middle" scope="col">----------------------</th>
    <th align="center" valign="middle" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th align="center" valign="middle" scope="col">----------------------</th>
  </tr>
  <tr>
    <td align="center"><p>Despachante</p>
    <p>Jefe Deposito</p></td>
    <td align="center">&nbsp;</td>
    <td align="center"><p>Vº Bª Jefe Depend.</p>
    <p>que Transfiere</p></td>
    <td align="center">&nbsp;</td>
    <td align="center"><p>Conf. Respons</p>
    <p>de Transporte</p></td>
    <td align="center">&nbsp;</td>
    <td align="center"><p>Conforme</p>
    <p>Receptor</p></td>
    <td align="center">&nbsp;</td>
    <td align="center"><p>Vº Bº Depend.</p>
    <p>que Recepciona</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
