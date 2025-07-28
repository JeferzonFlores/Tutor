@extends('administrador.menu')

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Editar Módulo: {{ $module->nombre }}</h6>
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

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto"> {{-- Centra el formulario --}}
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Formulario de Edición de Módulo</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <form action="{{ route('admin.modules.update', $module->id) }}" method="POST">
                            @csrf
                            @method('PUT') {{-- Importante para los métodos PUT/PATCH en Laravel --}}

                            <div class="mb-3">
                                <label for="materia_id" class="form-label">Materia</label>
                                <select name="materia_id" id="materia_id" class="form-control" required>
                                    <option value="">Seleccione una Materia</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id }}" {{ ($module->materia_id == $materia->id || old('materia_id') == $materia->id) ? 'selected' : '' }}>
                                            {{ $materia->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Módulo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $module->nombre) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $module->descripcion) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="orden" class="form-label">Orden (1, 2, 3...)</label>
                                <input type="number" class="form-control" id="orden" name="orden" value="{{ old('orden', $module->orden) }}" min="1" required>
                                <small class="form-text text-muted">Asegúrese de que el orden sea único para cada materia.</small>
                            </div>
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ ($module->is_active || old('is_active')) ? 'checked' : '' }}>
                                <label class="form-check-label mb-0 ms-3" for="is_active">Habilitar Módulo</label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 me-2">Actualizar Módulo</button>
                                <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                            </div>
                        </form>
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
{{-- Puedes añadir scripts específicos si los necesitas, por ejemplo, para manejo de selectores avanzados --}}
@endsection