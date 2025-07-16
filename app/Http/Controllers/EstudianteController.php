<?php

namespace App\Http\Controllers;

use App\Avance;
use App\Estudiantes;
use App\subtitulos;
use App\Temas;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function Inicio(){
        return view('estudiante.Inicio');
    }

    public function crear(Request $request){

        Estudiantes::create([
            'nombre'=>$request->nombre,
            'apellidoP'=>$request->appP,
            'apellidoM'=>$request->appM,
            'email'=>$request->email,
            'codigo'=>$request->cod,
            'clave'=>$request->cont,
        ]);

        $estudiates=Estudiantes::get();

        return view('administrador.estudiante.lista',compact('estudiates'));
    }

    public function login(Request $request){
        $temas = Temas::get();
        $estudiantes = Estudiantes::get();
        $avance = Avance::get();
        $numero_avance=NULL;
        $procecso=NULL;
        $nombre=NULL;
        $id=NULL;

        foreach($estudiantes as $e){
           
            if($request->username == $e->nombre &&  $e->clave == $request->password){
                $nombre=$e->nombre;
                $id=$e->id;
                foreach($avance as $a){
                        if($id == $a->id_estudiante && $a->estado == "aprobado"){
                            $numero_avance=$a->id_tema;
                    }
                }
                $procecso=$numero_avance+1;
               return view('estudiante.inicio',compact('nombre','id','temas','numero_avance','procecso'));
            }
        }
        return view("estudiante.login");
    }
   /* public function Inicio($id){
        $temas = Temas::get();
        $estudiantes = Estudiantes::get();
        $avance = Avance::get();
        $numero_avance=NULL;
        $procecso=NULL;
        $nombre=NULL;


        foreach($estudiantes as $e){
           
            if($id == $e->id ){
                $nombre=$e->nombre;
                foreach($avance as $a){
                        if($id == $a->id_estudiante && $a->estado == "aprobado"){
                            $numero_avance=$a->id_tema;
                    }
                }
                $procecso=$numero_avance+1;
               return view('estudiante.inicio',compact('nombre','id','temas','numero_avance','procecso'));
            }
        }
        return view("estudiante.login");


    }*/

    public function Avance($id){
        $temas = Temas::get();
        $estudiantes = Estudiantes::get();
        $avance = Avance::get();
        $numero_avance=NULL;
        $procecso=NULL;
        $nombre=NULL;


        foreach($estudiantes as $e){
           
            if($id == $e->id ){
                $nombre=$e->nombre;
                foreach($avance as $a){
                        if($id == $a->id_estudiante && $a->estado == "aprobado"){
                            $numero_avance=$a->id_tema;
                    }
                }
                $procecso=$numero_avance+1;
               return view('estudiante.avance',compact('nombre','id','temas','numero_avance','procecso'));
            }
        }
        return view("estudiante.login");
    }

    public function AvanceEstado($id){
        $temas=Temas::get();
        $subtemas = subtitulos::get();
        $estudiantes = Estudiantes::get();
        $avance = Avance::get();
        $numero_avance=NULL;
        $procecso=NULL;
        $nombre=NULL;
        $nombre_tema=NULL;
        $num_tema=NULL;


        foreach($estudiantes as $e){
           
            if($id == $e->id ){
                $nombre=$e->nombre;
                foreach($avance as $a){
                        if($id == $a->id_estudiante && $a->estado == "aprobado"){
                            $numero_avance=$a->id_tema;
                    }
                }
                $procecso=$numero_avance+1;
                foreach($temas as $t){
                    if($t->id == $procecso){
                        $nombre_tema=$t->titulo;
                        return view('estudiante.leccion',compact('nombre','id','nombre_tema','subtemas','numero_avance','procecso'));
                    }
                }
            }
        }
        return view("estudiante.login");
    }
}
