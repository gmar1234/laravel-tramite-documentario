<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Documento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $documento = Documento::where('areas_id',auth()->user()->areas_id)->get();


      return view('home',compact('documento'));
    }
}
