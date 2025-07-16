<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Teacher; // Asegúrate de usar el modelo Teacher
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas

class AdminTeacherController extends Controller
{
    public function __construct()
    {
        // Solo los administradores (guard 'web') pueden acceder a estas rutas
        $this->middleware('auth:web');
    }

    /**
     * Muestra una lista de todos los docentes.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $docentes = Teacher::all(); // Obtiene todos los docentes
        return view('administrador.docente.lista', compact('docentes'));
    }

    /**
     * Almacena un nuevo docente en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:teachers', // 'username' debe ser único en la tabla 'teachers'
            'password' => 'required|string|min:8|confirmed',
            'employee_id_number' => 'nullable|string|unique:teachers', // Campo específico de docente
            'department' => 'nullable|string|max:255',
        ]);

        Teacher::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // ¡Siempre hashear la contraseña!
            'employee_id_number' => $request->employee_id_number,
            'department' => $request->department,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Docente registrado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un docente específico.
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\View\View
     */
    public function edit(Teacher $teacher)
    {
        return view('administrador.docente.edit', compact('teacher'));
    }

    /**
     * Actualiza un docente específico en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:teachers,username,' . $teacher->id,
            'password' => 'nullable|string|min:8|confirmed',
            'employee_id_number' => 'nullable|string|unique:teachers,employee_id_number,' . $teacher->id,
            'department' => 'nullable|string|max:255',
        ]);

        $teacher->name = $request->name;
        $teacher->username = $request->username;
        $teacher->employee_id_number = $request->employee_id_number;
        $teacher->department = $request->department;

        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        return redirect()->route('admin.teachers.index')->with('success', 'Docente actualizado exitosamente.');
    }

    /**
     * Elimina un docente específico de la base de datos.
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
