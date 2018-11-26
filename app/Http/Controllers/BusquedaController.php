<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Persona;
use App\Areas;

class BusquedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('consultar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    public function detalles($id)
      {
            $persona = Persona::where('dni',$id)->first();
            $documento = Documento::where('persona_id',$persona->id)->get();
            $cont= 0;
            $est=0;
            foreach ($documento as $doc) {
            $cont++;
            $area[''.$cont] = json_decode($doc->area->nombre);
            if($doc->estado == 0 ){
              $estado[''.$est] = "ACTIVO";
              $est++;
            }

            if($doc->estado == 1 ){
              $estado[''.$est] = "FINALIZADO";
              $est++;
            }

            if($doc->estado == 2 ){
              $estado[''.$est] = "ARCHIVADO";
              $est++;
            }
            }
            return compact('documento','cont','area','estado');
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
