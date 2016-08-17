<?php

namespace App\Http\Controllers;

use App\Agente;
use App\Dependencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;
use App\Producto;
use DB;

class AgenteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return view('agente.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$dependencia = Dependencia::where('es_int','si')->lists('nombre', 'id')->all();

		$dependencia = array('' => 'Seleccionar...') + $dependencia;

		return view('agente.create',compact('dependencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Agente::create($request->all());
		return redirect('agente');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$agente = Agente::findOrFail($id);

		$productos = Producto::Cargode($id,3)->get(); //id y tipo de destino 3 agente

		return view('agente.show', compact('agente','productos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$agente = Agente::findOrFail($id);
		return view('agente.edit', compact('agente'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$agente = Agente::findOrFail($id);
		$agente->update($request->all());
		return redirect('agente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Agente::destroy($id);
		return redirect('agente');
	}

	public function datatables() {

		$data = DB::table('agentes')
			->selectRaw
			(
				'agentes.id, agentes.legajo, '
				. 'CONCAT(agentes.apellido," ",agentes.nombre) as agente, '
				. '(SELECT dependencias.nombre FROM dependencias WHERE '
				.		'dependencias.id = agentes.dependencia_id) AS dependencia'
			)
			->get();

		return Datatables::of(collect($data))
			->editColumn('legajo', function ($data) {
			 	return '<a href="agente/'.$data->id.'" >'. $data->legajo .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="agente/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/agente/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
