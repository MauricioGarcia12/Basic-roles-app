<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Message;
use App\User;
use Mail;
use App\Mail\MessageReceived;
use App\Events\MessageWasReceived;
class MessagesController extends Controller
{
    public function __construct(){
        //Cuales metodos se veran sin estar login
        $this->middleware('auth')->except('create,store');
    }

    public function index()
    {

        $messages=Message::with(['user','note','tags'])->get();
        return view('messages.index',compact('messages'));
    }

   
    public function create()
    {
        

        return view('messages.create');
    }

  
    public function store(Request $request)
    {
        $message=Message::create($request->all());

        if(auth()->check())
        {
            auth()->user()->messages()->save($message);
        }
        

        event(new MessageWasReceived($message));
        //redireccionar
        return redirect()->route('messages.create')->with('info','We received your message');
    }

   
    public function show($id)
    {
        $message=Message::findorFail($id);//Manda error a la carpeta errors y su vista por error
        return view('messages.show',compact('message'));
    }

    
    public function edit($id)
    {
        $message=Message::findorFail($id);//Manda error a la carpeta errors y su vista por error
        return view('messages.edit',compact('message'));
    }

   
    public function update(Request $request, $id)
    {
        
        $message=Message::findorFail($id);//Manda error a la carpeta errors y su vista por error
        $message->update($request->all());
        return redirect()->route('messages.index');

        
    }

   
    public function destroy($id)
    {
        $message=Message::findorFail($id);//Manda error a la carpeta errors y su vista por error
        $message->delete();
        return redirect()->route('messages.index');
    }
}
