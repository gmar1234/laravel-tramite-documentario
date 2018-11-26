<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Persona;
use App\Movimiento;
use Image;
use Session;
use App\Areas;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $documento = Documento::where('areas_id',auth()->user()->areas_id)->get();
      $areas = Areas::all();
      return view('documentos.index',compact('documento','areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documentos.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $persona =  new Persona;
    $persona ->dni =$request->documento;
    $persona ->nombres =$request->nombres;
    $persona ->apellidos =$request->apellidos;
    $persona->save();
    $persona = Persona::all()->last();
    $id_persona=$persona->id;

    $documento =  new Documento;
    $documento ->codigo =$request->codigo;
    $documento ->asunto =$request->asunto;
    $documento ->estado ='0';
    $documento ->visto =1;
    $documento ->descipcion =$request->descripcion;

    if($request->hasfile('file')){
          $avatar = $request->file('file');
          $filename =  time() . '.' .$avatar->getClientOriginalExtension();
          Image::make($avatar)->resize(500,500)->save(public_path('uploads/'.$filename));
          $documento->imagen = $filename;
    }else{
          $documento->imagen = 'default.jpg';
    }
    $documento ->persona_id =$id_persona;
    $documento ->areas_id =  auth()->user()->areas_id;
    $documento->save();
    Session::flash('registro','Se registro empeño');
    return redirect()->action('DocumentoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
              $documento = Documento::find($id);
              $movimientos = Movimiento::where('documento_id',$documento->id)->get();
              return view('documentos.detalles',compact('movimientos','documento'));
    }


    public function notificacion($id)
    {
              $documento = Documento::find($id);
              $documento->visto=1;
              $movimientos = Movimiento::where('documento_id',$documento->id)->get();
              $documento->update();
              return view('documentos.detalles',compact('movimientos','documento'));
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


    public function enviar(Request $request ){

      $documento = Documento::find($request->id_documento_md);
      $area_s = Areas::find($documento->areas_id);
      $area_e = Areas::find($request->area);
      $documento->areas_id = $request->area;
      $documento->visto=0;
      $documento->update();

      $movimientos = new Movimiento ;
      $movimientos->area_salida=$area_s->nombre;
      $movimientos->area_entrada=$area_e->nombre;
      $movimientos->documento_id=$request->id_documento_md;
      $movimientos->save();
      return response(['msg' => 'Se envio al area correspondiente', 'status' => 'success']);

    }


    public function estado(Request $request ){
        $documento = Documento::find($request->id_documento_md_es);
        $documento->estado= $request->estado;
        $documento->update();
      return response(['msg' => 'Se modifico el estado correctamente', 'status' => 'success']);
    }

    public function autocompletesPersona(Request $request)
    {

        $term = $request->term;
        $data = Persona::where('dni', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->get();
        $result = array();
        foreach ($data as $key => $value) {
            $result[] = ['nombres' => $value->nombres, 'value' => $value->documento, "apellidos" => $value->apellidos];
        }
        return \Response::json($result);;

    }
}
