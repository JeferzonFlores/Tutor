@extends('estudiante.menu')

@section('title-student')
Estadistica Basica
@endsection
@section('content-body-student')


<div class="container-fluid px-1 px-md-1" style="margin-top: 4.5%;">

    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <h5 class="mb-1" style="text-align: center;">
            Estadistica Inferencial
        </h5>
        <br>
        <center>
            <ul class="temas">
                @foreach($temas as $t)
                @if($t->id <= $numero_avance) <li class="terma card" style="width: 18rem;">
                    <img src="https://imgs.search.brave.com/98AzsrS5nc-eV6g87WDEfGxbrHuxltftcHGidOh_zuw/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pc2Rm/dW5kYWNpb24ub3Jn/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDE5/LzExL1BsYW50aWxs/YS1lbnRyYWRhcy1F/U1RBRElTVElDQS0x/LmpwZw" class="card-img-top" height="180px">
                    <div class="card-body">
                        <h5 class="card-title">{{$t->titulo}}</h5>

                        <a href="#" class="btn btn-success"><box-icon name='badge-check' type='solid' color='#ffffff'></box-icon> Completado</a>
                    </div>
                    </li>

                    @else
                    @if($t->id == $procecso)
                    <li class="terma card" style="width: 18rem;">
                        <img src="https://imgs.search.brave.com/98AzsrS5nc-eV6g87WDEfGxbrHuxltftcHGidOh_zuw/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pc2Rm/dW5kYWNpb24ub3Jn/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDE5/LzExL1BsYW50aWxs/YS1lbnRyYWRhcy1F/U1RBRElTVElDQS0x/LmpwZw" class="card-img-top" height="180px">
                        <div class="card-body">
                            <h5 class="card-title">{{$t->titulo}}</h5>

                            <a href="{{route('exmp',['id' => $id])}}" class="btn btn-warning"><box-icon name='cog' type='solid' color='#ffffff'></box-icon>En Proceso</a>
                            </div> </li>
                                    @else
                    <li class="terma card" style="width: 18rem;">
                        <img src="https://www.researchgate.net/profile/Ziyad-Al-Dibouni/publication/303467881/figure/fig2/AS:365269403881474@1464098420359/Scatter-plot-relationship-between-gestational-age-and-birth-weight.png" class="card-img-top" height="180px" width="50px">
                        <div class="card-body">
                            <h5 class="card-title">{{$t->titulo}}</h5>

                            <a href="#" class="btn btn-dark"><box-icon name='lock-alt' type='solid' color='#ffffff'></box-icon> Bloqueado</a>
                        </div>
                    </li>
                    @endif
                    @endif
                    @endforeach


            </ul>

        </center>
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