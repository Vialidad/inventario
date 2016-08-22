<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modelo;
use Illuminate\Http\Request;

use Datatables;

class ModeloController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$modelos = Modelo::latest()->get();
		return view('modelo.index', compact('modelos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('modelo.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Modelo::create($request->all());
		return redirect('modelo');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$modelo = Modelo::findOrFail($id);
		return view('modelo.show', compact('modelo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$modelo = Modelo::findOrFail($id);
		return view('modelo.edit', compact('modelo'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$modelo = Modelo::findOrFail($id);
		$modelo->update($request->all());
		return redirect('modelo');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Modelo::destroy($id);
		return redirect('modelo');
	}

	public function datatables() {

		$data = Modelo::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="modelo/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="modelo/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/modelo/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
