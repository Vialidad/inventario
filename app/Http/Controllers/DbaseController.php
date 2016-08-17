<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dependencia;

class DbaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conex = dbase_open('C:\Copia de depende.DBF', 0);

        $total_registros = dbase_numrecords($conex);

        for ($i = 1; $i <= $total_registros; $i++)
        {
            if(trim(dbase_get_record($conex,$i)[1]) != "")//elimino espacio en blanco trim
            {
                $dependecia = new Dependencia;
        
                $dependecia->nombre = dbase_get_record($conex,$i)[1];

                $dependecia->es_int = 'si';

                $dependecia->save();    
            }
        }
        
        return redirect('/');

    }

    public function prueba()
    {
        $conex = dbase_open('C:\mficha.DBF', 0);

        //return dbase_get_header_info($conex);

        $total_registros = dbase_numrecords($conex);

        for ($i = 1; $i <= $total_registros; $i++)
        {
            
            echo dbase_get_record($conex,$i)[0] . '<br>';
  
        }
    }
}
