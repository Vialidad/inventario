<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Marca;
use App\Modelo;
use App\Deposito;
use App\Agente;
use App\Dependencia;
use App\Producto;
use App\Subcuenta;
use DB;
use Datatables;
use Illuminate\Http\Request;

class ProductoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$productos = Producto::latest()->get();
		return view('producto.index', compact('productos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {

		$subcuenta = SubCuenta::lists('nombre', 'id')->all(); //

		$subcuenta = array('' => 'Seleccionar...') + $subcuenta;

		$marca = Marca::lists('nombre', 'id')->all(); //

		$marca = array('' => 'Seleccionar...') + $marca;

		$modelo = Modelo::lists('nombre', 'id')->all(); //

		$modelo = array('' => 'Seleccionar...') + $modelo;

		return view('producto.create', compact('subcuenta', 'marca', 'modelo'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Producto::create($request->all());
		return redirect('producto');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$producto = Producto::findOrFail($id);

		if($producto->tip_destino == 1){
			$ubicacion = Deposito::findOrFail($producto->cod_destino);	
		}

		if($producto->tip_destino == 2){
			$ubicacion = Dependencia::findOrFail($producto->cod_destino);	
		}

		if($producto->tip_destino == 3){
			$ubicacion = Agente::findOrFail($producto->cod_destino);	
		}

		if($producto->tip_destino == 4){
			$ubicacion = Producto::findOrFail($producto->cod_destino);	
		}		

		return view('producto.show', compact('producto', 'ubicacion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$producto = Producto::findOrFail($id);
		return view('producto.edit', compact('producto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$producto = Producto::findOrFail($id);
		$producto->update($request->all());
		return redirect()->route('carga.show',[$producto->carga_id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Producto::destroy($id);
		return redirect('producto');
	}

	public function datatables() {

		$data = DB::table('productos')
			->selectRaw
			(
				'productos.id,productos.nombre, productos.nro_serie, '
				. 'productos.id_patrimonial'
			)
			->get();

		return Datatables::of(collect($data))
			->editColumn('nombre', function ($data) {
			 	return '<a href="producto/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="producto/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/producto/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
