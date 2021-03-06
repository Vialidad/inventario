<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Subcuenta;
use App\Carga;
use App\Transferencia;
use App\Salida_Material;
use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Request;

class GeneralController extends Controller {

	public function stock(Request $request) {

		$cuenta = Cuenta::lists('nombre', 'codigo')->all();

		$cuenta = array('' => 'Seleccionar...') + $cuenta;

		if ($request->ajax()) {

			$subcuenta = $this->listaSubcuenta($request->codigo);

			return response()->json($subcuenta);

		}

		return view('stock', compact('cuenta'));
	}

	public function datatables($id = 0) {

		$data = Producto::Datatables($id)->get();

		return Datatables::of($data)
			->editColumn('nombre', function ($data) {
			 	return '<a href="producto/'.$data->id.'" >'. $data->nombre .'</a>';
			})
			->editColumn('marca_id', function ($data) {
				return $data->marca->nombre;
			})
			->editColumn('modelo_id', function ($data) {
				return $data->modelo->nombre;
			})
			->editColumn('subcuenta_id', function ($data) {
				return $data->subcuenta->nombre;
			})
			->editColumn('fecha_alta', function ($data) {
				if ($data->fecha_alta != null) {
					return Carbon::createFromFormat('Y-m-d', $data->fecha_alta)->format('d/m/Y');
				} else {
					return $data->fecha_alta;
				}
			})
			->editColumn('fecha_baja', function ($data) {
				if ($data->fecha_baja != null) {
					return Carbon::createFromFormat('Y-m-d', $data->fecha_baja)->format('d/m/Y');
				} else {
					return $data->fecha_baja;
				}
			})
			->make(true);

	}

	public function imprimirp9($id){

		$data = Carga::find($id);

		$view =  \View::make('p9', compact('data'))->render();
        
        $pdf = \App::make('dompdf.wrapper');
        
        $pdf->loadHTML($view);
        
        return $pdf->stream('p9 '.$data->cod_p9);
	}

	public function imprimirTransferencia($id){

		$data = Transferencia::find($id);

		$view =  \View::make('n_transf', compact('data'))->render();
        
        $pdf = \App::make('dompdf.wrapper');
        
        $pdf->loadHTML($view);
        
        return $pdf->stream('n_transf '.$data->codigo);
	}

	public function imprimirSalida($id){

		$data = Salida_Material::find($id);

		$view =  \View::make('n_transf', compact('data'))->render();
        
        $pdf = \App::make('dompdf.wrapper');
        
        $pdf->loadHTML($view);
        
        return $pdf->stream('n_salida '.$data->codigo);
	}

	private function listaSubcuenta($cuenta_codigo = 0) {

		$query = Subcuenta::Listasc($cuenta_codigo)->get();

		$lista = array(0 => 'Seleccionar...');

		foreach ($query as $s) {
			$lista = $lista + array($s->id => $s->nombre);
		}

		return $lista;
	}


}
