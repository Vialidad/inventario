<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Http\Controllers\Controller;
use App\Subcuenta;
use Illuminate\Http\Request;

use Datatables;

class SubCuentaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$subcuentas = Subcuenta::latest()->get();
		return view('subcuenta.index', compact('subcuentas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$cuenta = Cuenta::lists('nombre', 'codigo')->all(); //

		$cuenta = array('' => 'Seleccionar...') + $cuenta;

		return view('subcuenta.create', compact('cuenta'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Subcuenta::create($request->all());
		return redirect('subcuenta');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$subcuentum = Subcuenta::findOrFail($id);
		return view('subcuenta.show', compact('subcuentum'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$subcuentum = Subcuenta::findOrFail($id);
		return view('subcuenta.edit', compact('subcuentum'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request) {
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$subcuentum = Subcuenta::findOrFail($id);
		$subcuentum->update($request->all());
		return redirect('subcuenta');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		Subcuenta::destroy($id);
		return redirect('subcuenta');
	}

	public function datatables() {

		$data = Subcuenta::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="subcuenta/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="subcuenta/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/subcuenta/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
