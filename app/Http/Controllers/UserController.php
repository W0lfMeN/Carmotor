<?php

namespace App\Http\Controllers;

use App\Mail\InformacionMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retornamos la vista de users
        try {
            $users=User::where('id', '!=', Auth::user()->id)->sortable()->paginate(5)->withQueryString();
        } catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
            dd($e);
        }
        return view('adminDirectory.users.indexUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminDirectory.users.createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        //Como hay una funcion creada por Livewire que ya hace toda la validacion, se envía el request a dicha funcion
        $request->validate([
            'name' => ['required', 'string'],
            'apellidos'=>['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],

            'calle' =>['required', 'string', 'max:255'],
            'cp' =>['required', 'digits:5'],
            'poblacion' =>['required', 'string', 'max:255'],
            'provincia' =>['required', 'string', 'max:255'],
            'rol'=>['nullable'],

            'password' => ['required', 'string','confirmed', 'min:8'],
        ]);
        /* dd($request->all()); */

        User::create([
            'name' =>$request['name']." ".$request['apellidos'],
            'email' => $request['email'],
            'direccion'=> $request['calle'].", ".$request['cp'].", ".$request['poblacion'].", ".$request['provincia'],
            'rol'=>$request['rol'] ?? 1,
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('users.index')->with('mensaje', 'Usuario Creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('adminDirectory.users.showUser', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('adminDirectory.users.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $contenidoDelCorreo=[
            "mensaje"=>"Nos ponemos en contacto con usted para notificarle de que su cuenta ha sido suspendida debido a un incumplimiento de nuestras politicas.
                        Lamentamos este incidente pero debemos de mantener una serie de normas para evitar problemas.",

            "usuario"=>$user->name
        ];

        $correo = new InformacionMailable($contenidoDelCorreo);

        try{
            Mail::to($user->email)->send($correo);
        }catch(\Exception $ex){

        }


        $nombre=$user->name;
        //Borramos el usuario indicado junto con la posible foto de perfil que tuviese
        $user->deleteProfilePhoto();
        $user->tokens->each->delete(); # se borra su token
        $user->delete();

        return redirect()->route('users.index')->with('mensaje', "Usuario $nombre borrado e informado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function rol(User $user){

        $rolActual=$user->rol;

        /* dd($user); */
        if($rolActual==1)
            $user->update(["rol"=>2]);
        else{
            $user->update(["rol"=>1]);
        }

       

        return redirect()->route('users.index')->with('mensaje', "Se ha cambiado el rol del usuario correctamente");
    }
}
