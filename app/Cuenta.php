<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model {

	protected $table = 'cuentas';
	public $timestamps = true;
	protected $fillable = array('nombre', 'codigo');
	protected $visible = array('id', 'nombre', 'codigo');

	public function subcuentas()
	{
		return $this->hasMany('App\SubCuenta', 'cuenta_codigo', 'codigo');
	}

	public function scopeDatatables($query) {
		return $query->select('id', 'nombre', 'codigo');
	}
}