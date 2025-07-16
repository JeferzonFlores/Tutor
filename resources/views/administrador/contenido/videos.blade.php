@extends('administrador.menu')
@section('content-body')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">Contenido Lecciones</h6>
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
                            Nueva Leccion
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Resgistro de Lección</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('NT')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Titulo</label>
                                                <input type="text" name="titulo" class="form-control">
                                            </div>
                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" name="intro" rows="5" placeholder="Descripcion" spellcheck="false"></textarea>
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
                            <h6 class="text-white text-capitalize ps-3">Contenido de Videos</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <center>
                                    <h3>Probabilidad</h3>
                                </center>
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="card mb-3" style="max-width: 300px;">
                                                <div class="row g-0">
                                                    <div class="col-md-10">
                                                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/MS7l9ntiZtY?si=FbDHpHsEXlfWodHa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Experimento Aleatorio</h5>
                                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="card mb-3" style="max-width: 300px;">
                                                <div class="row g-0">
                                                    <div class="col-md-10">
                                                        <iframe width="100%" height="200" <iframe width="560" height="315" src="https://www.youtube.com/embed/xpPtDrC1akY?si=uLTq8T0hJxJQqwBL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Eventos</h5>
                                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="card mb-3" style="max-width: 300px;">
                                                <div class="row g-0">
                                                    <div class="col-md-10">
                                                        <iframe width="100%" height="200" <iframe width="560" height="315" src="https://www.youtube.com/embed/4LzRuuRh69k?si=imfI1nlKjU7xSoxW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Conteo</h5>
                                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="card mb-3" style="max-width: 300px;">
                                                <div class="row g-0">
                                                    <div class="col-md-10">
                                                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/MS7l9ntiZtY?si=FbDHpHsEXlfWodHa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Propiedades de la probabilidad</h5>
                                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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