<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="/thirdparty/fontawesome-free-5.6.0-web/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="/thirdparty/materialize/css/materialize.min.css"  media="screen,projection"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <title>PAB-IS | Native Chicken and Itik Pinas</title>
    <style>
        nav {
            height: 110px;
            background-color: transparent;
            border-color: transparent;
        }
        .nav-wrapper{
            height: 110px;
            padding-top: 5px;
        }
        .nav-button-div{
            padding-top: 20px;
            padding-bottom: 40px;
            background-color: transparent;
        }
        .nav-button-div .btn-large{
            background-color: transparent;
            color: black;
            text-shadow: 2px 2px #0000;
        }
        #nav-logo-image {
            padding-left: 10px;
            height: 100px; 
            width: 250px;
        }
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        .footer-image {
            height: 70px;
        }
    </style>
</head>
<body>
    <div class="navbar-fixed transparent">
        <nav>
            <div class="nav-wrapper">
                <a href="{{ url('/') }}" class="brand-logo"><img id="nav-logo-image" src="https://image.ibb.co/dBHtKq/logo-poultry.png" alt="poultry-logo"/></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down nav-button-div">
                    <li><a href="{{ route('google_login') }}" class="waves-effect waves-light btn-large"><i class="material-icons left">cloud</i>Login</a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="sass.html">Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <main>
        <div class="container" id="app">
                @yield('content')
        </div>
    </main>
    <footer class="page-footer blue-grey lighten-3">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="black-text">Philippine Native Pig Breed Information System</h5>
                    <p class="black-text">
                            The "Development of Philippine Native Chicken and Itik Pinas Information System" is a DOST-PCAARRD funded project of the Institute of Animal Science in cooperation with the Institute of Computer Science, University of the Philippines Los Baños. 
                            The project aims to provide an accessible information source regarding selected Philippine Native Chicken and Itik Pinas Breeds.
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <div class="row">
                        <div class="col s4">
                            <a href="http://www.dost.gov.ph/"><img class="footer-image" src="https://i.ibb.co/wrnwGHw/dost.png" alt="dost" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://www.pcaarrd.dost.gov.ph/home/portal/"><img class="footer-image" src="https://i.ibb.co/TWXZ0fg/pcaarrd.png" alt="pcaarrd" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://uplb.edu.ph/"><img class="footer-image" src="https://i.ibb.co/3y3rwGb/uplb.png" alt="uplb" border="0"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <a href="https://ias.cafs.uplb.edu.ph/"><img class="footer-image" src="https://i.ibb.co/FxyW47Y/ias.png" alt="ias" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://ics.uplb.edu.ph/"><img class="footer-image" src="https://i.ibb.co/hMQFmfr/ics.png" alt="ics" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="#" onclick="return false;"><img class="footer-image" src="https://image.ibb.co/nqiNCA/logo-default.png" alt="logo-default" border="0"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright black-text">
            <div class="container">
                © 2017 All Rights Reserved
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/thirdparty/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/thirdparty/materialize/js/materialize.min.js"></script>
    <script>
        $(".button-collapse").sideNav();
    </script>
</body>
</html>