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
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- JS STYLE -->
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
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        /* Estilos para ocultar/mostrar formularios */
        .login-form-container {
            display: none;
        }
        .login-form-container.active {
            display: block;
        }
        .btn-group .btn {
            width: 120px; /* Ancho fijo para los botones */
        }
    </style>
</head>

<body class="bg-gray-200" style="background-image:url(https://quo.mx/wp-content/uploads/2023/10/que-estudia-la-estadistica.webp) ; background-size: cover; background-position: center;">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar (si tienes una navbar en la página de login) -->
            </div>
        </div>
    </div>
    <main class="main-content mt-0">
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
                                {{-- Botones para seleccionar el tipo de acceso --}}
                                <center>
                                    <div class="btn-group justify-content-center mb-4" role="group" aria-label="Tipo de Acceso">
                                        <button type="button" class="btn btn-secondary" onclick="showLoginForm('student')">Estudiantes</button>
                                        <button type="button" class="btn btn-dark active" onclick="showLoginForm('admin')">Administradores</button>
                                        <button type="button" class="btn btn-info" onclick="showLoginForm('teacher')">Docentes</button>
                                    </div>
                                </center>

                                {{-- Formulario de Login para ADMINISTRADORES --}}
                                <div id="admin-login-form" class="login-form-container active">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Usuario (Admin)</label>
                                            <input id="username-admin" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember-admin" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label mb-0 ms-3" for="remember-admin">Recordarme</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Ingresar como Administrador</button>
                                        </div>
                                    </form>
                                </div>

                                {{-- Formulario de Login para ESTUDIANTES --}}
                                <div id="student-login-form" class="login-form-container">
                                    <form method="POST" action="{{ route('student.login') }}">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Usuario (Estudiante)</label>
                                            <input id="username-student" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember-student" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label mb-0 ms-3" for="remember-student">Recordarme</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-secondary w-100 my-4 mb-2">Ingresar como Estudiante</button>
                                        </div>
                                    </form>
                                </div>

                                {{-- Formulario de Login para DOCENTES --}}
                                <div id="teacher-login-form" class="login-form-container">
                                    <form method="POST" action="{{ route('teacher.login') }}">
                                        @csrf
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Usuario (Docente)</label>
                                            <input id="username-teacher" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember-teacher" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label mb-0 ms-3" for="remember-teacher">Recordarme</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Ingresar como Docente</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script para cambiar entre formularios de login -->
    <script>
        function showLoginForm(role) {
            // Oculta todos los contenedores de formularios
            document.querySelectorAll('.login-form-container').forEach(formContainer => {
                formContainer.classList.remove('active');
            });

            // Muestra el contenedor del formulario del rol seleccionado
            document.getElementById(role + '-login-form').classList.add('active');

            // Actualiza el estado activo de los botones
            document.querySelectorAll('.btn-group .btn').forEach(button => {
                button.classList.remove('active');
                if (button.onclick.toString().includes(`showLoginForm('${role}')`)) {
                    button.classList.add('active');
                }
            });
        }

        // Mostrar el formulario de administrador por defecto al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            showLoginForm('admin');
        });
    </script>
</body>

</html>
