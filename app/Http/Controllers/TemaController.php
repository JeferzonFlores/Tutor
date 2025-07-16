<?php

namespace App\Http\Controllers;

use App\examenes;
use App\Opcion;
use App\Pregunta;
use App\Respuesta;
use App\subtitulos;
use App\Temas;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Temas::get();
        return view('administrador.contenido.lista', compact('temas'));
    }

    public function crear(Request $request)
    {
        Temas::create([
            'titulo' => $request->titulo,
            'introduccion' => $request->intro,
        ]);
        $temas = Temas::get();
        return view('administrador.contenido.lista', compact('temas'));
    }

    public function listaContenido($id)
    {
        $nombre_t = NULL;
        $temas = Temas::get();
        foreach ($temas as $t) {
            if ($t->id == $id) {
                $nombre_t = $t->titulo;
            }
        }

        $stitulos = subtitulos::get();
        return view('administrador.contenido.subtitulos', compact('stitulos', 'id', 'nombre_t'));
    }

    public function crearContenido(Request $request)
    {
        $nombre_t = NULL;

        $id = $request->id_tema;
        $nombre_t = NULL;
        $temas = Temas::get();
        foreach ($temas as $t) {
            if ($t->id == $id) {
                $nombre_t = $t->titulo;
            }
        }
        subtitulos::create([
            'id_tema' => $request->id_tema,
            'titulo' => $request->titulo,
            'presentacion' => $request->presentacion,
            'video' => $request->video,
        ]);
        $stitulos = subtitulos::get();
        return view('administrador.contenido.subtitulos', compact('stitulos', 'id', 'nombre_t'));
    }

    public function listaExamen($id)
    {
        $temas = Temas::get();
        $nombre_t = NULL;
        foreach ($temas as $t) {
            if ($id == $t->id) {
                $nombre_t = $t->titulo;
                break;
            }
        }
        $examenes = examenes::get();
        return view('administrador.contenido.examen', compact('nombre_t', 'examenes', 'id'));
    }

    public function crearExamen(Request $request)
    {
        $nombre_t = NULL;

        $id = $request->id_tema;
        //dd($request->id_tema);
        $nombre_t = NULL;
        $temas = Temas::get();
        foreach ($temas as $t) {
            if ($t->id == $id) {
                $nombre_t = $t->titulo;
            }
        }
        examenes::create([
            'id_tema' => $request->id_tema,
            'enunciado' => $request->titulo,

        ]);
        $examenes = examenes::get();
        return view('administrador.contenido.examen', compact('examenes', 'id', 'nombre_t'));
    }

    public function listaPreguntas($id_t, $id_p)
    {
        //dd($id_t,$id_p);
        $preguntas = Pregunta::get();
        return view('administrador.contenido.listaPreguntas', compact('id_t', 'id_p', 'preguntas'));
    }

    public function RegistarPreguntas(Request $request)
    {
        $preg_id_i = NULL;
        $preg_id_f = NULL;

        $preguntas = Pregunta::get();
        foreach ($preguntas as $p) {
            $preg_id_i = $p->id;
        }
        Pregunta::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'concepto' => $request->P1,
        ]);

        Pregunta::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'concepto' => $request->P2,
        ]);
        Pregunta::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'concepto' => $request->P3,
        ]);

        $preg_1 = $preg_id_i + 1;
        $preg_2 = $preg_id_i + 2;
        $preg_3 = $preg_id_i + 3;

//dd($request->incP1a);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'inciso' => $request->incP1a,
            'enunciado' => $request->incE1a,
        ]);


        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'inciso' => $request->incP1b,
            'enunciado' => $request->incE1b,
        ]);



        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'inciso' => $request->incP1c,
            'enunciado' => $request->incE1c,
        ]);

        
        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'inciso' => $request->incP1d,
            'enunciado' => $request->incE1d,
        ]);

        
        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'inciso' => $request->incP1e,
            'enunciado' => $request->incE1e,
        ]);

        Respuesta::create([
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_1,
            'correcto' => $request->incR1a
        ]);

        //----------------p2-------------

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'inciso' => $request->incP2a,
            'enunciado' => $request->incE2a,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'inciso' => $request->incP2b,
            'enunciado' => $request->incE2b,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'inciso' => $request->incP2c,
            'enunciado' => $request->incE2c,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'inciso' => $request->incP2d,
            'enunciado' => $request->incE2d,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'inciso' => $request->incP2e,
            'enunciado' => $request->incE2e,
        ]);

        Respuesta::create([
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_2,
            'correcto' => $request->incR2a
        ]);

//----------------------p3---------------
        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'inciso' => $request->incP3a,
            'enunciado' => $request->incE3a,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'inciso' => $request->incP3b,
            'enunciado' => $request->incE3b,
        ]);
        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'inciso' => $request->incP3c,
            'enunciado' => $request->incE3c,
        ]);

        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'inciso' => $request->incP3d,
            'enunciado' => $request->incE3d,
        ]);
        Opcion::create([
            'id_tema' => $request->id_t,
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'inciso' => $request->incP3e,
            'enunciado' => $request->incE3e,
        ]);

        Respuesta::create([
            'id_examen' => $request->id_p,
            'id_pregunta' => $preg_3,
            'correcto' => $request->incR3a
        ]);

        $id_t=$request->id_t;
        $id_p=$request->id_p;
        $preguntas = Pregunta::get();
        return view('administrador.contenido.listaPreguntas', compact('id_t', 'id_p', 'preguntas'));
    }

    public function showQuestions()
    {
        $questions = [
            [
                'question' => '¿Cuál es la capital de Francia?',
                'options' => ['París', 'Londres', 'Berlín'],
                'answer' => 'París',
            ],
            [
                'question' => '¿Cuál es el río más largo del mundo?',
                'options' => ['Nilo', 'Amazonas', 'Yangtsé'],
                'answer' => 'Amazonas',
            ],
            // Agrega más preguntas según sea necesario
        ];

        return view('estudiante.examen', compact('questions'));
    }
}
