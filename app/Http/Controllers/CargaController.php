<?php

namespace App\Http\Controllers;

use App\Carga;
use App\Cuenta;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Modelo;
use App\Deposito;
use App\Producto;
use App\Proveedor;
use App\SubCuenta;
use Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CargaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$cargas = Carga::latest()->get();
		return view('carga.index', compact('cargas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request) {

		$cuenta = Cuenta::lists('nombre', 'codigo')->all();

		$cuenta = array('' => 'Seleccionar...') + $cuenta;

		if ($request->ajax()) {

			$subcuenta = $this->listaSubcuenta($request->codigo);

			return response()->json($subcuenta);

		}
		$subcuenta = "";
		//$subcuenta = SubCuenta::lists('nombre', 'id')->all(); //

		//$subcuenta = array('' => 'Seleccionar...') + $subcuenta;

		$proveedor = Proveedor::lists('nombre', 'id')->all(); //

		$proveedor = array('' => 'Seleccionar...') + $proveedor;

		$deposito = Deposito::lists('nombre', 'id')->all(); //

		$deposito = array('' => 'Seleccionar...') + $deposito;

		$marca = Marca::lists('nombre', 'id')->all(); //

		$marca = array('' => 'Seleccionar...') + $marca;

		$modelo = Modelo::lists('nombre', 'id')->all(); //

		$modelo = array('' => 'Seleccionar...') + $modelo;

		return view('carga.create', compact('proveedor', 'cuenta', 'subcuenta', 'marca', 'modelo', 'deposito'));
	}

	private function listaSubcuenta($cuenta_codigo = 0) {

		$lista	=	Subcuenta::where('cuenta_codigo', $cuenta_codigo)
					->lists('nombre', 'id')->all();

		$lista = array('' => 'Seleccionar...') + $lista;

		return $lista;
	}
	/**
	 * Store a newly created resource in storage.
	 * $_POST
	 * @return Response
	 */
	public function store(Request $request) {

		$this->validate($request, [
	        'fecha' => 'required',
	        'tipo_comp' => 'not_in:0',
	        'nro' => 'required',
	        'proveedor' => 'required',	        
	    ]);

		$carga = new Carga;

		$carga->fecha = $request['fecha'];
		$carga->tipo_comp = $request['tipo_comp'];
		$carga->nro = $request['nro'];
		$carga->proveedor_id = $request['proveedor'];
		$carga->cod_p9 = $request['cod_p9'];
		$carga->cantidad = sizeof($request['cantidad']);

		if ($carga->save()) {
			$this->cargaproducto($request, $carga->id);
		}

		return redirect('carga');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$carga = Carga::findOrFail($id);
		return view('carga.show', compact('carga'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$carga = Carga::findOrFail($id);
		return view('carga.edit', compact('carga'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$carga = Carga::findOrFail($id);
		$carga->update($request->all());
		return redirect('carga');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$carga = Carga::findOrFail($id);

		foreach ($carga->producto as $producto) {
			$subcuenta = SubCuenta::find($producto->subcuenta_id);
			$subcuenta->stock = $subcuenta->stock - 1;
			$subcuenta->save();

			Producto::destroy($producto->id);
		}

		Carga::destroy($id);
		return redirect('carga');
	}

	public function datatables() {

		$data = Carga::Datatables()->get();

		return Datatables::of($data)
			->addColumn('action', function ($data) {
                return '<a href="carga/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/carga/' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden"  value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';


            })
			->editColumn('fecha', function ($data) {
			 	return '<a href="carga/'.$data->id.'" >'. Carbon::createFromFormat('Y-m-d', $data->fecha)->format('d/m/Y') .'</a>';
			})
			->editColumn('importe', function ($data) {
			 	return "$ " . $data->importe;
			})
			->make(true);

	}

	public function validarP9(Request $request){

		if ($request->ajax()) {
			$repite = 0;
			
			$repite = Carga::where('cod_p9', $request->p9)->count();	
			
			return response()->json(['repetido' => $repite]);

		}
	}

	public function validarNp(Request $request){

		if ($request->ajax()) {
			$repite = 0;
			
			$repite = Producto::where('id_patrimonial', $request->np)->count();	
			
			return response()->json(['repetido' => $repite, 'id' => $request->id]);

		}
	}

	private function cargaproducto($request, $id) {

		$sum = 0;

		foreach ($request['nombre'] as $key => $value) {
			// Sumar a Stock
			$subcuenta = SubCuenta::find($request['subcuenta'][$key]);
			$subcuenta->stock = 1 + $subcuenta->stock;
			$subcuenta->save();

			// Guardo producto
			$producto = new Producto;

			$producto->subcuenta_id = $request['subcuenta'][$key];
			$producto->nombre = $value;
			$producto->marca_id = $request['marca'][$key];
			$producto->modelo_id = $request['modelo'][$key];
			$producto->nro_serie = $request['nro_serie'][$key];
			//$producto->detalle = $request['detalle'][$key]; no esta en la tabla producto
			$producto->carga_id = $id;
			$producto->fecha_alta = $request['fecha'];
			$producto->id_patrimonial = $request['nro_patrimonio'][$key];
			$producto->importe = $request['importe'][$key];
			$producto->detalle = $request['detalle'][$key];
			$producto->cod_destino = $request['deposito'];
			$producto->tip_destino = '1'; // porq solamente cargamos en almacen informatica por el momento

			$producto->save();

			//sumar importe
			$sum = $request['importe'][$key] + $sum;
		}

		//actualiza el importe
		$carga = Carga::find($id);
		$carga->importe = $sum;
		$carga->save();
	}

}
