<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\Cuadra;

class CuadraCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req,$rel;

    public function __construct(Request $request)//Dependency injection
    {
        $this->req = $request;
        $this->rel=['ubicacion','casa'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=Cuadra::skip($ini)->take(50+$ini)->with($this->rel)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros. Tabla=Cuadra.';
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
        $ev->registro(1,'Intento de guardar en tabla=Cuadra.',$this->req->user()->id);
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
        $obj=Cuadra::with($this->rel)->findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta de elemento. Tabla=Cuadra, id='.$id;
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
        $ev->registro(1,'Intento de modificación. Tabla=Cuadra, id='.$id,$this->req->user()->id);
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
        $obj=Cuadra::findOrFail($id);
        $obj->delete();
        $msj='Borrado. Tabla=Cuadra, id='.$id;
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
        $obj=new Cuadra;   // Si es nuevo registro
        if($id>0){
            $obj=Cuadra::findOrFail($id); // Si es modificacion
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
                'name'=>'required',
                'territorio_id'=>'required'
            ]);
        }
        $obj->name=$this->req->input('name');
        $obj->desc=$this->req->has('desc')? $this->req->input('desc') : '';
        if ($this->req->has('territorio_id')) {
        	$obj->territorio_id=$this->req->input('territorio_id');
        }
        //$obj->cancelado_at=new Carbon($this->req->input('cancelado_at'));
        $obj->save();

        // De aqui para abajo no se toca nada
        ////////////////////////////////////


        // Guardar y finalizar
        if ($id>0) {
            $resultado='Modificación. Tabla=Cuadra, id='.$id;
        }else{
            $resultado='Elemento Creado. Tabla=Cuadra, id='.$obj->id;
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
        $obj=Cuadra::all();
        return response()->json(['registros'=>$obj->count()]);
    }

    /**
     * Busca Cuadra con los periodos ID. Corelaciona a los alumnos con su nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($info){
        $obj=Cuadra::where('name','LIKE','%'.$info.'%')
        	->orWhere('desc','LIKE','%'.$info.'%')
            ->orderBy('name','asc')
            ->with($this->rel)
            ->get();
        $msj='Busqueda. Tabla=Cuadra, letras='.$info;
        $ev=new EventlogRegister;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }
}
