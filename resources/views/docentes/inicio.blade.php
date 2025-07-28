    @extends('docentes.menu')

    @section('content-body')
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Módulos Disponibles para Gestión</h6>
                                <p class="text-white ps-3">Selecciona un módulo para gestionar sus lecciones.</p>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materia</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Módulo</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Orden</th>
                                            <th class="text-secondary opacity-7"></th>
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
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ \Illuminate\Support\Str::limit($module->descripcion, 50) }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $module->orden }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('teacher.modules.lessons.index', $module) }}" class="btn btn-sm btn-info text-white">
                                                    Gestionar Lecciones
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay módulos disponibles para gestionar lecciones.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection