<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\TipoUsuario;

class TipoCtrl extends Controller
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
        $obj=TipoUsuario::where('id','>',0)->orderBy('updated_at')->skip($ini)->take(50+$ini)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros de tipo de usuario.';
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }

    /**
     * Muestra numero de registros
     *
     * @return \Illuminate\Http\Response
     */
    public function count(){
        $obj=TipoUsuario::all();
        $col=collect(['registros'=>$obj->count()]);
        return $col->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'required',
        ]);
        $obj=new TipoUsuario;
        $obj->nombre=$request->input('nombre');
        $obj->save();
        $ev=new EventlogRegister;
        $msj='Tipo de usuario creado con id '.$obj->id;
        $ev->registro(1,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj=TipoUsuario::findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta el tipo de usuario id='.$id;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
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
        $obj=TipoUsuario::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required'
        ]);
        $obj->nombre=$request->input('nombre');
        $obj->save();
        $ev=new EventlogRegister;
        $msj='Modifica la información del tipo de usuario id='.$id;
        $ev->registro(1,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj=TipoUsuario::findOrFail($id);
        $obj->delete();
        $msj='Se ha borrado el registro de tipo de usuario id='.$obj->id;
        $ev=new EventlogRegister;
        $ev->registro(2,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }
}
