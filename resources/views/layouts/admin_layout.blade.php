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
                padding-left: 400px;
            }

            header, footer, {
                padding-left: 160px;
            }

            main {
                padding-top: 110px;
            }

            @media only screen and (max-width: 900px){
                nav, nav .nav-wrapper i, nav a.button-collapse, nav a.button-collapse i {
                    height: 80px;
                    line-height: 80px;
                    padding-left: 0px;
                }
                header, main, footer {
                    padding-left: 0;
                }
                
                main {
                    padding-top: 50px;
                }
            }
            
            .side-nav {
                width: 300px;
            }

            #logo {
                height: 110px;
                width: 250px;
            }
            .pagination li.active {
                background-color : #3f51b5;
            }
            .side-nav li>a>i{
                color: #3f51b5;
            }

            .side-nav li :hover{
                background-color: #3f51b5;
            }
            [type="radio"]:checked+label:after, [type="radio"].with-gap:checked+label:before, [type="radio"].with-gap:checked+label:after{
                border: 2px solid #3f51b5;
                border-top-color: #3f51b5;
                border-top-style: solid;
                border-top-width: 2px;
                border-right-color: #3f51b5;
                border-right-style: solid;
                border-right-width: 2px;
                border-bottom-color: #3f51b5;
                border-bottom-style: solid;
                border-bottom-width: 2px;
                border-left-color: #3f51b5;
                border-left-style: solid;
                border-left-width: 2px;
                border-image-source: initial;
                border-image-slice: initial;
                border-image-width: initial;
                border-image-outset: initial;
                border-image-repeat: initial;
            }
    </style>
</head>
<body>
    <div class="navbar-fixed">
        <nav class="indigo darken-1">
            <div class="nav-wrapper">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                <a class="brand-logo">@yield('title')</a>
            </div>
        </nav>
    </div>
    <ul id="slide-out" class="side-nav fixed">
        <div class="user-view">
            <div class="background indigo lighten-1">
            </div>
            <span>
                <img id="logo" src="https://image.ibb.co/dBHtKq/logo-poultry.png" alt="logo">
            </span>
            <span class="white-text name">{{Auth::user()->name}}</span>
            <span class="white-text email">{{Auth::user()->email}}</span>
        </div>
        <li><a href="{{route('admin.index')}}"><i class="fas fa-columns waves-effect waves-indigo darken-1"></i> Dashboard</a></li>
        <li><a href="{{route('admin.user_management')}}"><i class="fas fa-users-cog"></i> User Management</a></li>
        <li><a href="{{route('admin.news_management')}}"><i class="fas fa-newspaper"></i> News Management</a></li>
        <li><a href="{{route('admin.reports_management')}}"><i class="fas fa-pencil-alt"></i> Reports Management</a></li>
        <li><a href="{{route('admin.farm_status')}}"><i class="fab fa-houzz"></i> Farm Status</a></li>
        <li><a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <main>
        <div class="container" id="app">
            @yield('content')
        </div>
    </main>

    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/thirdparty/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/thirdparty/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="/js/application_materialize.js"></script>
    <script>
        $('.modal').modal({
            dismissible: false,
        });
    </script>
    @yield('customscripts')
</body>
</html>