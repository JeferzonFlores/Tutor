@extends('administrador.menu')
@section('content-body')

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </li>
        <nav aria-label="breadcrumb">
            <h4 class="font-weight-bolder mb-0">Dashboard</h4>
        </nav>

    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Aprobados</p>
                        <h4 class="mb-0">66</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">66 </span>Lecciones Aprobadas</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4"">
            <div class=" card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-danger shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Reprobados</p>
                    <h4 class="mb-0">10</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">10 </span>Cantidad de Reprobados</p>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Estudiantes</p>
                    <h4 class="mb-0">150</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">150</span> Estudiantes Registrados</p>
            </div>
        </div>
    </div>


</div>


<div class="row mt-4">

    <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Avances Semanales</h6>
                <p class="text-sm ">Porcentaje de Avances</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> Temas y Exámenes </p>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 "> Avanves Mensuales </h6>
                <p class="text-sm "> <span class="font-weight-bolder"></span>Reporte Mensual </p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm"> Temas y Examenes </p>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 mt-4 mb-3">
        <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Reporte mensual Aprobados</h6>
                <p class="text-sm ">Estudiantes Aprobados</p>
                <hr class="dark horizontal">
                <div class="d-flex ">
                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                    <p class="mb-0 text-sm">Curso Completado</p>
                </div>
            </div>
        </div>
    </div>


</div>


<div class="row mb-4">

    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Temas</h6>

                    </div>

                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estudinates</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Aprobados</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Estadística Introducción</h6>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold"> 60 </span>
                                </td>
                                <td class="align-middle" colspan="2">
                                    <div class="progress-wrapper w-75 mx-auto">
                                        <div class="progress-info">
                                            <div class="progress-percentage">
                                                <span class="text-xs font-weight-bold">40</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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

    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Orders overview</h6>
                <p class="text-sm">
                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold">24%</span> this month
                </p>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-success text-gradient">notifications</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-danger text-gradient">code</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-info text-gradient">shopping_cart</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-warning text-gradient">credit_card</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-primary text-gradient">key</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                        </div>
                    </div>
                    <div class="timeline-block">
                        <span class="timeline-step">
                            <i class="material-icons text-dark text-gradient">payments</i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                        </div>
                    </div>
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
    </div>
</footer>
</div>

@endsection

@section('script')
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["M", "T", "W", "T", "F", "S", "S"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "rgba(255, 255, 255, .8)",
                data: [50, 20, 10, 22, 50, 10, 40],
                maxBarThickness: 6
            }, ],
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
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
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


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
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
                borderColor: "rgba(255, 255, 255, .8)",
                borderWidth: 4,
                backgroundColor: "transparent",
                fill: true,
                data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
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