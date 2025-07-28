    <?php

    use App\Http\Controllers\AdminModuleController;
    use App\Http\Controllers\Teacher\LessonController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    // Ruta de inicio general, redirige al login de administrador por defecto
    Route::get('/', function () {
        return view('auth.login');
    });

    // Ruta para acceso al login de administrador (redundante si ya tienes Auth::routes(), pero se mantiene si la usas específicamente)
    Route::get('AccesoAdmin', function () {
        return view('auth.login');
    })->name('logA');

    // Rutas de autenticación por defecto para el guard 'web' (administrador/usuario general)
    // Auth::routes() asume que los controladores están en App\Http\Controllers\Auth
    Auth::routes();

    //------------------------MÓDULO ADMINISTRADOR---------------------------
    // Estas rutas están protegidas por el middleware 'auth' (que usa el guard 'web' por defecto)
    Route::middleware('auth:web')->prefix('admin')->name('admin.')->group(function () {
        // HomeController@index se resolverá como App\Http\Controllers\HomeController@index
        Route::get('/home', 'HomeController@index')->name('home');

        // Rutas CRUD para Estudiantes (gestionadas por el administrador)
        // AdminStudentController se resolverá como App\Http\Controllers\Admin\AdminStudentController
        Route::resource('students', 'Admin\AdminStudentController')->except(['show']);

        // Rutas CRUD para Docentes (gestionadas por el administrador)
        // AdminTeacherController se resolverá como App\Http\Controllers\Admin\AdminTeacherController
        Route::resource('teachers', 'Admin\AdminTeacherController')->except(['show']);

        Route::resource('materias', 'Admin\AdminMateriaController')->except(['show']);

        // Rutas CRUD para Asignación Materia-Docente
        // Solo necesitamos index y store para añadir, y destroy para eliminar
        Route::get('asignacion-docente', 'Admin\AdminMateriaTeacherController@index')->name('materia-teacher.index');
        Route::post('asignacion-docente', 'Admin\AdminMateriaTeacherController@store')->name('materia-teacher.store');
        Route::delete('asignacion-docente', 'Admin\AdminMateriaTeacherController@destroy')->name('materia-teacher.destroy');

        // Rutas CRUD para Asignación Materia-Estudiante
        // Solo necesitamos index y store para añadir, y destroy para eliminar
        Route::get('asignacion-estudiante', 'Admin\AdminMateriaStudentController@index')->name('materia-student.index');
        Route::post('asignacion-estudiante', 'Admin\AdminMateriaStudentController@store')->name('materia-student.store');
        Route::delete('asignacion-estudiante', 'Admin\AdminMateriaStudentController@destroy')->name('materia-student.destroy');


        // Rutas para la gestión de usuarios (desde el panel del administrador)
        Route::get('/usuarios', function () {
            return view('administrador.usuarios.lista');
        })->name('user');

        // Rutas para la gestión de contenido (desde el panel del administrador)
        Route::get('/contenido', 'TemaController@index')->name('contenido-lista');
        Route::post('/NuevoTema', 'TemaController@crear')->name('NT');
        Route::get('/ListaContenido/{id}', 'TemaController@listaContenido')->name('Contenidos');
        Route::post('/CrearContenido', 'TemaController@crearContenido')->name('CrearContenidos');
        Route::get('/video', function () {
            return view('administrador.contenido.videos');
        })->name('vid');


        // Placeholder for your content route, adjust if it's a resource
        Route::get('/contenido', 'AdminModuleController@index')->name('contenido-lista');


        // --- Módulos Routes (Add these) ---
        Route::resource('modules', 'AdminModuleController');

        // Custom route for toggling module active status
        Route::post('modules/{module}/toggle-active', 'AdminModuleController@toggleActive')
            ->name('modules.toggle-active');
        // --- End Módulos Routes ---
        // Rutas para la gestión de exámenes (desde el panel del administrador)
        Route::get('/ListaExamen/{id}', 'TemaController@listaExamen')->name('examenes');
        Route::post('/NuevoExamen', 'TemaController@crearExamen')->name('EX');
        Route::get('/ListaPreguntas/{id_t}/{id_p}', 'TemaController@listaPreguntas')->name('listP');
        Route::post('/RegistroPreguntas', 'TemaController@RegistarPreguntas')->name('RegPre');
    });


    //------------------------MÓDULO ESTUDIANTE---------------------------
    Route::prefix('student')->name('student.')->group(function () {
        // Rutas de autenticación para estudiantes
        // StudentLoginController se resolverá como App\Http\Controllers\Auth\StudentLoginController
        Route::get('/login', 'Auth\StudentLoginController@showLoginForm')->name('login');
        Route::post('/login', 'Auth\StudentLoginController@login');
        Route::post('/logout', 'Auth\StudentLoginController@logout')->name('logout');

        // Rutas protegidas para estudiantes (requieren autenticación con el guard 'student')
        Route::middleware('auth:student')->group(function () {
            // EstudianteController se resolverá como App\Http\Controllers\EstudianteController
            Route::get('/dashboard', 'EstudianteController@Inicio')->name('dashboard'); // Dashboard del estudiante
            Route::get('/menu', function () { // Ruta para el menú del estudiante
                return view('estudiante.menu');
            })->name('menu');
            Route::get('/avance/{id}', 'EstudianteController@Avance')->name('avance'); // Avance del estudiante
            Route::get('/leccion/{id}', 'EstudianteController@AvanceEstado')->name('leccion'); // Lección actual del estudiante
            Route::get('/avance-aprobado', function () { // Vista de avance aprobado
                $ap = 'correcto';
                return view('estudiante.avance', compact('ap'));
            })->name('avance-aprobado');
            Route::get('/examen', function () { // Vista de examen del estudiante
                return view('estudiante.rexamen');
            })->name('examen');
        });
    });

    //------------------------MÓDULO DOCENTE---------------------------
    Route::prefix('teacher')->name('teacher.')->group(function () {
        // Rutas de autenticación para docentes
        // TeacherLoginController se resolverá como App\Http\Controllers\Auth\TeacherLoginController
        Route::get('/login', 'Auth\TeacherLoginController@showLoginForm')->name('login');
        Route::post('/login', 'Auth\TeacherLoginController@login');
        Route::post('/logout', 'Auth\TeacherLoginController@logout')->name('logout');

        // Rutas protegidas para docentes (requieren autenticación con el guard 'teacher')
        Route::middleware('auth:teacher')->group(function () {
            Route::get('/dashboard', 'Teacher\TeacherDashboardController@index')->name('dashboard'); // <--- ¡AQUÍ ESTÁ EL CAMBIO!
            Route::resource('modules.lessons', 'Teacher\LessonController')->except(['show']);


            Route::post('lessons/{lesson}/toggle-published', [LessonController::class, 'togglePublished'])->name('lessons.toggle-published'); // No necesitamos la ruta 'show' individual para una lección en este CRUD
            // Gestión de Lecciones por Módulo (Rutear directamente al LessonController)
            // La vista principal de las lecciones de un módulo específico: /teacher/modules/{module}/lessons
            //Route::get('modules/{module}/lessons', 'App\Http\Controllers\Teacher\LessonController@index')->name('modules.lessons.index');

            // Rutas CRUD anidadas para Lecciones dentro de un Módulo
            // Esto generará rutas como:
            // - /teacher/modules/{module}/lessons/create
            // - /teacher/modules/{module}/lessons (POST para store)
            // - /teacher/modules/{module}/lessons/{lesson}/edit
            // - /teacher/modules/{module}/lessons/{lesson} (PUT/PATCH para update)
            // - /teacher/modules/{module}/lessons/{lesson} (DELETE para destroy)
            // Usamos 'except(['index'])' porque ya tenemos una ruta 'index' específica arriba.
            // Route::resource('modules.lessons', 'App\Http\Controllers\Teacher\LessonController')->except(['index']);

            // Ruta personalizada para cambiar el estado de publicación de una lección
            // (por ejemplo, para que el docente pueda activar/desactivar la visibilidad de la lección)
            //  Route::post('lessons/{lesson}/toggle-published', 'App\Http\Controllers\Teacher\LessonController@togglePublished')->name('lessons.toggle-published');
        });
    });
