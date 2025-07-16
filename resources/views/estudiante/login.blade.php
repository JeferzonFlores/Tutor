<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png')}}">
    <title>
        Acceso Academia
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!--JS sTYLE-->
    <script src="{{ asset('assets/js/core/popper.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}" defer></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}" defer></script>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-gray-200" style="background-image:url(https://quo.mx/wp-content/uploads/2023/10/que-estudia-la-estadistica.webp) ;">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Acceso</h4>
                                    <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-github text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            <form action="{{route('loginE')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    
                                        <div class="modal-body">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Nombre Estudiantes</label>
                                                <input type="text" name="username" class="form-control">
                                            </div>

                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">Contraseña</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <center>
                                        <div class="btn-group justify-content-center" role="group" aria-label="Basic example">
                                            <center>
                                                <button type="button" class="btn btn-dark">Estudiantes</button>
                                                <a href="{{route('logA')}}">
                                                    <button type="button" class="btn btn-secondary">Administradores</button>
                                                </a>
                                            </center>
                                        </div>
                                    </center>
                                    <div class="text-center">

                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Ingresar</button>

                                    </div>
                                    </form>
                               <!-- <form method="POST" action="{{ route('loginE') }}" role="form" class="text-start">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Usuario</label>
                                        <input id="email" type="text" class="form-control  name=" username" required>

                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <input type="password" class="form-control  name=" password" required >

                                    </div>
                                    <center>
                                        <div class="btn-group justify-content-center" role="group" aria-label="Basic example">
                                            <center>
                                                <button type="button" class="btn btn-dark">Estudiantes</button>
                                                <a href="{{route('logA')}}">
                                                    <button type="button" class="btn btn-secondary">Administradores</button>
                                                </a>
                                            </center>
                                        </div>
                                    </center>
                                    <div class="text-center">

                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Ingresar</button>

                                    </div>

                                </form>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>