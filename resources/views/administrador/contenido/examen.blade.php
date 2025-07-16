@extends('administrador.menu')
@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">Exámenes</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Ingrese Leccion</label>
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
                            Nuevo Examen
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Resgistro de Examen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('EX')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_tema" value="{{$id}}">
                                        <div class="modal-body">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Titulo</label>
                                                <input type="text" name="titulo" class="form-control">
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <h6 class="text-white text-capitalize ps-3">Lista de Exámenes</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Exámen</th>
                                        
                                      
                                        <th class="text-secondary opacity-7" colspan="3"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($examenes as $t)
                                    @if($t->id_tema == $id)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-right">
                                                <center>
                                                    <h6 class="mb-0 text-sm">{{$t->id}}</h6>
                                                </center>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$t->enunciado}}</h6>
                                                </div>
                                            </div>

                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-warning">Editar</button>

                                            <a href="{{ route('listP', ['id_p' => $t->id, 'id_t'=>$id]) }}">
                                                <button type="button" class="btn btn-info">Preguntas
                                                </button>
                                            </a>
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
                                                     <h6 class="mb-0 text-sm">Estadistica Introduccion</h6>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">Conceptos de Graficos escalonados</p>
                                         </td>

                                         <td class="align-middle text-center">
                                             <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                         </td>
                                         <td class="align-middle">
                                             <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                 <button></button>
                                                 Edit
                                             </a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>
                                             <div class="d-flex flex-column justify-content-center">
                                                 <h6 class="mb-0 text-sm">2</h6>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="d-flex px-2 py-1">
                                                 <div class="d-flex flex-column justify-content-center">
                                                     <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                                     <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">Programator</p>
                                             <p class="text-xs text-secondary mb-0">Developer</p>
                                         </td>
                                         <td class="align-middle text-center text-sm">
                                             <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                         </td>
                                         <td class="align-middle text-center">
                                             <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                         </td>
                                         <td class="align-middle">
                                             <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                 Edit
                                             </a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>
                                             <div class="d-flex flex-column justify-content-center">
                                                 <h6 class="mb-0 text-sm">3</h6>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="d-flex px-2 py-1">
                                                 <div class="d-flex flex-column justify-content-center">
                                                     <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                                     <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">Executive</p>
                                             <p class="text-xs text-secondary mb-0">Projects</p>
                                         </td>
                                         <td class="align-middle text-center text-sm">
                                             <span class="badge badge-sm bg-gradient-success">Online</span>
                                         </td>
                                         <td class="align-middle text-center">
                                             <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                         </td>
                                         <td class="align-middle">
                                             <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                 Edit
                                             </a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>
                                             <div class="d-flex flex-column justify-content-center">
                                                 <h6 class="mb-0 text-sm">4</h6>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="d-flex px-2 py-1">
                                                 <div class="d-flex flex-column justify-content-center">
                                                     <h6 class="mb-0 text-sm">Michael Levi</h6>
                                                     <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">Programator</p>
                                             <p class="text-xs text-secondary mb-0">Developer</p>
                                         </td>
                                         <td class="align-middle text-center text-sm">
                                             <span class="badge badge-sm bg-gradient-success">Online</span>
                                         </td>
                                         <td class="align-middle text-center">
                                             <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                                         </td>
                                         <td class="align-middle">
                                             <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                 Edit
                                             </a>
                                         </td>
                                     </tr>

                                     <tr>
                                         <td>
                                             <div class="d-flex flex-column justify-content-center">
                                                 <h6 class="mb-0 text-sm">5</h6>
                                             </div>
                                         </td>
                                         <td>
                                             <div class="d-flex px-2 py-1">
                                                 <div class="d-flex flex-column justify-content-center">
                                                     <h6 class="mb-0 text-sm">Miriam Eric</h6>
                                                     <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                                 </div>
                                             </div>
                                         </td>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">Programator</p>
                                             <p class="text-xs text-secondary mb-0">Developer</p>
                                         </td>
                                         <td class="align-middle text-center text-sm">
                                             <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                         </td>
                                         <td class="align-middle text-center">
                                             <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                                         </td>
                                         <td class="align-middle">
                                             <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                 Edit
                                             </a>
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