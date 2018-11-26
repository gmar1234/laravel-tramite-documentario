<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Persona;
use App\Movimiento;
use App\Areas;
use Yajra\DataTables\Datatables;


class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('areas.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $areas = Areas::find($request->id_categoria);
      if(!$areas){
          $areas = new Areas;
      }
      $areas->nombre = $request->nom_categoria;
      $areas->descripcion = $request->des_categoria;
      $areas->save();
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
    }
    public function datos($id)
      {
          return Areas::find($id);
      }
    public function dataCategoria()
{

    $categoria = Areas::all();
    return Datatables::of($categoria)->addColumn('action', function ($categoria) {
        return '<a  onclick="editarForm(' . $categoria->id . ')" class="btn btn-negro btn-xs" style="margin-right: 10px;margin-left: 9px;"> <i class="fa fa-edit"></i></a>' . '<a onclick="eliminarForm(' . $categoria->id . ')" class="btn btn-negro btn-xs"> <i class="fa fa-trash"></i></a>';
    })->make(true);
//        $orders=Sucursal::all();
//      return \Datatables::of($orders)->make(true) ;
}
}
