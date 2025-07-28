@extends('administrador.menu')

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Detalles del Módulo: {{ $module->nombre }}</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary btn-lg mb-0 me-3">
                            <i class="material-icons text-sm">arrow_back</i> Volver a Módulos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        {{-- Mensajes de éxito --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Información del Módulo</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Materia:</strong>
                                <span>{{ $module->materia->nombre }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Nombre del Módulo:</strong>
                                <span>{{ $module->nombre }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Descripción:</strong>
                                <span>{{ $module->descripcion ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Orden:</strong>
                                <span>{{ $module->orden }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Estado:</strong>
                                <span>
                                    <span class="badge badge-sm bg-gradient-{{ $module->is_active ? 'success' : 'danger' }}">
                                        {{ $module->is_active ? 'Habilitado' : 'Deshabilitado' }}
                                    </span>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Creado el:</strong>
                                <span>{{ $module->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Última actualización:</strong>
                                <span>{{ $module->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-warning me-2">Editar Módulo</a>
                            <form action="{{ route('admin.modules.toggle-active', $module->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-{{ $module->is_active ? 'danger' : 'success' }} me-2">
                                    {{ $module->is_active ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este módulo y todas sus lecciones?');">
                                    Eliminar Módulo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sección de Lecciones --}}
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Lecciones de este Módulo ({{ $module->lessons->count() }})</h6>
                            <a href="#" class="btn btn-white btn-sm mb-0 me-3">Añadir Nueva Lección</a> {{-- Enlace para añadir lecciones --}}
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Orden</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre de Lección</th>
                                        <th class="text-secondary opacity-7 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($module->lessons as $lesson)
                                        <tr>
                                            <td class="px-3">
                                                <p class="text-xs font-weight-bold mb-0">{{ $lesson->orden }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $lesson->nombre }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ Str::limit($lesson->contenido, 70) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="#" class="btn btn-link text-dark px-2 mb-0">
                                                    <i class="material-icons text-sm me-2">visibility</i> Ver
                                                </a>
                                                <a href="#" class="btn btn-link text-warning px-2 mb-0">
                                                    <i class="material-icons text-sm me-2">edit</i> Editar
                                                </a>
                                                <form action="#" method="POST" style="display:inline-block;"> {{-- Aquí irá la ruta para eliminar lecciones --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger px-2 mb-0" onclick="return confirm('¿Está seguro de eliminar esta lección?');">
                                                        <i class="material-icons text-sm me-2">delete</i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No hay lecciones registradas para este módulo.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer py-4 ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            Derechos Reservados por
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Academia Estadistica</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
@endsection

@section('script')
{{-- Puedes añadir scripts específicos si los necesitas --}}
@endsection