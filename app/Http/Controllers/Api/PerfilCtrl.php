<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use Carbon\Carbon;
use App\User;
use Log;

class PerfilCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req;
    protected $id;

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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id=$this->req->user()->id;
        $obj=User::with('tipo_usuario')->findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta el perfil id='.$id;
        $ev->registro(0,$msj,$id);
        return $obj->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update()
    {
        $id=$this->req->user()->id;
        $ev=new EventlogRegister;
        $ev->registro(1,'Intento de actualizar perfil id='.$id,$id);
        $obj=User::findOrFail($id);
        $this->validate($this->req,[
            'password'=>'required',
        ]);
        $obj->password=bcrypt($this->req->input('password'));
        $obj->save();
        $msj='Modifica la información del perfil id='.$id;
        $ev->registro(1,$msj,$id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    /////////////////////////////////////////////
    /////////// FUNCIONES ADICIONALES ///////////
    /////////////////////////////////////////////
}
