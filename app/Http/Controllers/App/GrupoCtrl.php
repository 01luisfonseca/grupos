<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\Grupo;

class GrupoCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req,$rel;

    public function __construct(Request $request)//Dependency injection
    {
        $this->req = $request;
        $this->rel=['territorio'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=Grupo::skip($ini)->take(50+$ini)->with($this->rel)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros. Tabla=Grupo.';
        $ev->registro(0,$msj,$this->req->user()->id);
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
        $ev->registro(1,'Intento de guardar en tabla=Grupo.',$this->req->user()->id);
        $msj=$this->setMod();
        $ev->registro(1,$msj,$this->req->user()->id);
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
        $obj=Grupo::with($this->rel)->findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta de elemento. Tabla=Grupo, id='.$id;
        $ev->registro(0,$msj,$this->req->user()->id);
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
        $ev=new EventlogRegister;
        $ev->registro(1,'Intento de modificación. Tabla=Grupo, id='.$id,$this->req->user()->id);
        $msj= $this->setMod($id);
        $ev->registro(1,$msj,$this->req->user()->id);
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
        $ev=new EventlogRegister;
        $obj=Grupo::findOrFail($id);
        $obj->delete();
        $msj='Borrado. Tabla=Grupo, id='.$id;
        $ev->registro(2,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }
    
    /**
     * Guarda o modifica los registros
     *
     * @return \Illuminate\Http\Response
     */
    private function setMod($id=0){
        $resultado='Operación rechazada por falta de información';
        $obj=new Grupo;   // Si es nuevo registro
        if($id>0){
            $obj=Grupo::findOrFail($id); // Si es modificacion
        }   

        //////////////////////////////////////////////////////
        // Condiciones que se repiten sea modificación o nuevo
        // Este es el lugar que se debe modificar.

        if ($id) {
            $this->validate($this->req,[
                'name'=>'required'
            ]);
        }else{
            $this->validate($this->req,[
                'name'=>'required'
            ]);
        }
        $obj->name=$this->req->input('name');
        $obj->desc=$this->req->has('desc')? $this->req->input('desc') : '';
        $obj->users_id=$this->req->has('users_id')? $this->req->input('users_id') : 1;
        //$obj->cancelado_at=new Carbon($this->req->input('cancelado_at'));
        $obj->save();

        // De aqui para abajo no se toca nada
        ////////////////////////////////////


        // Guardar y finalizar
        if ($id>0) {
            $resultado='Modificación. Tabla=Grupo, id='.$id;
        }else{
            $resultado='Elemento Creado. Tabla=Grupo, id='.$obj->id;
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
        $obj=Grupo::all();
        return response()->json(['registros'=>$obj->count()]);
    }

    /**
     * Busca Grupo con los periodos ID. Corelaciona a los alumnos con su nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($info){
        $obj=Grupo::where('name','LIKE','%'.$info.'%')
        	->orWhere('desc','LIKE','%'.$info.'%')
            ->orderBy('name','asc')
            ->with($this->rel)
            ->get();
        $msj='Busqueda. Tabla=Grupo, letras='.$info;
        $ev=new EventlogRegister;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }
}
