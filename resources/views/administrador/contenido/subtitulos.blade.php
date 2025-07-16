@extends('administrador.menu')
@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">{{$nombre_t}}</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Buscar</label>
                        <input type="text" class="form-control">
                    </div>
                </div>

                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-outline-success btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-material-dashboard">Buscar</a>
                    </li>
                    <li>



                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#staticBackdrop">
                            Nuevo Subtitulo
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Resgistro de subtitulos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('CrearContenidos')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_tema" value="{{$id}}">
                                        <div class="modal-body">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Titulo</label>
                                                <input type="text" name="titulo" class="form-control">
                                            </div>
                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" name="presentacion" rows="5" placeholder="Subir Presentación" spellcheck="false"></textarea>
                                            </div>

                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" name="video" rows="5" placeholder="Subir Video (Opcional)" spellcheck="false"></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Lista de Contenido</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titulo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Presentación</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Video</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registro</th>
                                        <th class="text-secondary opacity-7" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($stitulos as $t)
                                    @php
                                    $i++;
                                    @endphp

                                    @if($id == $t->id_tema)

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <center>
                                                    <h6 class="mb-0 text-sm">{{ $i}}</h6>
                                                </center>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$t->titulo}}</h6>
                                                </div>
                                            </div>

                                        </td>


                                        @if(empty($t->presentacion))
                                        <td>
                                            <span class="badge badge-sm bg-gradient-secondary">SIN CONTENIDO</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        @endif
                                        @if(empty($t->video))
                                        <td>
                                            <span class="badge badge-sm bg-gradient-secondary">SIN CONTENIDO</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        @endif
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$t->created_at}}</h6>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning">Editar</button>

                                            <button type="button" class="btn btn-danger">Eliminar Contenido</button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach

                                    <!--                                  
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <h6 class="mb-0 text-sm">1</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">¿Qué es la estadística?</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">con contenido</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">con contenido</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger">Desactivar</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <h6 class="mb-0 text-sm">2</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Ventajas de la estadística</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-secondary">SIN CONTENIDO</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger">Desactivar</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <h6 class="mb-0 text-sm">3</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Ventajas de la estadística</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger">Desactivar</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <h6 class="mb-0 text-sm">1</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Áreas de la estadística</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-success">CON CONTENIDO</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-secondary">SIN CONTENIDO</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-warning">Editar</button>
                                            <button type="button" class="btn btn-danger">Desactivar</button>
                                        </td>
                                    </tr>
-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Academia Estadistica</a>
                            for a better web.
                        </div>

                    </div>
                </div>
        </footer>
    </div>
</main>


@endsection