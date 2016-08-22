<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Proveedor;
use Illuminate\Http\Request;

use Datatables;

class ProveedoreController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$proveedores = Proveedor::latest()->get();
		return view('proveedor.index', compact('proveedores'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('proveedor.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Proveedor::create($request->all());
		return redirect('proveedor');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$proveedor = Proveedor::findOrFail($id);
		return view('proveedor.show', compact('proveedor'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$proveedor = Proveedor::findOrFail($id);
		return view('proveedor.edit', compact('proveedor'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$proveedor = Proveedor::findOrFail($id);
		$proveedor->update($request->all());
		return redirect('proveedor');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Proveedor::destroy($id);
		return redirect('proveedor');
	}

	public function datatables() {

		$data = Proveedor::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="proveedor/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="proveedor/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/proveedor/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
