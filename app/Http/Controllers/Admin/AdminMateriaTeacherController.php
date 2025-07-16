<?php

namespace App\Http\Controllers\Admin; // Esta línea debe ser la primera después de <?php

use App\Http\Controllers\Controller;
use App\Materia;
use App\Teacher;
use Illuminate\Http\Request;

    class AdminMateriaTeacherController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth:web');
        }

        /**
         * Muestra la lista de asignaciones Materia-Docente.
         * @return \Illuminate\View\View
         */
        public function index()
        {
            // Carga las materias con sus docentes asignados
            $materias = Materia::with('teachers')->get();
            $allTeachers = Teacher::all(); // Para el dropdown de selección
            $allMaterias = Materia::all(); // Para el dropdown de selección

            return view('administrador.asignacion.docente', compact('materias', 'allTeachers', 'allMaterias'));
        }

        /**
         * Almacena una nueva asignación Materia-Docente.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(Request $request)
        {
            $request->validate([
                'materia_id' => 'required|exists:materias,id',
                'teacher_id' => 'required|exists:teachers,id',
            ]);

            $materia = Materia::find($request->materia_id);

            // Adjuntar el docente a la materia
            try {
                $materia->teachers()->attach($request->teacher_id);
                return redirect()->route('admin.materia-teacher.index')->with('success', 'Asignación Materia-Docente creada exitosamente.');
            } catch (\Exception $e) {
                // Captura el error de duplicado (unique constraint)
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    return redirect()->back()->withErrors(['message' => 'Esta asignación ya existe.'])->withInput();
                }
                return redirect()->back()->withErrors(['message' => 'Error al crear la asignación: ' . $e->getMessage()])->withInput();
            }
        }

        /**
         * Elimina una asignación Materia-Docente.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Request $request)
        {
            $request->validate([
                'materia_id' => 'required|exists:materias,id',
                'teacher_id' => 'required|exists:teachers,id',
            ]);

            $materia = Materia::find($request->materia_id);
            $materia->teachers()->detach($request->teacher_id);

            return redirect()->route('admin.materia-teacher.index')->with('success', 'Asignación Materia-Docente eliminada exitosamente.');
        }
    }
    