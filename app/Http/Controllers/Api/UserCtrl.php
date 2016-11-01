<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\EventlogRegister;
use App\User;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ini=0)
    {
        $obj=User::where('id','>',1)->orderBy('updated_at')->skip($ini)->take(50+$ini)->get();
        $ev=new EventlogRegister;
        $msj='Consulta registros de usuarios.';
        $ev->registro(0,$msj);
        return $obj->toJson();
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'password'=>'required',
            'identificacion'=>'required',
            'birday'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            'acudiente'=>'required',
            'tipo_sangre'=>'required',
            'tipo_usuario_id'=>'required',
            'estado'=>'required'
        ]);
        $obj=User::create($request->all());
        $ev=new EventlogRegister;
        $msj='Usuario creado con id '.$obj->id;
        $ev->registro(1,$msj);
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
        $obj=User::findOrFail($id);
        $ev=new EventlogRegister;
        $msj='Consulta el usuario id='.$id;
        $ev->registro(0,$msj);
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
        $obj=User::findOrFail($id);
        if($request->has('password')){
            $obj->password=bcrypt($request->input('password'));
            $obj->save();
        }else{
            $this->validate($request,[
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
            $obj->name=$request->input('name');
            $obj->lastname=$request->input('lastname');
            $obj->email=$request->input('email');
            $obj->identificacion=$request->input('identificacion');
            $obj->birday=$request->input('birday');
            $obj->telefono=$request->input('telefono');
            $obj->direccion=$request->input('direccion');
            $obj->acudiente=$request->input('acudiente');
            $obj->tipo_sangre=$request->input('tipo_sangre');
            $obj->estado=$request->input('estado');
            $obj->tipo_usuario_id=$request->input('tipo_usuario_id');
            $obj->save();
        }
        $ev=new EventlogRegister;
        $msj='Modifica la información del usuario id='.$id;
        $ev->registro(1,$msj);
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
        $obj=User::findOrFail($id);
        $obj->delete();
        $msj='Se ha borrado el registro '.$obj->id;
        $ev=new EventlogRegister;
        $ev->registro(2,$msj);
        return response()->json(['msj'=>$msj]);
    }

    /**
     * Busca los objetos que coincidan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($info)
    {
        $obj=User::findOrFail($id);
        $obj->delete();
        $msj='Se ha borrado el registro '.$obj->id;
        $ev=new EventlogRegister;
        $ev->registro(2,$msj);
        return response()->json(['msj'=>$msj]);
    }
}
