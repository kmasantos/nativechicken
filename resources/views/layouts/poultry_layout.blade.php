<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/thirdparty/fontawesome-free-5.0.4/web-fonts-with-css/css/fontawesome-all.min.css">
    <link type="text/css" rel="stylesheet" href="/thirdparty/materialize/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/css/application_materialize.css"  media="screen,projection"/>
    {{-- <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css"> --}}
    @yield('customcss')
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PAB-IS | @yield('title')</title>
</head>

<body>
    {{-- Side navigation --}}
    <ul id="slide-out" class="side-nav fixed blue-grey lighten-4">
        <li>
            <div class="user-view">
                <div class="background blue-grey">

                </div>
                <img class="circle" src="/images/farmer.png">
                <span class="white-text name">{{Auth::user()->name}}</span>
                <span class="white-text email">{{Auth::user()->email}}</span>
                </div>
        </li>
        <li><a class="subheader">Menu</a></li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="{{route('farm.index')}}" class="collapsible-header" class="waves-effect"><i class="material-icons">dashboard</i>Dashboard</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="{{route('farm.pens')}}" class="collapsible-header" class="waves-effect"><i class="material-icons">view_column</i>Pens</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="{{route('farms.generation_lines_page')}}" class="collapsible-header" class="waves-effect"><i class="material-icons">linear_scale</i>Generations & Lines</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="{{route('farm.family_records')}}" class="collapsible-header" class="waves-effect"><i class="material-icons">queue</i>Families</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                <a class="collapsible-header">Breeder<i class="material-icons">stars</i></a>
                <div class="collapsible-body">
                    <ul>
                        {{-- <li><a href="{{route('farm.chicken.breeder.family_record')}}">Family Records</a></li> --}}
                        <li><a href="{{route('farm.chicken.breeder.add_breeder')}}">Add Breeders</a></li>
                        <li><a href="{{route('farm.chicken.breeder.daily_record')}}">Daily Records</a></li>
                        <li><a href="{{route('farm.chicken.breeder.hatchery_record')}}">Hatchery Records</a></li>
                        <li><a href="{{route('farm.chicken.breeder.egg_quality')}}">Egg Quality Records</a></li>
                        <li><a href="{{route('farm.chicken.breeder.breeder_inventory')}}">Breeder Inventory</a></li>
                    </ul>
                </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                <a class="collapsible-header">Replacement<i class="material-icons">autorenew</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('farm.chicken.replacemnt.replacement_add')}}">Add Replacements</a></li>
                        <li><a href="{{route('farm.chicken.replacemnt.phenomorpho_record')}}">Phenotypic and Morphometric</a></li>
                        <li><a href="{{route('farm.chicken.replacemnt.feeding_record')}}">Feeding Records</a></li>
                    </ul>
                </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                <a class="collapsible-header">Brooders & Growers<i class="material-icons">group_work</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('farm.chicken.broodergrower.broodergrower_add')}}">Add Brooders & Growers</a></li>
                        <li><a href="{{route('farm.chicken.broodergrower.broodergrower_feedingrecord')}}">Feeding Records</a></li>
                        <li><a href="{{route('farm.chicken.broodergrower.broodergrower_growthrecord')}}">Growth Performance</a></li>
                    </ul>
                </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="#!" class="collapsible-header" class="waves-effect"><i class="material-icons">monetization_on</i>Mortality & Sales</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header" class="waves-effect"><i class="material-icons">assessment</i>Farm Records</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="#!">Generation</a></li>
                            <li><a href="#!">Family</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible">
                <li>
                    <a href="{{route('farm.farm_settings')}}" class="collapsible-header" class="waves-effect"><i class="material-icons">settings_applications</i>Farm Settings</a>
                </li>
            </ul>
        </li>
    </ul>
    {{-- Top navigation --}}
    <nav class="blue-grey">
        <div class="nav-wrapper">
            <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
            <a href="{{route('farm.index')}}" class="brand-logo center"><img id="poultry-logo" src="/images/logo-poultry.png" height="60px" width="150px"/ ></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{route('farm.index')}}"><i class="material-icons">account_circle</i></a></li>
                <li><a href="{{route('farm.test')}}"><i class="material-icons">notification_important</i></a></li>
                <li><a href="{{route('logout')}}"><i class="material-icons">power_settings_new</i></a></li>
            </ul>

            <!-- Dropdown Trigger -->
            <a class='right dropdown-button hide-on-large-only' href='#' data-activates='dropdown_nav'><i class="material-icons">arrow_drop_down</i></a>
            <!-- Dropdown Structure -->
            <ul id='dropdown_nav' class='dropdown-content'>
                <li><a href="{{route('farm.index')}}">{{Auth::user()->name}}</a></li>
                <li><a href="#!">Notifications</a></li>
                <li><a href="#!">Logout</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container" id="app">
            @yield('content')
        </div>
    </main>
    {{-- <script src="semantic/dist/semantic.min.js"></script> --}}
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/thirdparty/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/thirdparty/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="/js/application_materialize.js"></script>
    @yield('customscripts')
</body>
</html>
