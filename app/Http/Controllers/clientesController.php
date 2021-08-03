<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class clientesController extends Controller
{
   //
   public function vista(){
    return view ('pages.clientes');
}
public function listar(){

    $clientes = Clientes::all();
    return $clientes;
}

public function editar(Request $request){
    $clientes = Clientes::find($request->id);

    $clientes->nombre = $request->nombre;
    $clientes->apellido_paterno = $request->apellido_paterno;
    $clientes->apellido_materno = $request->apellido_materno;
    $clientes->correo = $request->correo;
    $clientes->no_ext = $request->no_ext;
    $clientes->no_int = $request->no_int;
    $clientes->cp = $request->cp;
    $clientes->teléfono = $request->teléfono;

    $clientes->update();

}

public function eliminar($id_cliente){
    $clientes = Clientes::find($id_cliente);

    $clientes->delete();

}
 

public function guardar(Request $request){

    $rules =[
        'nombre' => 'required|min:4',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'correo' => 'required',
        'no_ext' => 'required',
        'no_int' => 'required',
        'cp' => 'required|max:5',
        'teléfono' => 'required|max:10'
    ];

    $detalle_mensaje= [
        'nombre.required' => 'El campo nombre es requerido ',
        'apellido_paterno.required' => 'El campo Apellido Paterno es requerido',
        'apellido_materno.required' => 'El campo Apellido Materno es requerido',
        'correo.required' => 'El campo Correo Electronico es requerido',
        'no_ext.required' => 'El campo Número Exterior es requerido',
        'no_int.required' => 'El campo Número Interior es requerido',
        'cp.required' => 'El campo código postal es requerido',
        'teléfono.required' => 'El campo teléfono es requerido',
        'teléfono.max' => 'El campo teléfono requiere un máximo de 10 carácteres'
    ];

    $this->validate($request, $rules, $detalle_mensaje);

    $nuevoCliente = new Clientes();


    $nuevoCliente->nombre = $request->nombre;
    $nuevoCliente->apellido_paterno = $request->apellido_paterno;
    $nuevoCliente->apellido_materno = $request->apellido_materno;
    $nuevoCliente->correo = $request->correo;
    $nuevoCliente->no_ext = $request->no_ext;
    $nuevoCliente->no_int = $request->no_int;
    $nuevoCliente->cp = $request->cp;
    $nuevoCliente->teléfono = $request->teléfono;

    $nuevoCliente->save();


}
}
