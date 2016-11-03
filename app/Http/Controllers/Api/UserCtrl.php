<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\User;
use Log;

class UserCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req;

    public function __construct(Request $request)//Dependency injection
    {
        $this->req = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=User::where('id','>',1)->with('tipo_usuario')->orderBy('updated_at')->skip($ini)->take(50+$ini)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros de usuarios.';
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
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
    public function store()
    {
        $ev=new EventlogRegister;
        return response()->json($this->req->all());
        $ev->registro(1,'Intento de guardar usuario.',$this->req->user()->id);
        $this->validate($this->req,[
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'password'=>'required',
            'identificacion'=>'required | unique:users',
            'birday'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'tipo_sangre'=>'required',
            'tipo_usuario_id'=>'required',
            'estado'=>'required'
        ]);
        $obj=User::create($this->req->all());
        $msj='Usuario creado con id '.$obj->id;
        $ev->registro(1,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $obj=User::with('tipo_usuario')->findOrFail($user);
        $ev=new EventlogRegister;
        $msj='Consulta el usuario id='.$user;
        $ev->registro(0,$msj,$this->req->user()->user);
        return $obj->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update($user)
    {
        dd($this->req);
        $ev=new EventlogRegister;
        $ev->registro(1,'Intento de actualizar usuario id='.$user,$this->req->user()->user);
        $obj=User::findOrFail($user);
        if($this->req->has('password')){
            $obj->password=bcrypt($this->req->input('password'));
            $obj->save();
        }else{
            $this->validate($this->req,[
                'name'=>'required',
                'lastname'=>'required',
                'email'=>'required',
                'identificacion'=>'required',
                'birday'=>'required',
                'telefono'=>'required',
                'direccion'=>'required',
                'acudiente'=>'required',
                'tipo_sangre'=>'required',
                'tipo_usuario_id'=>'required',
                'estado'=>'required'
            ]);
            $obj->name=$this->req->input('name');
            $obj->lastname=$this->req->input('lastname');
            $obj->email=$this->req->input('email');
            $obj->identificacion=$this->req->input('identificacion');
            $obj->birday=$this->req->input('birday');
            $obj->telefono=$this->req->input('telefono');
            $obj->direccion=$this->req->input('direccion');
            $obj->acudiente=$this->req->input('acudiente');
            $obj->tipo_sangre=$this->req->input('tipo_sangre');
            $obj->estado=$this->req->input('estado');
            $obj->tipo_usuario_id=$this->req->input('tipo_usuario_id');
            $obj->save();
        }
        $msj='Modifica la información del usuario id='.$user;
        $ev->registro(1,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        dd($this->req);
        $ev=new EventlogRegister;
        $ev->registro(2,'Intento de eliminar usuario. id='.$user,$this->req->user()->id);
        if ($user==1) {
            return response()->json(['msj'=>'No se puede eliminar al administrador']);
        }
        $obj=User::findOrFail($user);
        $obj->delete();
        $msj='Se ha borrado el registro '.$obj->id;
        $ev->registro(2,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }

    /////////////////////////////////////////////
    /////////// FUNCIONES ADICIONALES ///////////
    /////////////////////////////////////////////
   
    /**
     * Muestra numero de registros
     *
     * @return \Illuminate\Http\Response
     */
    public function count(){
        $obj=User::all();
        $col=collect(['registros'=>$obj->count()]);
        return $col->toJson();
    }

    /**
     * Busca los objetos que coincidan.
     *
     * @param  int  $info
     * @return \Illuminate\Http\Response
     */
    public function search($info) // Falta esto
    {
        //$obj=User::findOrFail($id);
        $msj='Se han buscado los registros con letras: '.$info;
        $ev=new EventlogRegister;
        $ev->registro(2,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }
}
