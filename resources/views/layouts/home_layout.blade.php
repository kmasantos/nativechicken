<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <meta name="google-site-verification" content="RaHF0nFyoPExG_VIxLw1CJEMPUiW8xA0mUEEldLWCsg" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('/thirdparty/fontawesome-free-5.6.0-web/css/all.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/thirdparty/materialize/css/materialize.min.css') }}"
        media="screen,projection" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <title>PAB-IS | Native Chicken and Itik Pinas</title>
    @yield('custom-css')
    <style>
        #sidenav-overlay {
            z-index: 1;
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar-fixed {
            margin-bottom: 45px;
        }

        nav#govph {
            height: 110px;
        }

        nav#nativepoultry {
            height: 160px;
        }

        #gicon {
            margin-top: -5px;
        }

        nav#govph .nav-wrapper {
            height: 110px;
            padding-top: 5px;
            width: 70%;
            margin: 0 auto;
        }

        nav#nativepoultry .nav-wrapper {
            height: 160px;
            padding-top: 5px;
            width: 70%;
            margin: 0 auto;
        }

        .nav-button-div {
            padding-top: 20px;
            padding-bottom: 40px;
        }

        #nav-logo-image {
            padding-left: 10px;
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

        /* SLIDER CSS */
        .slideshow-container {
            width: 70%;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
            height: 300px;
            width: 100%;
            margin: 0 auto;
        }

        .mySlides .img {
            background-color: #cccccc;
            width: 100%;
            height: 300px;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0 auto;
        }

        .text {
            color: #ffffff;
            font-size: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
            position: absolute;
            bottom: 0;
            width: 100%;
            margin: 0 auto;
            text-align: center;
            background-color: #000000;
            opacity: 0.5;
        }

        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color .6s ease
        }

        .dot:active {
            background-color: #717171;
        }

        .dot:hover {
            background-color: #717171;
        }

        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        #home-content h1 h2 h3 h4 h5 h6 {
            font-family: Arial, sans-serif;
        }

        #home-content p {
            font-family: Arial, sans-serif;
            font-size: 1.2em;
            text-indent: 3em;
            text-align: justify;
        }

        #home_content {
            font-family: Arial, sans-serif;
        }

        #home-content .custom-panel {
            height: 500px;
        }

        #home-content .indent {
            text-indent: 3em;
        }

        .no-format {
            all: unset;
            font-family: Arial, sans-serif;
        }

        .farm-name {
            font-family: Arial, sans-serif;
            text-indent: 0em;
            text-align: center;
        }

    </style>
</head>

<body id="home">
    <div class="navbar">
        <nav id="govph" class="grey darken-3">
            <div class="nav-wrapper grey darken-3">
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="hide-on-med-and-down nav-button-div">
                    <li><a href="https://www.gov.ph">GOVPH</a></li>
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#Data" class="menu_links">Data</a></li>
                    <li><a href="#Summary" class="menu_links">Summary</a></li>
                    <li><a href="#PHNativeChickens" class="menu_links">PH Native Chickens</a></li>
                    <li><a href="#PHNativeDucks" class="menu_links">PH Native Ducks</a></li>
                    <li><a href="#news" class="menu_links">News</a></li>
                    <li><a href="#breeders" class="menu_links">Breeders</a></li>
                    <li><a href="http://www.pcaarrd.dost.gov.ph/home/portal/index.php/philippine-transparency-seal/" target="_blank" class="menu_links">Transparency Seal</a></li>
                    <li><a href="{{ route('google_login') }}">Log In</li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#Data" class="menu_links">Data</a></li>
                    <li><a href="#Summary" class="menu_links">Summary</a></li>
                    <li><a href="#PHNativeChickens" class="menu_links">PH Native Chickens</a></li>
                    <li><a href="#PHNativeDucks" class="menu_links">PH Native Ducks</a></li>
                    <li><a href="{{ route('news') }}" class="menu_links">News</a></li>
                    <li><a href="#breeders" class="menu_links">Breeders</a></li>
                    <li><a href="http://www.pcaarrd.dost.gov.ph/home/portal/index.php/philippine-transparency-seal/" target="_blank" class="menu_links">Transparency Seal</a></li>
                    <li><a href="{{ route('google_login') }}"><i class="fab fa-google left"></i>Log In</a></li>
                </ul>
            </div>
        </nav>
        <nav id="nativepoultry" style="background:#6d929b;">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12 m10">
                        <a href="{{ url('/') }}" class="brand-logo"><img id="nav-logo-image"
                            src="{{asset('media/pcaarrd-native-chicken-header.png')}}" alt="Philippine Native Chicken and Itik Pinas Breed Information System" height="140" style="margin-top:10px;" /></a>   
                    </div>
                    <div class="col s12 m2">
                        <a href="http://www.pcaarrd.dost.gov.ph/home/portal/index.php/philippine-transparency-seal/" target="_blank"><img src="{{asset('media/transparency-seal.png')}}" width="100%" /></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    {{-- SLIDER --}}
    <div class="grey darken-3">
        <div class="slideshow-container">

            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/FH2x3Gb/darag1-1.png')"></div>
                <div class="text">Darag Native Chicken</div>
            </div>

            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/qYDGLVP/boholano-2.png')">
                </div>
                <div class="text">Boholano Native Chicken</div>
            </div>
            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/z5LnxzW/IMG-0600.png')"></div>
                <div class="text">Camarines Native Chicken © T. Pequeña</div>
            </div>
            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/xFKfW8h/zampencarousel.png')">
                </div>
                <div class="text">ZamPen Native Chicken © M.J. Cuadra</div>
            </div>
            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/7VX3NzN/khaki-1.png')"></div>
                <div class="text">IP Khaki © Karen Dimaranan</div>
            </div>
            <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/1JWyJFC/itimss.png')"></div>
                <div class="text">IP Itim © Karen Dimaranan</div>
            </div>
        </div>
    </div>
    <br />
    <div style='text-align: center;'>
        <span class="dot" onclick='currentSlide(1)'></span>
        <span class="dot" onclick='currentSlide(2)'></span>
        <span class="dot" onclick='currentSlide(3)'></span>
        <span class="dot" onclick='currentSlide(4)'></span>
        <span class="dot" onclick='currentSlide(5)'></span>
        <span class="dot" onclick='currentSlide(6)'></span>
    </div>
    </div>

    <main>
        <div class="container" id="app">
            @yield('content')
            <div id="back_to_top" class="fixed-action-btn">
                <a class="btn-floating btn-large blue-grey darken-1" onclick="topFunction()">
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
        </div>
    </main>
    <footer class="page-footer blue-grey lighten-3">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <img src="{{asset('media/logo-poultry.png')}}" height="175" />
                    <h5 class="black-text">Philippine Native Chicken and Itik Pinas Breed Information System</h5>
                    <p class="black-text">
                        The "Development of Philippine Native Chicken and Itik Pinas Information System" is a
                        DOST-PCAARRD funded project of the Institute of Animal Science in cooperation with the Institute
                        of Computer Science, University of the Philippines Los Baños.
                        The project aims to provide an accessible information source regarding selected Philippine
                        Native Chicken and Itik PINAS breeds.
                    </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <div class="row">
                        <div class="col s4">
                            <a href="http://www.dost.gov.ph/"><img class="footer-image"
                                    src="https://i.ibb.co/wrnwGHw/dost.png" alt="dost" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://www.pcaarrd.dost.gov.ph/home/portal/"><img class="footer-image"
                                    src="https://i.ibb.co/TWXZ0fg/pcaarrd.png" alt="pcaarrd" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://uplb.edu.ph/"><img class="footer-image"
                                    src="https://i.ibb.co/3y3rwGb/uplb.png" alt="uplb" border="0"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <a href="https://ias.cafs.uplb.edu.ph/"><img class="footer-image"
                                    src="https://i.ibb.co/FxyW47Y/ias.png" alt="ias" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="http://ics.uplb.edu.ph/"><img class="footer-image"
                                    src="https://i.ibb.co/hMQFmfr/ics.png" alt="ics" border="0"></a>
                        </div>
                        <div class="col s4">
                            <a href="#" onclick="return false;"><img class="footer-image"
                                    src="https://image.ibb.co/nqiNCA/logo-default.png" alt="logo-default"
                                    border="0"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer style="background:#efefef;color:#444;font-size:0.8em;">
        <div class="container" style="margin-top:30px;">
            <div class="row">
                <div class="m3 col">
                    <img src="http://www.pcaarrd.dost.gov.ph/home/portal/images/govph-seal-mono-footer.png"
                        width="200" />
                </div>
                <div class="m3 col">
                    Republic of the Philippines<br />
                    All content is in the public domain unless otherwise stated.
                </div>
                <div class="m3 col">
                    About GOVPH<br />
                    Learn more about the Philippine government, its structure, how government works and the people
                    behind it.
                    <br /><br />
                    <a href="https://www.gov.ph">Official Gazette</a><br />
                    <a href="https://data.gov.ph">Open Data Portal</a>
                </div>
                <div class="m3 col">
                    Government Links<br /><br />
                    <a href="http://president.gov.ph/">Office of the President</a><br />
                    <a href="http://ovp.gov.ph/">Office of the Vice President</a><br />
                    <a href="http://www.senate.gov.ph/">Senate of the Philippines</a><br />
                    <a href="http://www.congress.gov.ph/">House of Representatives</a><br />
                    <a href="http://sc.judiciary.gov.ph/">Supreme Court</a><br />
                    <a href="http://ca.judiciary.gov.ph/">Court of Appeals</a><br />
                    <a href="http://sb.judiciary.gov.ph/">Sandiganbayan</a><br />
                </div>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/thirdparty/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/thirdparty/materialize/js/materialize.min.js') }}"></script>
    <script>
        var slideIndex = 1;

        var myTimer;

        window.addEventListener("load", function() {
            showSlides(slideIndex);
            myTimer = setInterval(function() {
                plusSlides(1)
            }, 4000);
        })

        function plusSlides(n) {
            clearInterval(myTimer);
            if (n < 0) {
                showSlides(slideIndex -= 1);
            } else {
                showSlides(slideIndex += 1);
            }
            if (n === -1) {
                myTimer = setInterval(function() {
                    plusSlides(n + 2)
                }, 4000);
            } else {
                myTimer = setInterval(function() {
                    plusSlides(n + 1)
                }, 4000);
            }
        }

        function currentSlide(n) {
            clearInterval(myTimer);
            myTimer = setInterval(function() {
                plusSlides(n + 1)
            }, 4000);
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
                document.getElementById("back_to_top").style.display = "block";
            } else {
                document.getElementById("back_to_top").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        $(document).ready(function() {
            $(".button-collapse").sideNav({
                closeOnClick: false,
            });
            $('.scrollspy').scrollSpy({
                scrollOfffset: 110,
                activeClass: null
            });
            tippy('#home', {
                target: '.tooltip',
                arrow: true,
                arrowType: 'round',
                animation: 'scale',
                inertia: true,
            });
        });
    </script>
</body>

</html>
