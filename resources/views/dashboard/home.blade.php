@extends('layouts.main')

@section('content')
    <div style="height: 10px;"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('super-admin')
            @include('dashboard.super-admin')
            @endrole

            @role('admin')
            @include('dashboard.admin')
            @endrole

            @role('uploader')
            @include('dashboard.uploader')
            @endrole


        </div>
    </div>

@endsection

@section('script')
    <script>
        var ctx = document.getElementById("myChart_image").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [

                    @foreach ($uploaded_images_months_chart as $date => $posts)
                        "{{ $date }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'No. of Uploads',
                    data: [
                        @foreach ($uploaded_images_months_chart as $date => $posts)
                        "{{count($posts)}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }


                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("myChart_video").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [

                    @foreach ($uploaded_videos_months_chart as $date => $posts)
                        "{{ $date }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'No. of Uploads',
                    data: [
                        @foreach ($uploaded_videos_months_chart as $date => $posts)
                            "{{count($posts)}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }


                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("myChart_image_each").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [

                    @foreach ($uploaded_images_each_months_chart as $date => $posts)
                        "{{ $date }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'No. of Uploads',
                    data: [
                        @foreach ($uploaded_images_each_months_chart as $date => $posts)
                            "{{count($posts)}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }


                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("myChart_video_each").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [

                    @foreach ($uploaded_videos_each_months_chart as $date => $posts)
                        "{{ $date }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'No. of Uploads',
                    data: [
                        @foreach ($uploaded_videos_each_months_chart as $date => $posts)
                            "{{count($posts)}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }


                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("myChart_users").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [

                    @foreach ($created_users as $date => $posts)
                        "{{ $date }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'No. of Users Created',
                    data: [
                        @foreach ($created_users as $date => $posts)
                            "{{count($posts)}}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }


                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@stop
