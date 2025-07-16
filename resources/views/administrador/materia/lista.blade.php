@extends('administrador.menu')

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Gestión de Materias</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Buscar materia...</label>
                        <input type="text" class="form-control" id="searchMateriaInput">
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <button type="button" class="btn btn-outline-success btn-sm mb-0 me-3" onclick="searchMaterias()">Buscar</button>
                    </li>
                    <li>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#createMateriaModal">
                            Nueva Materia
                        </button>

                        <!-- Modal de Registro de Materia -->
                        <div class="modal fade" id="createMateriaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMateriaModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createMateriaModalLabel">Registro de Materia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.materias.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre de la Materia</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre de la materia" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Ingrese una descripción (opcional)"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
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
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de Materias</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Creación</th>
                                        <th class="text-secondary opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($materias as $materia)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $materia->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $materia->description ?? 'N/A' }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $materia->created_at->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editMateriaModal{{ $materia->id }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.materias.destroy', $materia->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs" style="background:none; border:none; cursor:pointer;" onclick="return confirm('¿Estás seguro de que quieres eliminar esta materia?');">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal de Edición de Materia (por cada materia) -->
                                    <div class="modal fade" id="editMateriaModal{{ $materia->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMateriaModalLabel{{ $materia->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMateriaModalLabel{{ $materia->id }}">Editar Materia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.materias.update', $materia->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name_{{ $materia->id }}" class="form-label">Nombre de la Materia</label>
                                                            <input type="text" class="form-control" id="edit_name_{{ $materia->id }}" name="name" value="{{ old('name', $materia->name) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_description_{{ $materia->id }}" class="form-label">Descripción</label>
                                                            <textarea class="form-control" id="edit_description_{{ $materia->id }}" name="description" rows="3">{{ old('description', $materia->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No hay materias registradas.</td>
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
<script>
    // Script para la funcionalidad de búsqueda (simple, en el lado del cliente)
    function searchMaterias() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchMateriaInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table.align-items-center.mb-0 tbody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            // Busca en la columna de nombre (índice 0)
            tdName = tr[i].getElementsByTagName("td")[0];
            if (tdName) {
                txtValueName = tdName.textContent || tdName.innerText;
                if (txtValueName.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
