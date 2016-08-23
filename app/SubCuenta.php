<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCuenta extends Model {

	protected $table = 'sub_cuentas';
	public $timestamps = true;
	protected $fillable = array('cuenta_codigo', 'nombre', 'stock', 'codigo');
	protected $visible = array('id', 'cuenta_codigo', 'nombre', 'stock', 'codigo');

	public function cuenta() {
		return $this->belongsTo('App\Cuenta', 'cuenta_codigo', 'codigo');
	}

	public function scopeListasc($query, $cuenta_codigo) {
		return $query->select('nombre', 'id')->where('cuenta_codigo', $cuenta_codigo);
	}

	public function scopeDatatables($query) {
		return $query->select('id', 'cuenta_codigo', 'nombre', 'codigo');
	}
}