<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model {

	protected $table = 'proveedores';
	public $timestamps = true;
	protected $fillable = array('nombre');
	protected $visible = array('id' ,'nombre');

	public function scopeDatatables($query) {
		return $query->select('id', 'nombre');
	}

}