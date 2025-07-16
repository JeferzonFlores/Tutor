@extends('administrador.menu')

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Gestión de Estudiantes</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Buscar estudiante...</label>
                        <input type="text" class="form-control" id="searchStudentInput">
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <button type="button" class="btn btn-outline-success btn-sm mb-0 me-3" onclick="searchStudents()">Buscar</button>
                    </li>
                    <li>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#createStudentModal">
                            Nuevo Estudiante
                        </button>

                        <!-- Modal de Registro de Estudiante -->
                        <div class="modal fade" id="createStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createStudentModalLabel">Registro de Estudiante</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.students.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre Completo</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre completo" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Usuario</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese nombre de usuario" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_id_number" class="form-label">Código de Estudiante</label>
                                                <input type="text" class="form-control" id="student_id_number" name="student_id_number" placeholder="Ingrese código de estudiante">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese número de teléfono">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme contraseña" required>
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
                            <h6 class="text-white text-capitalize ps-3">Lista de Estudiantes</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Usuario</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código Estudiante</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha Registro</th>
                                        <th class="text-secondary opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($estudiantes as $student)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $student->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $student->username }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $student->student_id_number ?? 'N/A' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $student->phone ?? 'N/A' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $student->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs" style="background:none; border:none; cursor:pointer;" onclick="return confirm('¿Estás seguro de que quieres eliminar a este estudiante?');">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal de Edición de Estudiante (por cada estudiante) -->
                                    <div class="modal fade" id="editStudentModal{{ $student->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Editar Estudiante</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name_{{ $student->id }}" class="form-label">Nombre Completo</label>
                                                            <input type="text" class="form-control" id="edit_name_{{ $student->id }}" name="name" value="{{ old('name', $student->name) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_username_{{ $student->id }}" class="form-label">Usuario</label>
                                                            <input type="text" class="form-control" id="edit_username_{{ $student->id }}" name="username" value="{{ old('username', $student->username) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_student_id_number_{{ $student->id }}" class="form-label">Código de Estudiante</label>
                                                            <input type="text" class="form-control" id="edit_student_id_number_{{ $student->id }}" name="student_id_number" value="{{ old('student_id_number', $student->student_id_number) }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_phone_{{ $student->id }}" class="form-label">Teléfono</label>
                                                            <input type="text" class="form-control" id="edit_phone_{{ $student->id }}" name="phone" value="{{ old('phone', $student->phone) }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_password_{{ $student->id }}" class="form-label">Nueva Contraseña (opcional)</label>
                                                            <input type="password" class="form-control" id="edit_password_{{ $student->id }}" name="password" placeholder="Dejar en blanco para no cambiar">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_password_confirmation_{{ $student->id }}" class="form-label">Confirmar Nueva Contraseña</label>
                                                            <input type="password" class="form-control" id="edit_password_confirmation_{{ $student->id }}" name="password_confirmation" placeholder="Confirme nueva contraseña">
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
                                        <td colspan="6" class="text-center">No hay estudiantes registrados.</td>
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
    function searchStudents() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchStudentInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table.align-items-center.mb-0 tbody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            // Busca en la columna de nombre (índice 0) y usuario (índice 1)
            tdName = tr[i].getElementsByTagName("td")[0];
            tdUsername = tr[i].getElementsByTagName("td")[1];
            if (tdName || tdUsername) {
                txtValueName = tdName.textContent || tdName.innerText;
                txtValueUsername = tdUsername.textContent || tdUsername.innerText;
                if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueUsername.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
