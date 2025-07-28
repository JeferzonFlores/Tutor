<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Module; // Asegúrate de que el modelo Module exista
use App\Lesson; // Asegúrate de que el modelo Lesson exista
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Para reglas de validación avanzadas

class LessonController extends Controller
{
    /**
     * Display a listing of the lessons for a specific module.
     */
    public function index(Module $module)
    {
        $lessons = $module->lessons()->orderBy('orden')->get();

        return view('docentes.lessons.index', compact('module', 'lessons'));
    }

    /**
     * Show the form for creating a new lesson.
     */
    public function create(Module $module)
    {
        return view('teacher.lessons.create', compact('module'));
    }

    /**
     * Almacena una nueva lección para un módulo específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Module $module)
    {
        // Obtener el docente autenticado
      /*  $teacher = Auth::guard('teacher')->user();

        // Verificar si el módulo pertenece a una materia asignada a este docente
        if (!$teacher->materias->contains($module->materia_id)) {
            return redirect()->route('teacher.dashboard')->with('error', 'No tienes permiso para añadir lecciones a este módulo.');
        }*/

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'orden' => [
                'required',
                'integer',
                'min:1',
                // Asegura que el orden sea único dentro del mismo módulo
                Rule::unique('lessons')->where(function ($query) use ($module) {
                    return $query->where('module_id', $module->id);
                }),
            ],
            'description' => 'nullable|string|max:1000',
            // Todos los campos de contenido son nullable, la lógica de uno u otro se maneja abajo
            'content_text' => 'nullable|string',
            'content_image_video_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,webm|max:20480', // 20MB
            'content_document_file' => 'nullable|file|mimes:pdf,doc,docx|max:20480', // 20MB
            'content_link' => 'nullable|url|max:2048',
        ]);

        // Inicializar todos los campos de contenido a null
        $data = [
            'module_id' => $module->id,
            'nombre' => $request->nombre,
            'description' => $request->description,
            'orden' => $request->orden,
            'is_published' => false, // Por defecto, no publicada al crear
            'content_text' => null,
            'content_image_video_path' => null,
            'content_document_path' => null,
            'content_link' => null,
        ];

        // Determinar qué tipo de contenido se ha enviado y asignar el valor
        if ($request->filled('content_text')) {
            $data['content_text'] = $request->content_text;
        } elseif ($request->hasFile('content_image_video_file')) {
            $file = $request->file('content_image_video_file');
            $path = $file->store('lessons/images_videos', 'public'); // Guarda en storage/app/public/lessons/images_videos
            $data['content_image_video_path'] = $path;
        } elseif ($request->hasFile('content_document_file')) {
            $file = $request->file('content_document_file');
            $path = $file->store('lessons/documents', 'public'); // Guarda en storage/app/public/lessons/documents
            $data['content_document_path'] = $path;
        } elseif ($request->filled('content_link')) {
            $data['content_link'] = $request->content_link;
        } else {
            // Si ningún campo de contenido se llenó, se puede añadir una validación personalizada aquí
            // Por ahora, se permitirá crear una lección sin contenido si todos son nulos
            // Puedes añadir $request->validate(['some_content_field' => 'required_without_all:other_content_fields'])
            // si quieres forzar al menos un tipo de contenido.
            return redirect()->back()->withErrors(['content' => 'Debe proporcionar al menos un tipo de contenido para la lección.'])->withInput();
        }

        // Crear la lección
        Lesson::create($data);

        return redirect()->route('teacher.modules.lessons.index', $module->id)
                         ->with('success', 'Lección creada exitosamente.');
    }

    /**
     * Actualiza una lección específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Module $module, Lesson $lesson)
    {
        // Obtener el docente autenticado
        $teacher = Auth::guard('teacher')->user();

        // Verificar si el módulo de la lección pertenece a una materia asignada a este docente
        // Y si la lección realmente pertenece al módulo especificado
        if (!$teacher->materias->contains($module->materia_id) || $lesson->module_id !== $module->id) {
            return redirect()->route('teacher.dashboard')->with('error', 'No tienes permiso para editar esta lección.');
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'orden' => [
                'required',
                'integer',
                'min:1',
                // Asegura que el orden sea único dentro del mismo módulo, excluyendo la lección actual
                Rule::unique('lessons')->where(function ($query) use ($module) {
                    return $query->where('module_id', $module->id);
                })->ignore($lesson->id),
            ],
            'description' => 'nullable|string|max:1000',
            'content_text' => 'nullable|string',
            'content_image_video_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,ogg,webm|max:20480',
            'content_document_file' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'content_link' => 'nullable|url|max:2048',
        ]);

        // Inicializar los campos de contenido para la actualización
        $updateData = [
            'nombre' => $request->nombre,
            'description' => $request->description,
            'orden' => $request->orden,
            'content_text' => null,
            'content_image_video_path' => null,
            'content_document_path' => null,
            'content_link' => null,
        ];

        // Lógica para determinar qué campo de contenido se está actualizando
        // y limpiar los otros campos si es necesario.
        $old_paths_to_delete = [];

        // Si se proporciona texto
        if ($request->filled('content_text')) {
            $updateData['content_text'] = $request->content_text;
            if ($lesson->content_image_video_path) $old_paths_to_delete[] = $lesson->content_image_video_path;
            if ($lesson->content_document_path) $old_paths_to_delete[] = $lesson->content_document_path;
        }
        // Si se sube una imagen/video
        elseif ($request->hasFile('content_image_video_file')) {
            $file = $request->file('content_image_video_file');
            $path = $file->store('lessons/images_videos', 'public');
            $updateData['content_image_video_path'] = $path;
            if ($lesson->content_image_video_path) $old_paths_to_delete[] = $lesson->content_image_video_path;
            if ($lesson->content_document_path) $old_paths_to_delete[] = $lesson->content_document_path;
        }
        // Si se sube un documento
        elseif ($request->hasFile('content_document_file')) {
            $file = $request->file('content_document_file');
            $path = $file->store('lessons/documents', 'public');
            $updateData['content_document_path'] = $path;
            if ($lesson->content_image_video_path) $old_paths_to_delete[] = $lesson->content_image_video_path;
            if ($lesson->content_document_path) $old_paths_to_delete[] = $lesson->content_document_path;
        }
        // Si se proporciona un enlace
        elseif ($request->filled('content_link')) {
            $updateData['content_link'] = $request->content_link;
            if ($lesson->content_image_video_path) $old_paths_to_delete[] = $lesson->content_image_video_path;
            if ($lesson->content_document_path) $old_paths_to_delete[] = $lesson->content_document_path;
        } else {
            // Si no se proporcionó ningún nuevo contenido, mantener el existente si aplica,
            // o vaciar si todos los campos de contenido están explícitamente vacíos en el request.
            // Esto es crucial para permitir al usuario "vaciar" el contenido.
            if ($request->missing('content_text') && $request->missing('content_image_video_file') && $request->missing('content_document_file') && $request->missing('content_link')) {
                 if ($lesson->content_image_video_path) $old_paths_to_delete[] = $lesson->content_image_video_path;
                 if ($lesson->content_document_path) $old_paths_to_delete[] = $lesson->content_document_path;
            } else {
                // Si no se envió un nuevo archivo, pero el campo de texto o enlace está vacío,
                // significa que se quiere mantener el contenido actual de ese tipo, o se vació
                // un campo de texto/enlace sin cambiar el tipo.
                $updateData['content_text'] = $lesson->content_text;
                $updateData['content_image_video_path'] = $lesson->content_image_video_path;
                $updateData['content_document_path'] = $lesson->content_document_path;
                $updateData['content_link'] = $lesson->content_link;
            }
        }

        // Eliminar archivos antiguos que ya no son relevantes
        foreach ($old_paths_to_delete as $path) {
            Storage::disk('public')->delete($path);
        }

        // Actualizar la lección
        $lesson->update($updateData);

        return redirect()->route('teacher.modules.lessons.index', $module->id)
                         ->with('success', 'Lección actualizada exitosamente.');
    }

    /**
     * Elimina una lección específica.
     *
     * @param  \App\Module  $module
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Module $module, Lesson $lesson)
    {
        // Obtener el docente autenticado
        $teacher = Auth::guard('teacher')->user();

        // Verificar si el módulo de la lección pertenece a una materia asignada a este docente
        // Y si la lección realmente pertenece al módulo especificado
        if (!$teacher->materias->contains($module->materia_id) || $lesson->module_id !== $module->id) {
            return redirect()->route('teacher.dashboard')->with('error', 'No tienes permiso para eliminar esta lección.');
        }

        // Eliminar archivos asociados si existen en cualquiera de los campos de ruta
        if ($lesson->content_image_video_path) {
            Storage::disk('public')->delete($lesson->content_image_video_path);
        }
        if ($lesson->content_document_path) {
            Storage::disk('public')->delete($lesson->content_document_path);
        }

        $lesson->delete();

        return redirect()->route('teacher.modules.lessons.index', $module->id)
                         ->with('success', 'Lección eliminada exitosamente.');
    }

    /**
     * Cambia el estado de publicación de una lección.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function togglePublished(Lesson $lesson)
    {
        // Obtener el docente autenticado
        $teacher = Auth::guard('teacher')->user();

        // Verificar si el módulo de la lección pertenece a una materia asignada a este docente
        if (!$teacher->materias->contains($lesson->module->materia_id)) {
            return redirect()->route('teacher.dashboard')->with('error', 'No tienes permiso para cambiar el estado de esta lección.');
        }

        $lesson->is_published = !$lesson->is_published;
        $lesson->save();

        $status = $lesson->is_published ? 'publicada' : 'despublicada';

        return redirect()->back()->with('success', "Lección {$lesson->nombre} ha sido {$status}.");
    }
}