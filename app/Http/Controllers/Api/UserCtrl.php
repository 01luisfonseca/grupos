<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use Carbon\Carbon;
use App\User;
use Log;

class UserCtrl extends Controller
{
    /**
     * @var Request
     */
    protected $req,$rel;

    public function __construct(Request $request)//Dependency injection
    {
        $this->req = $request;
        $this->rel=['t_users'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=User::with($this->rel)
            ->orderBy('created_at','desc')
            ->where('id','<>',1)
            ->skip($ini)->take(50+$ini)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros. Tabla=User.';
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $ev=new EventlogRegister;
        $ev->registro(1,'Intento de guardar en tabla=User.',$this->req->user()->id);
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
        $obj=User::with($this->rel)->findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta de elemento. Tabla=User, id='.$id;
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
        $ev->registro(1,'Intento de modificación. Tabla=User, id='.$id,$this->req->user()->id);
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
        $ev->registro(2,'Intento de eliminación. Tabla=User, id='.$id,$this->req->user()->id);
        $res=new Borrador;
        if ($id==1) {
            return response()->json(['msj'=>'No se puede modificar al superadministrador.']);
        }
        $res->delUser($id); // Usando el borrador de cascada.
        $msj='Borrado. Tabla=User, id='.$id;
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
        $obj=new User;   // Si es nuevo registro
        if($id>0){
            $obj=User::findOrFail($id); // Si es modificacion
        }   

        //////////////////////////////////////////////////////
        // Condiciones que se repiten sea modificación o nuevo
        // Este es el lugar que se debe modificar.
        if ($id==1) {
            return response()->json(['msj'=>'No se puede modificar al superadministrador.']);
        }
        if ($id) {
            $this->validate($this->req,[
                'name'=>'required',
                'email'=>'required',
                'status'=>'required',
                't_users_id'=>'required'
            ]);
        }else{
            $this->validate($this->req,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
                't_users_id'=>'required'
            ]);

        }
        $obj->name=$this->req->input('name');
        $obj->email=$this->req->input('email');
        $obj->t_users_id=$this->req->input('t_users_id');
        $obj->status=($this->req->has('status'))? $this->req->input('status') : 1;
        if ($this->req->has('password')) {
            $obj->password=bcrypt($this->req->input('password'));
        }
        //$obj->cancelado_at=new Carbon($this->req->input('cancelado_at'));
        $obj->save();

        // De aqui para abajo no se toca nada
        ////////////////////////////////////


        // Guardar y finalizar
        if ($id>0) {
            $resultado='Modificación. Tabla=User, id='.$id;
        }else{
            $resultado='Elemento Creado. Tabla=User, id='.$obj->id;
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
        $obj=User::all();
        return response()->json(['registros'=>$obj->count()]);
    }

    /**
     * Busca Options con los periodos ID. Corelaciona a los alumnos con su nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($info){
        $obj=User::where('id','<>',1)
            ->where('name','LIKE','%'.$info.'%')
            ->orWhere('email','LIKE','%'.$info.'%')
            ->orderBy('updated_at','desc')
            ->with($this->rel)
            ->get();
        $msj='Busqueda. Tabla=User, letras='.$info;
        $ev=new EventlogRegister;
        $ev->registro(0,$msj,$this->req->user()->id);
        return $obj->toJson();
    }

    /**
     * Actualiza el estado del usuario.
     *
     * @param  int  $info
     * @return \Illuminate\Http\Response
     */
    public function modEstado($user,$status){
        if (!preg_match("/^[[:digit:]]+$/", $status)) {
            return response()->json(['msj'=>'No es entero']);
        }
        $ev=new EventlogRegister;
        if ($user==1) {
            return response()->json(['msj'=>'No se puede deshabilitar al superadministrador']);
        }
        $obj=User::findOrFail($user);
        $obj->status=$status;
        $obj->save();
        $msj='Se ha cambiado el status del usuario id= '.$user.' a estado= '.$status;
        $ev->registro(2,$msj,$this->req->user()->id);
        return response()->json(['msj'=>$msj]);
    }
}
