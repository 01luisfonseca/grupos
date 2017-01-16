<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\TUsers;

class TUserCtrl extends Controller
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
        $obj='';
        if ($this->req->user()->t_users_id==2) {
            $obj=TUsers::skip($ini)->take(50+$ini)->get();
        }else{
            $obj=TUsers::where('id','<>',1)->skip($ini)->take(50+$ini)->get();
        }
        $ev=new EventlogRegister;
        $msj='Consulta registros. Tabla=TUsers.';
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
        $ev->registro(1,'Intento de guardar en tabla=TUsers.',$this->req->user()->id);
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
        $obj=TUsers::with($this->rel)->findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta de elemento. Tabla=TUsers, id='.$id;
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
        $ev->registro(1,'Intento de modificación. Tabla=TUsers, id='.$id,$this->req->user()->id);
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
        $ev->registro(2,'Intento de eliminación. Tabla=TUsers, id='.$id,$this->req->user()->id);
        $res=new Borrador;
        if ($id==1) {
            return response()->json(['msj'=>'No se puede eliminar el superadministrador.']);
        }
        $res->delTUsers($id); // Usando el borrador de cascada.
        $msj='Borrado. Tabla=TUsers, id='.$id;
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
        $obj=new TUsers;   // Si es nuevo registro
        if($id>0){
            $obj=TUsers::findOrFail($id); // Si es modificacion
        }   

        //////////////////////////////////////////////////////
        // Condiciones que se repiten sea modificación o nuevo
        // Este es el lugar que se debe modificar.

        if ($id) {
            if ($id==1) {
                return 'No se puede modificar el superadministrador';
            }
            $this->validate($this->req,[
                'name'=>'required'
            ]);
        }else{
            $this->validate($this->req,[
                'name'=>'required'
            ]);

        }
        $obj->name=$this->req->input('name');
        //$obj->cancelado_at=new Carbon($this->req->input('cancelado_at'));
        $obj->save();

        // De aqui para abajo no se toca nada
        ////////////////////////////////////


        // Guardar y finalizar
        if ($id>0) {
            $resultado='Modificación. Tabla=TUsers, id='.$id;
        }else{
            $resultado='Elemento Creado. Tabla=TUsers, id='.$obj->id;
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
        $obj=TUsers::all();
        return response()->json(['registros'=>$obj->count()]);
    }

    /**
     * Busca TUsers con los periodos ID. Corelaciona a los alumnos con su nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($info){
        $obj=TUsers::where('name','LIKE','%'.$info.'%')
            ->orderBy('id','asc')
            ->with($this->rel)
            ->get();
        $msj='Busqueda. Tabla=TUsers, letras='.$info;
        $ev=new EventlogRegister;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }
}
