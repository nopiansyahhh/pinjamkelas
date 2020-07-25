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
        <meta name="description" content="Prototype Aplikasi Peminjaman Kelas">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">

        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/styles.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/settings.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/themes.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{--asset('css/app.css')--}}" rel="stylesheet">
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>-->
        <script src="{{asset('assets/chart/code/highcharts.js')}}"></script>
        <link rel="stylesheet" href="{{asset('assets/pace-progress/themes/blue/pace-theme-loading-bar.css')}}">
        <style type="text/css">
          th{
            text-align: center;
          }
        </style>

    </head>
    <body>
        @include('layouts._navbar')
        <section class="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 col-md-2">
                        @include('layouts._sidebar')
                    </div>
                    <div class="col-sm-9 col-md-10">
                        <div class="page-wrapper">
                            @include('layouts.errors')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <footer>
            <div class="container text-center">
                <p><strong>Copyright &copy; 2020 Night Family</strong> All rights reserved.</p>
            </div>
        </footer>
    <script src="{{asset('assets/js/mhs/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/mhs/main.js')}}"></script>
    <script src="{{asset('assets/js/mhs/theme.js')}}"></script>
    <script src="{{asset('assets/pace-progress/pace.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //$('#spinner').hide();
        $(".nav-link").click(function(){
          $('table').fadeToggle("slow")
        })
      });
    </script>
    @yield('script')
    </body>
</html>
