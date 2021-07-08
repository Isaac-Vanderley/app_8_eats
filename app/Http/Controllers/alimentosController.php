<?php

namespace App\Http\Controllers;

use App\Models\Alimentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class alimentosController extends Controller
{
    public function vista(){
        return view ('pages.alimentos');
    }
    public function listar(){

        $alimentos = Alimentos::all();
        return $alimentos;
    }
    public function editar(Request $request){
        $alimento = Alimentos::find($request->id);

        $alimento->nombre_a    = $request->nombre_a;
        $alimento->descripcion = $request->descripcion;
        $alimento->precio      = $request->precio;
        $alimento->tipo        = $request->tipo;
        $alimento->cantidad    = $request->cantidad;

            $alimento->ruta_archivo= $request->file('archivo')->store('alimentos','public');
       

        $alimento->save();
    }
    public function eliminar($id_alimento){
        $alimento = Alimentos::find($id_alimento);

        $alimento->delete();
    }
    public function verArchivo($id_alimento){

        $alimento = Alimentos::find($id_alimento);

        $ruta = 'public/'.$alimento->ruta_archivo;

        return Storage::download($ruta);

      }

    public function guardar(Request $request){
        $rules =[
            'nombre_a' => 'required|min:4',
            'descripcion' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
            'cantidad' => 'required',
        ];
    
        $detalle_mensaje= [
            'nombre_a.required' => 'El campo nombre es requerido',
            'descripcion.required' => 'El campo Descripcion es requerido',
            'precio.required' => 'El campo Precio es requerido',
            'tipo.required' => 'El campo Tipo es requerido',
            'cantidad.required' => 'El campo Cantidad es requerido'
        ];
    
        $this->validate($request, $rules, $detalle_mensaje);
    

       
        $nuevoAlimento = new Alimentos();

        $nuevoAlimento->nombre_a    = $request->nombre_a;
        $nuevoAlimento->descripcion = $request->descripcion;
        $nuevoAlimento->precio      = $request->precio;
        $nuevoAlimento->tipo        = $request->tipo;
        $nuevoAlimento->cantidad    = $request->cantidad;
        if($request->file('archivo')->isValid()){
        $nuevoAlimento->ruta_archivo= $request->file('archivo')->store('alimentos','public');
    }

        $nuevoAlimento->save();

    }
}
