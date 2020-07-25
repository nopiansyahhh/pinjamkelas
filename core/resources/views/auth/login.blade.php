<!DOCTYPE html>
<html>
    <head>
        <!-- KELOMPOK: 
            NOPIANSYAH, ANNISA RINJANI, FARIZ, TEGUH
        -->
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login - Pinjam Kelas </title>
        <meta name="description" content="Prototype Aplikasi Peminjaman Kelas">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="http://demo.lavalite.org/apple-touch-icon.png">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/styles.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/settings.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/css/mhs/themes.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{--asset('css/app.css')--}}" rel="stylesheet">

    </head>
    <body class="login-page">

        <div class="login-box">
            <div class="login-box-body">
                <div class="login-logo">
                    <a href="#"><img src="{{asset('assets/img/logo.png')}}" class="img-responsive center-block" alt="logo" title="logo"></a>
                </div>
                @if(session('danger'))
                    <div class="alert alert-danger">
                        <ul><li>{{session('danger')}}</li></ul>
                    </div>
                @endif 
                <span class="text-center"><h2><b>Absensi</b></h2></span>
                    <form accept-charset="utf-8" class="form-vertical" id="login" method="POST" action="{{url('/postlogin')}}">
                        @CSRF
                    <div class="form-group has-feedback">
                        <input class="form-control" required id="email" type="text" name="nim" placeholder="masukkan user login">
                        <span class="fa fa-user-circle form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" required id="password" type="password" name="password" placeholder="password">
                        <span class="fa fa-key form-control-feedback"></span>
                    </div>
                    <!--<div class="row">
                        <div class="col-xs-6">
                           <!-- <div class="checkbox mt-0">
                                <input id="rememberme" type="checkbox" name="rememberme">
                                <label for="rememberme">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <!--<a href="#"> Forgot Password?</a>
                        </div>
                    </div>-->
                    <button type="submit" class="btn theme-btn btn-block mt-20">Sign In</button>
                    </form>
            </div>
        </div>
        <div class="stripes-wraper">
            <div id="stripes">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>


        <div class="footer">
            <p><strong>Copyright &copy; 2020 <a href='#' target='_blank'>SISA-SISA TENAGA</a>.</strong> All rights reserved.</p>
        </div>
    <script src="{{asset('assets/js/mhs/app.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/mhs/main.js')}}"></script>
    <script src="{{asset('assets/js/mhs/theme.js')}}"></script>

    </body>
</html>
<style type="text/css">
html {
    display: table;
    height: 100%;
    width: 100%;
}
</style>