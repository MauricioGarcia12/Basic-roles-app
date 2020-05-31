<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth')->except('show');
       $this->middleware('roles:admin,mod')->except('edit','update','show');

   }

    public function index()
    {
        $users=User::with(['roles','note','tags'])->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id');

        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
         $user=User::create($request->all());
         //Se agregan los roles al nuevo usuario
         //Y como no es nuevo no tiene roles anteriores
         $user->roles()->attach($request->roles);
         return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hacer que aunque no sean usuarios vean los perfiles
        $user=User::findOrFail($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::findOrFail($id);

        //Mandamos para la autorizacion el nombre del metodo y la variable hacia la policy
        $this->authorize('edit',$user);
        
        //Obtener todos los roles el parametro y el id como llave
        $roles=Role::pluck('name','id');

        //Paramos las variables user y roles
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(UpdateUserRequest $request, $id)
    {
        $user=User::findOrFail($id);
        $user->update($request->only('name','email'));

        $this->authorize('update',$user);
//      Evitar duplicacion a la hora de actualizar los roles que ya estaban
        $user->roles()->sync($request->roles);

        return back()->with('info','Usuario Actualizado');
    }

   
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $this->authorize('destroy',$user);

        $user->delete();
        return back();
    }
}
