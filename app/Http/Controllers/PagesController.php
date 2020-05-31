<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('ejemplo')->only('home');

    }
    public function home(){
        return view('home');
    }
  
    public function saludos($nombre='invitado'){
        return view('saludo',compact('nombre'));
    }

    public function mensajes(CreateMessageRequest $request){
        

       $data=$request->all(); //procesar los datos del formulario

       //redireccionando
       return redirect()
       ->route('contacto')
       ->with('info','Tu mensaje ha sido enviado correctamente');

    }
}
