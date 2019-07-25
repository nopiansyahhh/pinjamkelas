<!DOCTYPE html>
<html>
    <head>
        <!-- Dibuat oleh:
        =================================================== 
            
            NOPIANSYAH - nopiansyahhh@gmail.com, 
            ANNISA RINJANI - arp.chacha24@gmail.com

        ===================================================    
        -->
        <meta charset="UTF-8">
        <meta name="csrf-token" content="OAtJ33r3dlnO6PGuz6Splbo9ncv6PhIGkmnyB8sg">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="http://demo.lavalite.org/apple-touch-icon.png">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">

        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/styles.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/settings.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/themes.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{--asset('assets/css/app.css')--}}" rel="stylesheet">
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/chart/code/highcharts.js')}}"></script>

    </head>
    <body>
        @include('layouts.mahasiswa._navbar')
        <section class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        @include('layouts.mahasiswa._sidebar')
                    </div>
                    <div class="col-sm-8 col-md-9">
                        <div class="page-wrapper">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <footer>
            <div class="container text-center">
                <p><strong>Copyright &copy; 2019 Night Family</strong> All rights reserved.</p>
            </div>
        </footer>

    <script src="{{asset('assets/js/mhs/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/mhs/main.js')}}"></script>
    <script src="{{asset('assets/js/mhs/theme.js')}}"></script>
    @yield('script')
    </body>
</html>
