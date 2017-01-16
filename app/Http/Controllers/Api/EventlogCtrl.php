<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use Carbon\Carbon;
use App\Eventlog;
use Log;

class EventlogCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req,$rel;

    public function __construct(Request $request)//Dependency injection
    {
        $this->req = $request;
        $this->rel=['users'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=Eventlog::with($this->rel)
            ->orderBy('created_at','asc')
            ->skip($ini)->take(50+$ini)->get();
        return $obj->toJson();
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
        $msj=$this->setMod();
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj=Eventlog::with($this->rel)->findOrFail($id);
        return $obj->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $msj= $this->setMod($id);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(['msj'=>'Los eventos no pueden ser eliminados.']);
    }
    
    /**
     * Guarda o modifica los registros
     *
     * @return \Illuminate\Http\Response
     */
    private function setMod($id=0){
        $resultado='Operación rechazada por falta de información';
        $obj=new Eventlog;   // Si es nuevo registro
        if($id>0){
            $obj=Eventlog::findOrFail($id); // Si es modificacion
        }   

        //////////////////////////////////////////////////////
        // Condiciones que se repiten sea modificación o nuevo
        // Este es el lugar que se debe modificar.

        if ($id) {
            $this->validate($this->req,[
                'level'=>'required',
                'desc'=>'required'
            ]);
        }else{
            $this->validate($this->req,[
                'level'=>'required',
                'desc'=>'required',
                'users_id'=>'required'
            ]);

        }
        $obj->level=$this->req->input('level');
        $obj->users_id=($this->req->has('users_id'))? $this->req->input('users_id') : $obj->users_id;
        $obj->desc=$this->req->input('desc');
        //$obj->cancelado_at=new Carbon($this->req->input('cancelado_at'));
        $obj->save();

        // De aqui para abajo no se toca nada
        ////////////////////////////////////


        // Guardar y finalizar
        if ($id>0) {
            $resultado='Modificación. Tabla=Eventlog, id='.$id;
        }else{
            $resultado='Elemento Creado. Tabla=Eventlog, id='.$obj->id;
        }
        return $resultado;
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
        $obj=Eventlog::all();
        return response()->json(['registros'=>$obj->count()]);
    }

    /**
     * Busca Eventlog con los periodos ID. Corelaciona a los alumnos con su nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($info){
        $obj=Eventlog::where('desc','LIKE','%'.$info.'%')
            ->orderBy('created_at','asc')
            ->take(200)
            ->with($this->rel)
            ->get();
        $msj='Busqueda. Tabla=Eventlog, letras='.$info;
        $ev=new EventlogRegister;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }

    /**
     * Muestra registros del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(){
        $obj=Eventlog::where('users_id',$this->req->user()->id)->orderBy('updated_at','desc')->take(50)->get();
        return $obj->toJson();
    }
}
