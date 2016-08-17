<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Agente;
use App\Dependencia;
use App\Deposito;
use App\Producto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Datatables;

class DepositoController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$depositos = Deposito::latest()->get();
		return view('deposito.index', compact('depositos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$agente = Agente::lists('nombre', 'id')->all();
		
		$agente = array('' => 'Seleccionar...') + $agente;

		$dependencia = Dependencia::lists('nombre', 'id')->all();
		
		$dependencia = array('' => 'Seleccionar...') + $dependencia;
		
		return view('deposito.create', compact('agente', 'dependencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if you need to validate any input.
		Deposito::create($request->all());
		return redirect('deposito');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$deposito = Deposito::findOrFail($id);

		$productos = Producto::Cargode($id,1)->get(); // id y tipo de destino 1 deposito

		return view('deposito.show', compact('deposito','productos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deposito = Deposito::findOrFail($id);
		return view('deposito.edit', compact('deposito'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if you need to validate any input.
		$deposito = Deposito::findOrFail($id);
		$deposito->update($request->all());
		return redirect('deposito');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Deposito::destroy($id);
		return redirect('deposito');
	}

	public function datatables() {

		$data = Deposito::Datatables()->get();

		return Datatables::of(collect($data))
		->editColumn('nombre', function ($data) {
			 	return '<a href="deposito/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->addColumn('action', function ($data) {
		                return '<a href="deposito/'.$data->id.'/edit" class="btn btn-xs btn-primary">Edit</a>' . ' / <form method="POST" action="http://localhost/inventario/deposito/ ' .$data->id. '" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'. csrf_token() .'"><button type="submit" class="btn btn-danger btn-xs">Borrar</button></form>';
            })
			->make(true);

	}

}
