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
                        {{$nombre_tema}}
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
                                        <span class="text-sm font-weight-normal">10%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
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
                        @foreach($subtemas as $s)
                        @if($procecso == $s->id_tema)

                        <iframe width="100%" height="500px" src="https://www.youtube.com/embed/{{$s->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                       <br>
                            @endif
                        @endforeach
                        <div class="card-body">
                            <h6 class="mb-0 ">Descripción de Lección</h6>
                            <p class="text-sm ">
                                Distribuciones discretas
                                Una distribución discreta en estadística describe la probabilidad de ocurrencia de cada valor de una variable aleatoria discreta. Una variable aleatoria discreta es aquella que solo toma ciertos valores, generalmente enteros, y que resulta principalmente del conteo realizado.
                            </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">Curso en proceso</p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header bg-gradient-dark pb-0 p-3">
                            <h6 class="mb-0" style="color:white;">Temario</h6>
                        </div>
                        <div class="card-body p-3 ">
                            <ul class="list-group">
                                @foreach($subtemas as $s)
                                @if($procecso == $s->id_tema)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">

                                    <div class="d-flex align-items-start flex-column justify-content-center alert alert-info">
                                        <h6 class="mb-0 text-sm  text-white">{{$s->titulo}}</h6>

                                    </div>
                                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                                </li>
                                @endif
                                @endforeach

                                <li class="list-group-item border-0 d-flex align-items-center px-0">

                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">Exámen</h6>

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

@section('script-dash-student')
<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
<script>
    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0,
                borderWidth: 0,
                pointRadius: 5,
                pointBackgroundColor: "rgba(255, 255, 255, .8)",
                pointBorderColor: "transparent",
                borderColor: "rgba(255, 255, 255, .8)",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#f8f9fa',
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#f8f9fa',
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
@endsection