@extends('estudiante.menu')

@section('title-student')
Estadistica Basica
@endsection
@section('content-body-student')


<div class="container-fluid px-2 px-md-4" style="margin-top: 4.5%;">

    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">

            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Variable Aleatoria
                    </h5>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">

                        <li class="nav-item" style="text-align: left;">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="material-icons text-lg position-relative">settings</i>
                                <span class="ms-1">En Proceso</span>
                            </a>
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-sm font-weight-normal">90%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <br>
                    <div class="card z-index-2 ">
                        <form>

                            <h6>Pregunta 1: ¿Cuál es la definición correcta de una variable aleatoria?</h6>
                            <input type="radio" name="q1" value="a"> a) Una función que asigna valores numéricos a resultados de un experimento aleatorio.<br>
                            <input type="radio" name="q1" value="b"> b) Distribución Exponencial.<br>
                            <input type="radio" name="q1" value="c"> c) Distribución Uniforme.<br>
                            <input type="radio" name="q1" value="c"> d) Un valor específico obtenido de un experimento aleatorio.<br>
                            <input type="radio" name="q1" value="c"> e) La probabilidad de ocurrencia de un evento en un experimento aleatorio.<br>
                            <h6>Pregunta 2: ¿Cuál es la diferencia entre una variable aleatoria discreta y una variable aleatoria continua?</h6>
                            <input type="radio" name="q2" value="a"> a) Una es numérica y la otra no<br>
                            <input type="radio" name="q2" value="b"> b) Una puede tomar un número infinito de valores y la otra solo valores enteros.<br>
                            <input type="radio" name="q2" value="c"> c) Una está definida en un intervalo específico y la otra puede tomar solo valores positivos.<br>
                            <input type="radio" name="q2" value="c"> d) No hay diferencia, ambos términos se refieren a lo mismo.!<br>
                            <input type="radio" name="q1" value="c"> e) Distribución Uniforme.<br>

                            <h6>Pregunta 3: ¿Cuál de las siguientes distribuciones es un ejemplo de una variable aleatoria continua?</h6>
                            <input type="radio" name="q3" value="a"> a) Distribución binomial.<br>
                            <input type="radio" name="q3" value="b"> b) TDistribución de Poisson.<br>
                            <input type="radio" name="q3" value="c"> c) Distribución uniforme.<br>
                            <input type="radio" name="q1" value="c"> d) Distribución hipergeométrica.<br>
                            <input type="radio" name="q1" value="c"> e) Distribución hipergeométrica.<br>
                            <br>

                        </form>
                        <center>
                                <div class="d-grid gap-2">
                                    <a href="{{route('exm')}}">
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Evaluar</button>
                                    </a>
                                </div>

                            </center>
                    </div>
                </div>



                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header bg-gradient-dark pb-0 p-3">
                            <h6 class="mb-0" style="color:white;">Temario</h6>
                        </div>
                        <div class="card-body p-3 ">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">

                                    <div class="d-flex align-items-start flex-column justify-content-center ">
                                        <h6 class="mb-0 text-sm ">VARIABLE ALEATORIA INTRODUCCIÓN</h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">VARIABLE ALEATORIA DISCRETA </h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">VARIABLE ALEATORIA INTRODUCCIÓN</h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">ESPERANZA MATEMATICA </h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0">

                                    <div class="d-flex align-items-start flex-column justify-content-center alert alert-info">
                                        <h6 class="mb-0 text-sm text-white">Exámen</h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>


@endsection