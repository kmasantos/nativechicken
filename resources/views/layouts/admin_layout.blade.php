<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Import Google Icon Font-->
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/thirdparty/fontawesome-free-5.6.0-web/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="/thirdparty/materialize/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/css/application_materialize.css"  media="screen,projection"/>
    @yield('customcss')
    <title>PAB-IS | @yield('title')</title>
    <style>
            nav {
                height: 150px;
                line-height: 150px;
            }

            @media only screen and (max-width: 601px){
                nav, nav .nav-wrapper i, nav a.button-collapse, nav a.button-collapse i {
                    height: 80px;
                    line-height: 80px;
                }
            }
            header, main, footer, .navbar-fixed {
                padding-left: 160px;
            }

            @media only screen and (max-width : 992px) {
                header, main, footer {
                    padding-left: 0;
                }
            }
            
            .side-nav {
                width: 300px;
            }

            #logo {
                height: 100px;
                width: 240px;
            }
    </style>
</head>
<body>
    <div class="navbar-fixed">
        <nav class="grey darken-1">
            <div class="nav-wrapper">
                <a class="brand-logo">@yield('title')</a>
            </div>
        </nav>
    </div>
    <ul id="slide-out" class="side-nav fixed">
        <div class="user-view">
            <div class="background grey darken-1">
            </div>
            <span>
                <img id="logo" src="https://image.ibb.co/dBHtKq/logo-poultry.png" alt="logo">
            </span>
            <span class="white-text name">{{Auth::user()->name}}</span>
            <span class="white-text email">{{Auth::user()->email}}</span>
        </div>
        <li><a href="#!">User Management</a></li>
        <li><a href="#!">Content Management</a></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</body>
</html>