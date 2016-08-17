<?php

namespace App\Http\Controllers;

use App\Dependencia;
use App\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;

class DependenciaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$dependencias = Dependencia::latest()->get();
		return view('dependencia.index', compact('dependencias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('dependencia.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Dependencia::create($request->all());
		return redirect('dependencia');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$dependencia = Dependencia::findOrFail($id);

		$productos = Producto::Cargode($id,2)->get(); // id y tipo de destino 2 dependencia

		return view('dependencia.show', compact('dependencia','productos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$dependencia = Dependencia::findOrFail($id);
		return view('dependencia.edit', compact('dependencia'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$dependencium = Dependencia::findOrFail($id);
		$dependencium->update($request->all());
		return redirect('dependencia');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Dependencia::destroy($id);
		return redirect('dependencia');
	}

	public function datatables() {

		$data = Dependencia::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="dependencia/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="dependencia/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/dependencia/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
