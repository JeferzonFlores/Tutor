@extends('administrador.menu') {{-- Extiende tu layout principal --}}

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Gestión de Módulos por Materia</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Filtrar por materia...</label>
                        <select name="materia_id" id="filterMateriaId" class="form-control" onchange="this.form.submit()">
                            <option value="">Todas las Materias</option>
                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}" {{ request('materia_id') == $materia->id ? 'selected' : '' }}>
                                    {{ $materia->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#createModuleModal">
                            Nuevo Módulo
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        {{-- Mensajes de éxito y error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabla de Módulos --}}
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3"> {{-- Cambié a info para diferenciar --}}
                            <h6 class="text-white text-capitalize ps-3">Lista de Módulos</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materia</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre del Módulo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Orden</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($modules as $module)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $module->materia->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $module->nombre }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ Str::limit($module->descripcion, 50) }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $module->orden }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-{{ $module->is_active ? 'success' : 'danger' }}">
                                                    {{ $module->is_active ? 'Habilitado' : 'Deshabilitado' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.modules.show', $module->id) }}" class="btn btn-link text-dark px-2 mb-0">
                                                        <i class="material-icons text-sm me-2">visibility</i> Ver
                                                    </a>
                                                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-link text-warning px-2 mb-0">
                                                        <i class="material-icons text-sm me-2">edit</i> Editar
                                                    </a>
                                                    <form action="{{ route('admin.modules.toggle-active', $module->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link text-{{ $module->is_active ? 'danger' : 'success' }} px-2 mb-0">
                                                            <i class="material-icons text-sm me-2">toggle_on</i> {{ $module->is_active ? 'Deshab.' : 'Habilitar' }}
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger px-2 mb-0" onclick="return confirm('¿Estás seguro de eliminar este módulo y todas sus lecciones?');">
                                                            <i class="material-icons text-sm me-2">delete</i> Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay módulos registrados.</td>
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

{{-- Modal de Registro de Módulo --}}
<div class="modal fade" id="createModuleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModuleModalLabel">Registro de Módulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.modules.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="materia_id" class="form-label">Materia</label>
                        <select name="materia_id" id="materia_id" class="form-control" required>
                            <option value="">Seleccione una Materia</option>
                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}" {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                                    {{ $materia->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Módulo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Introducción a Laravel" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Breve descripción del módulo">{{ old('descripcion') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="orden" class="form-label">Orden (Ej: 1, 2, 3)</label>
                        <input type="number" class="form-control" id="orden" name="orden" min="1" value="{{ old('orden') }}" required>
                        <small class="form-text text-muted">Asegúrese de que el número de orden sea único para cada materia.</small>
                    </div>
                    <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label mb-0 ms-3" for="is_active">Habilitar Módulo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar Módulo</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Este script es para el filtro de la tabla en el lado del cliente (si no usas AJAX)
    document.getElementById('filterMateriaId').addEventListener('change', function() {
        // Al cambiar la selección, envía el formulario para filtrar
        this.closest('form').submit();
    });

    // Script para re-abrir el modal de creación si hubo errores de validación
    @if ($errors->any() && old('materia_id')) // Si hay errores y viene del modal de creación
        // Asegúrate de que el modal se muestre cuando la página cargue
        var createModal = new bootstrap.Modal(document.getElementById('createModuleModal'));
        createModal.show();
    @endif
</script>
@endsection