@extends('docentes.menu')

@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Gestión de Lecciones (Módulo: {{ $module->titulo }})</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Buscar lección...</label>
                        <input type="text" class="form-control" id="searchLessonInput">
                    </div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <button type="button" class="btn btn-outline-success btn-sm mb-0 me-3" onclick="searchLessons()">Buscar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-dark btn-lg" data-bs-toggle="modal" data-bs-target="#createLessonModal">
                            Nueva Lección
                        </button>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
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
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de Lecciones</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Título</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contenido</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Orden</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Publicado</th>
                                        <th class="text-secondary opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lessons as $lesson)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $lesson->nombre }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ \Illuminate\Support\Str::limit($lesson->description, 50) ?? 'N/A' }}</p>
                                        </td>
                                        <td>
                                            {{-- Mostrar el tipo de contenido basado en los nuevos campos --}}
                                            @if ($lesson->content_text)
                                                <p class="text-xs text-secondary mb-0">Texto</p>
                                            @elseif ($lesson->content_image_video_path)
                                                @php
                                                    $extension = pathinfo($lesson->content_image_video_path, PATHINFO_EXTENSION);
                                                @endphp
                                                <p class="text-xs text-secondary mb-0">{{ in_array($extension, ['mp4', 'mov', 'ogg', 'webm']) ? 'Video' : 'Imagen' }}</p>
                                            @elseif ($lesson->content_document_path)
                                                <p class="text-xs text-secondary mb-0">Documento</p>
                                            @elseif ($lesson->content_link)
                                                <p class="text-xs text-secondary mb-0">Enlace</p>
                                            @else
                                                <p class="text-xs text-secondary mb-0">N/A</p>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Mostrar el contenido basado en los nuevos campos --}}
                                            @if ($lesson->content_text)
                                                <p class="text-xs text-secondary mb-0">{{ \Illuminate\Support\Str::limit($lesson->content_text, 30) }}</p>
                                            @elseif ($lesson->content_image_video_path)
                                                @php
                                                    $extension = pathinfo($lesson->content_image_video_path, PATHINFO_EXTENSION);
                                                @endphp
                                                @if (in_array($extension, ['mp4', 'mov', 'ogg', 'webm']))
                                                    <a href="{{ asset('storage/' . $lesson->content_image_video_path) }}" target="_blank" class="text-info text-xs font-weight-bold">Ver Video</a>
                                                @else
                                                    <a href="{{ asset('storage/' . $lesson->content_image_video_path) }}" target="_blank" class="text-info text-xs font-weight-bold">Ver Imagen</a>
                                                @endif
                                            @elseif ($lesson->content_document_path)
                                                <a href="{{ asset('storage/' . $lesson->content_document_path) }}" target="_blank" class="text-info text-xs font-weight-bold">Ver Documento</a>
                                            @elseif ($lesson->content_link)
                                                <a href="{{ $lesson->content_link }}" target="_blank" class="text-info text-xs font-weight-bold">Abrir Enlace</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $lesson->orden }}</p>
                                        </td>
                                        <td>
                                            <form action="{{ route('teacher.lessons.toggle-published', $lesson) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $lesson->is_published ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $lesson->is_published ? 'Sí' : 'No' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="text-secondary font-weight-bold text-xs me-2"
                                               data-bs-toggle="modal" data-bs-target="#editLessonModal{{ $lesson->id }}">
                                                Editar
                                            </a>
                                            <form action="{{ route('teacher.modules.lessons.destroy', [$module, $lesson]) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs" style="background:none; border:none; cursor:pointer;" onclick="return confirm('¿Estás seguro de que quieres eliminar esta lección?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Modal de Edición --}}
                                    <div class="modal fade" id="editLessonModal{{ $lesson->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLessonModalLabel{{ $lesson->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editLessonModalLabel{{ $lesson->id }}">Editar Lección</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('teacher.modules.lessons.update', [$module, $lesson]) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_nombre_{{ $lesson->id }}" class="form-label">Título de la Lección</label>
                                                                <input type="text" class="form-control" id="edit_nombre_{{ $lesson->id }}" name="nombre" value="{{ old('nombre', $lesson->nombre) }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="edit_orden_{{ $lesson->id }}" class="form-label">Orden de la Lección</label>
                                                                <input type="number" class="form-control" id="edit_orden_{{ $lesson->id }}" name="orden" value="{{ old('orden', $lesson->orden) }}" min="1" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_description_{{ $lesson->id }}" class="form-label">Descripción (Opcional)</label>
                                                            <textarea class="form-control" id="edit_description_{{ $lesson->id }}" name="description" rows="3">{{ old('description', $lesson->description) }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_content_text_{{ $lesson->id }}" class="form-label">Contenido de Texto</label>
                                                            <textarea class="form-control" id="edit_content_text_{{ $lesson->id }}" name="content_text" rows="6">{{ old('content_text', $lesson->content_text) }}</textarea>
                                                            <small class="text-muted">Si se usa este campo, la lección será de tipo "Texto".</small>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_content_image_video_file_{{ $lesson->id }}" class="form-label">Subir Nuevo Archivo de Imagen/Video</label>
                                                            @if ($lesson->content_image_video_path)
                                                                <p>Archivo actual:
                                                                    @php
                                                                        $extension = pathinfo($lesson->content_image_video_path, PATHINFO_EXTENSION);
                                                                    @endphp
                                                                    @if (in_array($extension, ['mp4', 'mov', 'ogg', 'webm']))
                                                                        <a href="{{ asset('storage/' . $lesson->content_image_video_path) }}" target="_blank">Ver Video Actual</a>
                                                                    @else
                                                                        <img src="{{ asset('storage/' . $lesson->content_image_video_path) }}" alt="Imagen actual" style="max-width: 150px; display: block; margin-top: 5px;">
                                                                    @endif
                                                                </p>
                                                            @endif
                                                            <input type="file" class="form-control" id="edit_content_image_video_file_{{ $lesson->id }}" name="content_image_video_file" accept="image/*,video/*">
                                                            <small class="text-muted">Max. 20MB. Deja vacío para mantener el archivo actual. Si se sube, la lección será de tipo "Imagen" o "Video".</small>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_content_document_file_{{ $lesson->id }}" class="form-label">Subir Nuevo Archivo de Documento (PDF/Word)</label>
                                                            @if ($lesson->content_document_path)
                                                                <p>Archivo actual: <a href="{{ asset('storage/' . $lesson->content_document_path) }}" target="_blank">Ver Documento Actual</a></p>
                                                            @endif
                                                            <input type="file" class="form-control" id="edit_content_document_file_{{ $lesson->id }}" name="content_document_file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                            <small class="text-muted">Max. 20MB. Deja vacío para mantener el archivo actual. Si se sube, la lección será de tipo "Documento".</small>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit_content_link_{{ $lesson->id }}" class="form-label">URL de Enlace / Video de YouTube/Vimeo</label>
                                                            <input type="url" class="form-control" id="edit_content_link_{{ $lesson->id }}" name="content_link" value="{{ old('content_link', $lesson->content_link) }}">
                                                            <small class="text-muted">Ej: `https://www.youtube.com/watch?v=xxxxxxxx`. Si se usa este campo, la lección será de tipo "Enlace".</small>
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
                                        <td colspan="7" class="text-center">No hay lecciones registradas para este módulo.</td>
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
            </footer>
        </div>
    </main>

    {{-- Modal de Creación (con campos de contenido independientes) --}}
    <div class="modal fade" id="createLessonModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLessonModalLabel">Crear Nueva Lección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teacher.modules.lessons.store', $module) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Título de la Lección</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="orden" class="form-label">Orden de la Lección</label>
                                <input type="number" class="form-control" id="orden" name="orden" value="{{ old('orden', 1) }}" min="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción (Opcional)</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>

                        {{-- Campos de Contenido INDEPENDIENTES para Creación --}}
                        <div class="mb-3">
                            <label for="create_content_text" class="form-label">Contenido de Texto</label>
                            <textarea class="form-control" id="create_content_text" name="content_text" rows="6">{{ old('content_text') }}</textarea>
                            <small class="text-muted">Ingresa el contenido de texto de la lección. Si se usa este campo, los otros campos de contenido se ignorarán.</small>
                        </div>

                        <div class="mb-3">
                            <label for="create_content_image_video_file" class="form-label">Subir Archivo de Imagen/Video</label>
                            <input type="file" class="form-control" id="create_content_image_video_file" name="content_image_video_file" accept="image/*,video/*">
                            <small class="text-muted">Max. 20MB. Formatos: JPG, PNG, GIF (imagen); MP4, MOV, OGG, WEBM (video). Si se sube un archivo, la lección será de tipo "Imagen" o "Video", y los otros campos de contenido se ignorarán.</small>
                        </div>

                        <div class="mb-3">
                            <label for="create_content_document_file" class="form-label">Subir Archivo de Documento (PDF/Word)</label>
                            <input type="file" class="form-control" id="create_content_document_file" name="content_document_file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <small class="text-muted">Max. 20MB. Formatos: PDF, DOC, DOCX. Si se sube un archivo, la lección será de tipo "Documento", y los otros campos de contenido se ignorarán.</small>
                        </div>

                        <div class="mb-3">
                            <label for="create_content_link" class="form-label">URL de Enlace / Video de YouTube/Vimeo</label>
                            <input type="url" class="form-control" id="create_content_link" name="content_link" value="{{ old('content_link') }}">
                            <small class="text-muted">Ej: `https://www.youtube.com/watch?v=xxxxxxxx`. Si se usa este campo, la lección será de tipo "Enlace", y los otros campos de contenido se ignorarán.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Lección</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Script para la funcionalidad de búsqueda (simple, en el lado del cliente)
    function searchLessons() {
        var input, filter, table, tr, tdTitle, i, txtValueTitle;
        input = document.getElementById("searchLessonInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table.align-items-center.mb-0 tbody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            // Busca en la columna de título (índice 0)
            tdTitle = tr[i].getElementsByTagName("td")[0];
            if (tdTitle) {
                txtValueTitle = tdTitle.textContent || tdTitle.innerText;
                if (txtValueTitle.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // --- Lógica para los modales de EDICIÓN y CREACIÓN (validación en el backend) ---
        @if ($errors->any())
            var createModalElement = document.getElementById('createLessonModal');
            // Check for errors in create modal fields
            if (createModalElement && (
                document.querySelector('#createLessonModal [name="nombre"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="orden"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="description"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="content_text"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="content_image_video_file"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="content_document_file"]').classList.contains('is-invalid') ||
                document.querySelector('#createLessonModal [name="content_link"]').classList.contains('is-invalid')
            )) {
                var createModal = new bootstrap.Modal(createModalElement);
                createModal.show();
            } else {
                // Intentar abrir el modal de edición si hay errores de validación
                @foreach ($lessons as $lesson)
                    var editModalElement = document.getElementById('editLessonModal{{ $lesson->id }}');
                    if (editModalElement && (
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="nombre"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="orden"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="description"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="content_text"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="content_image_video_file"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="content_document_file"]').classList.contains('is-invalid') ||
                        document.querySelector('#editLessonModal{{ $lesson->id }} [name="content_link"]').classList.contains('is-invalid')
                    )) {
                        var editModal = new bootstrap.Modal(editModalElement);
                        editModal.show();
                        break; // Abrir solo el primer modal con error
                    }
                @endforeach
            }
        @endif

        // --- Lógica para hacer los campos de contenido mutuamente excluyentes ---

        // Función para deshabilitar otros campos de contenido
        function disableOtherContentFields(currentField, modalId) {
            const modal = document.getElementById(modalId);
            const contentTextField = modal.querySelector('[name="content_text"]');
            const contentImageVideoFileField = modal.querySelector('[name="content_image_video_file"]');
            const contentDocumentFileField = modal.querySelector('[name="content_document_file"]');
            const contentLinkField = modal.querySelector('[name="content_link"]');

            const fields = [
                { element: contentTextField, type: 'text' },
                { element: contentImageVideoFileField, type: 'file' },
                { element: contentDocumentFileField, type: 'file' },
                { element: contentLinkField, type: 'link' },
            ];

            fields.forEach(field => {
                if (field.element && field.element !== currentField) {
                    if (currentField.value.trim() !== '' || (currentField.type === 'file' && currentField.files.length > 0)) {
                        field.element.setAttribute('disabled', 'disabled');
                        field.element.value = ''; // Clear value when disabled
                    } else {
                        field.element.removeAttribute('disabled');
                    }
                }
            });
        }

        // Aplicar la lógica a los campos del modal de CREACIÓN
        const createContentTextField = document.getElementById('create_content_text');
        const createContentImageVideoFileField = document.getElementById('create_content_image_video_file');
        const createContentDocumentFileField = document.getElementById('create_content_document_file');
        const createContentLinkField = document.getElementById('create_content_link');

        if (createContentTextField) {
            createContentTextField.addEventListener('input', function() {
                disableOtherContentFields(this, 'createLessonModal');
            });
        }
        if (createContentImageVideoFileField) {
            createContentImageVideoFileField.addEventListener('change', function() {
                disableOtherContentFields(this, 'createLessonModal');
            });
        }
        if (createContentDocumentFileField) {
            createContentDocumentFileField.addEventListener('change', function() {
                disableOtherContentFields(this, 'createLessonModal');
            });
        }
        if (createContentLinkField) {
            createContentLinkField.addEventListener('input', function() {
                disableOtherContentFields(this, 'createLessonModal');
            });
        }

        // Aplicar la lógica a los campos de cada modal de EDICIÓN
        @foreach ($lessons as $lesson)
            const editContentTextField_{{ $lesson->id }} = document.getElementById('edit_content_text_{{ $lesson->id }}');
            const editContentImageVideoFileField_{{ $lesson->id }} = document.getElementById('edit_content_image_video_file_{{ $lesson->id }}');
            const editContentDocumentFileField_{{ $lesson->id }} = document.getElementById('edit_content_document_file_{{ $lesson->id }}');
            const editContentLinkField_{{ $lesson->id }} = document.getElementById('edit_content_link_{{ $lesson->id }}');

            if (editContentTextField_{{ $lesson->id }}) {
                editContentTextField_{{ $lesson->id }}.addEventListener('input', function() {
                    disableOtherContentFields(this, 'editLessonModal{{ $lesson->id }}');
                });
            }
            if (editContentImageVideoFileField_{{ $lesson->id }}) {
                editContentImageVideoFileField_{{ $lesson->id }}.addEventListener('change', function() {
                    disableOtherContentFields(this, 'editLessonModal{{ $lesson->id }}');
                });
            }
            if (editContentDocumentFileField_{{ $lesson->id }}) {
                editContentDocumentFileField_{{ $lesson->id }}.addEventListener('change', function() {
                    disableOtherContentFields(this, 'editLessonModal{{ $lesson->id }}');
                });
            }
            if (editContentLinkField_{{ $lesson->id }}) {
                editContentLinkField_{{ $lesson->id }}.addEventListener('input', function() {
                    disableOtherContentFields(this, 'editLessonModal{{ $lesson->id }}');
                });
            }

            // Al abrir el modal de edición, deshabilitar campos si ya hay contenido
            document.getElementById('editLessonModal{{ $lesson->id }}').addEventListener('show.bs.modal', function () {
                if (editContentTextField_{{ $lesson->id }} && editContentTextField_{{ $lesson->id }}.value.trim() !== '') {
                    disableOtherContentFields(editContentTextField_{{ $lesson->id }}, 'editLessonModal{{ $lesson->id }}');
                } else if (editContentLinkField_{{ $lesson->id }} && editContentLinkField_{{ $lesson->id }}.value.trim() !== '') {
                    disableOtherContentFields(editContentLinkField_{{ $lesson->id }}, 'editLessonModal{{ $lesson->id }}');
                }
                // Para campos de archivo, no podemos verificar el "valor" directamente,
                // pero el backend manejará la sobrescritura. La lógica de deshabilitar
                // se activa solo si el usuario selecciona un nuevo archivo.
            });

            // Al cerrar el modal de edición, re-habilitar todos los campos para la próxima apertura
            document.getElementById('editLessonModal{{ $lesson->id }}').addEventListener('hidden.bs.modal', function () {
                const modal = this;
                const contentTextField = modal.querySelector('[name="content_text"]');
                const contentImageVideoFileField = modal.querySelector('[name="content_image_video_file"]');
                const contentDocumentFileField = modal.querySelector('[name="content_document_file"]');
                const contentLinkField = modal.querySelector('[name="content_link"]');

                if (contentTextField) contentTextField.removeAttribute('disabled');
                if (contentImageVideoFileField) contentImageVideoFileField.removeAttribute('disabled');
                if (contentDocumentFileField) contentDocumentFileField.removeAttribute('disabled');
                if (contentLinkField) contentLinkField.removeAttribute('disabled');
            });
        @endforeach

        // Al cerrar el modal de creación, re-habilitar todos los campos
        document.getElementById('createLessonModal').addEventListener('hidden.bs.modal', function () {
            const modal = this;
            const contentTextField = modal.querySelector('[name="content_text"]');
            const contentImageVideoFileField = modal.querySelector('[name="content_image_video_file"]');
            const contentDocumentFileField = modal.querySelector('[name="content_document_file"]');
            const contentLinkField = modal.querySelector('[name="content_link"]');

            if (contentTextField) {
                contentTextField.removeAttribute('disabled');
                contentTextField.value = ''; // Limpiar también el valor
            }
            if (contentImageVideoFileField) {
                contentImageVideoFileField.removeAttribute('disabled');
                contentImageVideoFileField.value = '';
            }
            if (contentDocumentFileField) {
                contentDocumentFileField.removeAttribute('disabled');
                contentDocumentFileField.value = '';
            }
            if (contentLinkField) {
                contentLinkField.removeAttribute('disabled');
                contentLinkField.value = '';
            }
        });
    });
</script>
@endsection
