<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Marca;
use Illuminate\Http\Request;

use Datatables;

class MarcaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$marcas = Marca::latest()->get();
		return view('marca.index', compact('marcas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('marca.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Marca::create($request->all());
		return redirect('marca');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$marca = Marca::findOrFail($id);
		return view('marca.show', compact('marca'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$marca = Marca::findOrFail($id);
		return view('marca.edit', compact('marca'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$marca = Marca::findOrFail($id);
		$marca->update($request->all());
		return redirect('marca');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Marca::destroy($id);
		return redirect('marca');
	}

	public function datatables() {

		$data = Marca::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="marca/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="marca/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/marca/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
