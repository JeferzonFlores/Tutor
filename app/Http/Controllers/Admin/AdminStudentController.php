<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student; // Asegúrate de usar el modelo Student
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas

class AdminStudentController extends Controller
{
    public function __construct()
    {
        // Solo los administradores (guard 'web') pueden acceder a estas rutas
        $this->middleware('auth:web');
    }

    /**
     * Muestra una lista de todos los estudiantes.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $estudiantes = Student::all(); // Obtiene todos los estudiantes
        return view('administrador.estudiante.lista', compact('estudiantes'));
    }

    /**
     * Almacena un nuevo estudiante en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:students', // 'username' debe ser único en la tabla 'students'
            'password' => 'required|string|min:8|confirmed', // 'password' debe tener al menos 8 caracteres y ser confirmado
            'student_id_number' => 'nullable|string|unique:students', // Campo específico de estudiante
            'phone' => 'nullable|string|max:20',
        ]);

        Student::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // ¡Siempre hashear la contraseña!
            'student_id_number' => $request->student_id_number,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Estudiante registrado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un estudiante específico.
     * @param  \App\Student  $student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {
        // Puedes crear una vista específica para la edición si el modal es muy complejo,
        // o pasar el objeto $student al modal de edición.
        return view('administrador.estudiante.edit', compact('student'));
    }

    /**
     * Actualiza un estudiante específico en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:students,username,' . $student->id, // 'username' único, excepto para el propio estudiante
            'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional al actualizar
            'student_id_number' => 'nullable|string|unique:students,student_id_number,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->name = $request->name;
        $student->username = $request->username;
        $student->student_id_number = $request->student_id_number;
        $student->phone = $request->phone;

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Elimina un estudiante específico de la base de datos.
     * @param  \App\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}