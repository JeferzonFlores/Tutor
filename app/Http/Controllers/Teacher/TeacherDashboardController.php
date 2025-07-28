<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Module; // Asegúrate de que este es el modelo correcto para tus módulos
use Illuminate\Support\Facades\Auth;
use App\Materia; // Necesitamos el modelo Materia para la relación

class TeacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher'); // Protege la ruta para que solo docentes autenticados accedan
    }

    public function index()
    {
        // Obtener el docente autenticado
        $teacher = Auth::guard('teacher')->user();

        // Obtener los IDs de las materias asignadas a este docente
        // Esto utiliza la relación many-to-many definida en el modelo Teacher
        $materiaIds = $teacher->materias->pluck('id');

        // Consultar los módulos que pertenecen a estas materias
        // y que están marcados como activos (si existe la columna 'is_active' en la tabla 'modules')
        // Si 'is_active' no existe en tu tabla 'modules', puedes eliminar esa condición.
        // Asumo que 'orden' es una columna para ordenar los módulos dentro de una materia.
        $modules = Module::with('materia') // Cargar la relación 'materia' para mostrar el nombre de la materia
                         ->whereIn('materia_id', $materiaIds) // Filtrar por las materias del docente
                         // ->where('is_active', true) // Descomenta si tienes una columna 'is_active' en tu tabla 'modules'
                         ->orderBy('materia_id') // Ordenar por materia primero
                         ->get();

        return view('docentes.inicio', compact('modules'));
    }
}