<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Materia; // Asegúrate de que este modelo exista y sea accesible
use App\Module;  // Asegúrate de que este modelo exista y sea accesible
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminModuleController extends Controller
{
     public function __construct()
    {
        // Solo usuarios autenticados (web guard) pueden acceder a estos métodos
        $this->middleware('auth:web');
        // Aquí podrías añadir un middleware para verificar si el usuario es administrador
        // $this->middleware('can:manage-modules'); // Si tienes gates/policies
    }

    /**
     * Muestra una lista de módulos, opcionalmente filtrados por materia.
     * También carga todas las materias para el filtro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Module::with('materia'); // Precarga la relación con Materia

        // Si se proporciona un materia_id en la URL (ej. /admin/modules?materia_id=1)
        if ($request->has('materia_id') && $request->materia_id != '') {
            $query->where('materia_id', $request->materia_id);
        }

        // Ordena los módulos por materia y luego por el número de orden
        $modules = $query->orderBy('materia_id')->orderBy('orden')->get();

        $materias = Materia::all(); // Todas las materias para el selector de filtro/creación

        return view('administrador.modules.index', compact('modules', 'materias'));
    }

    /**
     * Muestra el formulario para crear un nuevo módulo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $materias = Materia::all(); // Necesitamos las materias para el dropdown
        return view('administrador.modules.create', compact('materias'));
    }

    /**
     * Almacena un nuevo módulo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => [
                'required',
                'integer',
                'min:1',
                // Validación para que el orden sea único por materia
                Rule::unique('modules')->where(function ($query) use ($request) {
                    return $query->where('materia_id', $request->materia_id);
                }),
                // Aquí podrías añadir una regla para limitar a 3 módulos por materia si es un requisito estricto
                // Aunque la unicidad del orden ya lo limita si siempre usas 1, 2, 3
            ],
            'is_active' => 'boolean', // Opcional, si el formulario permite establecerlo al crear
        ]);

        Module::create([
            'materia_id' => $request->materia_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'is_active' => $request->has('is_active'), // Si el checkbox está marcado
        ]);

        return redirect()->route('admin.modules.index')->with('success', 'Módulo creado exitosamente.');
    }

    /**
     * Muestra los detalles de un módulo específico.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\View\View
     */
    public function show(Module $module)
    {
        // Precarga las lecciones asociadas a este módulo
        $module->load('lessons');
        return view('administrador.modules.show', compact('module'));
    }

    /**
     * Muestra el formulario para editar un módulo existente.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\View\View
     */
    public function edit(Module $module)
    {
        $materias = Materia::all(); // Necesitamos las materias para el dropdown (si se permitiera cambiar la materia)
        return view('administrador.modules.edit', compact('module', 'materias'));
    }

    /**
     * Actualiza un módulo existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => [
                'required',
                'integer',
                'min:1',
                // Validación para que el orden sea único por materia, excluyendo el módulo actual
                Rule::unique('modules')->where(function ($query) use ($request) {
                    return $query->where('materia_id', $request->materia_id);
                })->ignore($module->id),
            ],
            'is_active' => 'boolean', // Para el checkbox de habilitar/deshabilitar
        ]);

        $module->update([
            'materia_id' => $request->materia_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'is_active' => $request->has('is_active'), // Si el checkbox está marcado
        ]);

        return redirect()->route('admin.modules.index')->with('success', 'Módulo actualizado exitosamente.');
    }

    /**
     * Elimina un módulo de la base de datos.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Module $module)
    {
        $module->delete(); // Gracias a onDelete('cascade') en la migración, las lecciones asociadas también se eliminarán.

        return redirect()->route('admin.modules.index')->with('success', 'Módulo eliminado exitosamente.');
    }

    /**
     * Método para cambiar el estado (habilitar/deshabilitar) de un módulo.
     * Aunque ya se maneja en 'update', un método dedicado puede ser más claro para una API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive(Request $request, Module $module)
    {
        $module->is_active = !$module->is_active; // Invierte el estado actual
        $module->save();

        $status = $module->is_active ? 'habilitado' : 'deshabilitado';
        return redirect()->route('admin.modules.index')->with('success', "Módulo '$module->nombre' $status exitosamente.");
    }
}
