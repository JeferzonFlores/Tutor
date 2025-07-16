<?php

namespace App\Http\Controllers\Admin; // Esta línea debe ser la primera después de <?php

use App\Http\Controllers\Controller;
use App\Materia;
use App\Student;
use Illuminate\Http\Request;

    class AdminMateriaStudentController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth:web');
        }

        /**
         * Muestra la lista de asignaciones Materia-Estudiante.
         * @return \Illuminate\View\View
         */
        public function index()
        {
            // Carga las materias con sus estudiantes asignados
            $materias = Materia::with('students')->get();
            $allStudents = Student::all(); // Para el dropdown de selección
            $allMaterias = Materia::all(); // Para el dropdown de selección

            return view('administrador.asignacion.estudiante', compact('materias', 'allStudents', 'allMaterias'));
        }

        /**
         * Almacena una nueva asignación Materia-Estudiante.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(Request $request)
        {
            $request->validate([
                'materia_id' => 'required|exists:materias,id',
                'student_id' => 'required|exists:students,id',
            ]);

            $materia = Materia::find($request->materia_id);

            // Adjuntar el estudiante a la materia
            try {
                $materia->students()->attach($request->student_id);
                return redirect()->route('admin.materia-student.index')->with('success', 'Asignación Materia-Estudiante creada exitosamente.');
            } catch (\Exception $e) {
                // Captura el error de duplicado (unique constraint)
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    return redirect()->back()->withErrors(['message' => 'Esta asignación ya existe.'])->withInput();
                }
                return redirect()->back()->withErrors(['message' => 'Error al crear la asignación: ' . $e->getMessage()])->withInput();
            }
        }

        /**
         * Elimina una asignación Materia-Estudiante.
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Request $request)
        {
            $request->validate([
                'materia_id' => 'required|exists:materias,id',
                'student_id' => 'required|exists:students,id',
            ]);

            $materia = Materia::find($request->materia_id);
            $materia->students()->detach($request->student_id);

            return redirect()->route('admin.materia-student.index')->with('success', 'Asignación Materia-Estudiante eliminada exitosamente.');
        }
    }
    