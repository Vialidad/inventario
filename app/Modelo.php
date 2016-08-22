<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model {

	protected $table = 'modelos';
	public $timestamps = true;
	protected $fillable = array('nombre');
	protected $visible = array('id','nombre');

	public function producto()
	{
		return $this->hasMany('App\Producto');
	}

	public function scopeDatatables($query) {
		return $query->select('id', 'nombre');
	}

}