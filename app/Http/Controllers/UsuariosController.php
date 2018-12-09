<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Areas;
use Auth;
use Image;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $usuarios = User::all();
        $areas = Areas::all();
      return view('usuarios.index',compact('usuarios','areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Areas::all();
        return view('usuarios.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $user = User::find($request->id_user);
      if(!$user){
          $user = new User;
      }
      $user->name = $request->name;
      $user->email = $request->email;
      $user->areas_id = $request->area;
      $user->tipo = $request->tipo;
      $user->password =bcrypt($request->password);
      if($request->hasfile('file')){
            $avatar = $request->file('file');
            $filename =  time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(500,500)->save(public_path('img/avatar/'.$filename));
            $user->imagen = $filename;
      }else{
            $user->imagen = 'default.jpg';
      }
      $user->save();

        return response(['msg' => 'Se agrego usuarios', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $usuario = User::find($id);
      return view('usuarios.perfil',compact('usuario'));

    }


    public function update_avatar(Request $request)
    {

        if ($request->hasFile('imagen')) {
            $user = User::find(Auth::user()->id);
            $imagen = $request->file('imagen');
            $filename = time() . '.' . $imagen->getClientOriginalExtension();
            Image::make($imagen)->resize(160, 160)->save(public_path('/img/avatar/' . $filename));
            $user = Auth::user();
            $user->imagen = $filename;
            $user->save();
        }

        return redirect('home');
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
