    @extends('administrador.menu')

    @section('content-body')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Asignación Materias a Estudiantes</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <!-- Puedes añadir una barra de búsqueda aquí si es necesario -->
                    </div>
                    <ul class="navbar-nav justify-content-end">
                        <li>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
                                Asignar Materia a Estudiante
                            </button>

                            <!-- Modal de Asignación Materia-Estudiante -->
                            <div class="modal fade" id="createAssignmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createAssignmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createAssignmentModalLabel">Asignar Materia a Estudiante</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.materia-student.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="materia_id" class="form-label">Materia</label>
                                                    <select class="form-control" id="materia_id" name="materia_id" required>
                                                        <option value="">Seleccione una materia</option>
                                                        @foreach($allMaterias as $materia)
                                                            <option value="{{ $materia->id }}">{{ $materia->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="student_id" class="form-label">Estudiante</label>
                                                    <select class="form-control" id="student_id" name="student_id" required>
                                                        <option value="">Seleccione un estudiante</option>
                                                        @foreach($allStudents as $student)
                                                            <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->username }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Asignar</button>
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
                                <h6 class="text-white text-capitalize ps-3">Asignaciones de Materias a Estudiantes</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materia</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estudiante Asignado</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha Asignación</th>
                                            <th class="text-secondary opacity-7">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($materias as $materia)
                                            @forelse ($materia->students as $student)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $materia->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $student->name }} ({{ $student->username }})</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ $student->pivot->created_at->format('d/m/Y H:i') }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <form action="{{ route('admin.materia-student.destroy') }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="materia_id" value="{{ $materia->id }}">
                                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                        <button type="submit" class="text-danger font-weight-bold text-xs" style="background:none; border:none; cursor:pointer;" onclick="return confirm('¿Estás seguro de que quieres eliminar esta asignación?');">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <!-- Opcional: Mostrar que la materia no tiene estudiantes asignados -->
                                            @endforelse
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay asignaciones de materias a estudiantes.</td>
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
    