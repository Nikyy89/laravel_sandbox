@extends('layouts.app')

@section('content')
    <div class="row text-white">
        <div class="col-md-12 p-0">
            <h1 class="card-header border-dark border-5 stat">Statisztika</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 text-center padding">
            <div class="card darker">
                <div class="card-body">
                    <h5 class="text-white">Diagramok</h5>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="padding_stat">
        <div class="card darker">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-card p-component mb-4">
                        <div class="p-card-body">
                            <div class="p-card-title text-white">
                                Bejelentkezések száma
                            </div>
                            <div class="p-card-content">
                                <canvas id="LoginChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card darker">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-card p-component mb-4">
                        <div class="p-card-body">
                            <div class="p-card-title text-white">
                                Látogatások száma
                            </div>
                            <div class="p-card-content">
                                <canvas id="VisitorChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card darker">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-card p-component mb-4">
                        <div class="p-card-body">
                            <div class="p-card-title text-white">
                                Like és DisLike-ok száma
                            </div>
                            <div class="p-card-content">
                                <canvas id="LikesandDislikesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card darker">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-card p-component mb-4">
                        <div class="p-card-body">
                            <div class="p-card-title text-white">
                                Favourite és UnFavourite-k száma
                            </div>
                            <div class="p-card-content">
                                <canvas id="FavandUnfavChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            //LoginChart
            let login_x = @json($stat_login_x);
            let login_y = @json($stat_login_y);
            const login = document.getElementById('LoginChart');
            const LoginChart = new Chart(login, {
                type: 'bar',
                data: {
                    labels: login_x,
                    datasets: [{
                        label: 'Bejelentkezések száma',
                        data: login_y,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                            }
                        }
                    }
            });

            //VisitorChart
            let visitor_x = @json($stat_visitor_x);
            let visitor_y = @json($stat_visitor_y);
            const visitor = document.getElementById('VisitorChart');
            const VisitorChart = new Chart(visitor, {
                type: 'doughnut',
                data: {
                    labels: visitor_x,
                    datasets: [{
                        label: 'Látogatások száma',
                        data: visitor_y,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options:
                    {
                        scales:
                            {
                                y:
                                    {
                                        beginAtZero: true
                                    }
                            }
                    }
            });

            //LikesandDislikesChart
            let LikesandDislikes_x = @json($stat_Likes_x);
            let Likes_y = @json($stat_Likes_y);
            let Dislikes_y = @json($stat_DisLikes_y);

            new Chart('LikesandDislikesChart', {
                data: {
                    labels: LikesandDislikes_x,
                    datasets: [
                        {
                            type: 'bar',
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            data: Likes_y,
                            label: 'Like',
                            order: 2
                        },
                        {
                            type: 'line',
                            fill: false,
                            lineTension: 0,
                            backgroundColor: 'rgba(61,0,90,0.8)',
                            borderColor: 'rgba(0,0,255,0.1)',
                            data: Dislikes_y,
                            order: 1,
                            label: 'Dislike'
                        }
                    ]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Like és Dislike-ok száma"
                    }
                }
            });

            //FavandUnfavChart
            let FavandUnfav_x = @json($stat_Favourites_x);
            let Favourite_y = @json($stat_Favourites_y);
            let UnFavourite_y = @json($stat_UnFavourites_y);

            new Chart('FavandUnfavChart', {
                data: {
                    labels: FavandUnfav_x,
                    datasets: [
                        {
                            type: 'bar',
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            data: Favourite_y,
                            label: 'Favourite',
                            order: 2
                        },
                        {
                            type: 'line',
                            fill: false,
                            lineTension: 0,
                            backgroundColor: 'rgba(245,40,145,0.8)',
                            borderColor: 'rgba(213,10,193,0.53)',
                            data: UnFavourite_y,
                            order: 1,
                            label: 'UnFavourite'
                        }
                    ]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Favourite és UnFavourite-k száma"
                    }
                }
            });

        });
    </script>
@endpush

@push('styles')
    <style>
        .stat{
            background: #666666;
            text-align: center;
        }
        .stat_search{
            margin-left: 38%;
        }
        .darker{
            border: 1px solid #ecb21f;
            background-color: black;
            border-radius: 5px;
            padding-left: 40px;
            padding-right: 30px;
            padding-top: 10px;
        }
        .diagram{
            border: 1px solid #ecb21f;
            background-color: black;
            border-radius: 5px;
            padding-left: 40px;
            padding-right: 30px;
            padding-top: 10px;
        }
        .padding{
            padding-right: 400px;
            padding-left: 400px;
        }
        .padding_stat{
            padding-left: 100px;
            padding-right: 100px;
        }
    </style>
@endpush
