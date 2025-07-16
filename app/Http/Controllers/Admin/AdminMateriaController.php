<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Materia; // Asegúrate de usar el modelo Materia
use Illuminate\Http\Request;

class AdminMateriaController extends Controller
{
    public function __construct()
    {
        // Solo los administradores (guard 'web') pueden acceder a estas rutas
        $this->middleware('auth:web');
    }

    /**
     * Muestra una lista de todas las materias.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $materias = Materia::all(); // Obtiene todas las materias
        return view('administrador.materia.lista', compact('materias'));
    }

    /**
     * Almacena una nueva materia en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materias', // 'name' debe ser único en la tabla 'materias'
            'description' => 'nullable|string',
        ]);

        Materia::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.materias.index')->with('success', 'Materia registrada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una materia específica.
     * @param  \App\Materia  $materia
     * @return \Illuminate\View\View
     */
    public function edit(Materia $materia)
    {
        // Esta función podría no ser necesaria si usas un modal de edición en la misma vista 'lista'
        // Pero si tuvieras una vista de edición separada, la devolverías aquí.
        return view('administrador.materia.edit', compact('materia'));
    }

    /**
     * Actualiza una materia específica en la base de datos.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:materias,name,' . $materia->id, // 'name' único, excepto para la propia materia
            'description' => 'nullable|string',
        ]);

        $materia->name = $request->name;
        $materia->description = $request->description;
        $materia->save();

        return redirect()->route('admin.materias.index')->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Elimina una materia específica de la base de datos.
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('admin.materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
