<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventario App</title>
	{!! Html::style('public/assets/Bootstrap-3.3.5/css/bootstrap.min.css') !!}

	{!! Html::style('public/assets/DataTables-1.10.9/css/jquery.dataTables.min.css') !!}

	{!! Html::style('public/assets/css/selectize.default.css') !!}
	
	@yield('style')
	
	<style>
		body {
			padding-top: 70px;
		}

		/* Estilo por defecto */
		.valid{
			border: 1px solid green;
	  	}

	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	    <div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="{{ url('/')}}">Inventario App</a>
	        </div>

			<div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					 <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Inventario <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			          	<li><a href="{{ url('/carga/create') }}">Alta</a></li>
			          	<li><a href="{{ url('/carga') }}">Baja</a></li>
			          	<li><a href="{{ url('/stock') }}">Stock</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transferencia <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			          	<li><a href="{{ url('/transferencia/create') }}">Transferencia</a></li>
			          	<li><a href="{{ url('/salida_material/create') }}">Salida de Material</a></li>
			          </ul>
			        </li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
						<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				          	<li><a href="{{ url('/agente')}}">Agente</a></li>
				          	<li><a href="{{ url('/cuenta')}}">Cuenta</a></li>
				          	<li><a href="{{ url('/dependencia')}}">Dependencia</a></li>
				          	<li><a href="{{ url('/deposito')}}">Deposito</a></li>
				          	<li><a href="{{ url('/marca')}}">Marca</a></li>
				          	<li><a href="{{ url('/modelo')}}">Modelo</a></li>
				          	<li><a href="{{ url('/producto')}}">Producto</a></li>
				          	<li><a href="{{ url('/proveedor')}}">Proveedor</a></li>
							<li><a href="{{ url('/subcuenta')}}">SubCuenta</a></li>
				            <li><a href="{{ url('/transferencia')}}">Transferencia</a></li>
				            <li><a href="{{ url('/salida_material')}}">Salida de Material</a></li>
				          </ul>
				        </li>
						<li><a href="#">{{ Auth::user()->name }}</a></li>
						<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					@endif
				</ul>
			</div>

	    </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		@yield('content')
	</div>

	<hr/>

	<div class="container">
	    &copy; {{ date('Y') }}. Vialidad Provincial<br/>
	</div>

	<!-- Scripts -->
	{!! Html::script('public/assets/js/jquery.min.js') !!}

	{!! Html::script('public/assets/js/bootstrap.min.js') !!}
	
	{!! Html::script('public/assets/js/selectize.min.js') !!}

	{!! Html::script('public/assets/DataTables-1.10.9/js/jquery.dataTables.min.js') !!}

	@yield('script')

</body>
</html>
