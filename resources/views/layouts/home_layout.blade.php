<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins|Raleway&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/thirdparty/fontawesome-free-5.6.0-web/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="/thirdparty/materialize/css/materialize.min.css"  media="screen,projection"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
    <title>PAB-IS | Native Chicken and Itik Pinas</title>
    <style>
        #sidenav-overlay { z-index: 1; }
        html{
            scroll-behavior: smooth;
        }
        .navbar-fixed {
            margin-bottom: 45px; 
        }
        nav {
            height: 110px;
        }
        #gicon{
            margin-top: -5px;
        }
        .nav-wrapper{
            height: 110px;
            padding-top: 5px;
        }
        .nav-button-div{
            padding-top: 20px;
            padding-bottom: 40px;
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
        /* SLIDER CSS */
        .slideshow-container {
            width: 100%;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
            height: 600px;
            width: 100%;
        }
        .mySlides .img{
            background-color: #cccccc; 
            width: 100%;
            height:600px;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .text {
            color: #ffffff;
            font-size: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
            position: absolute;
            bottom: 0;
            width: 100%;
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

        .dot:active{
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
            from {opacity: .4} 
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
        }
        
        #home-content h1 h2 h3 h4 h5 h6 {
            font-family: 'Poppins', sans-serif;
        }
        #home-content p {
            font-family: 'Raleway', sans-serif; 
            font-size: 1.2em;
            text-indent: 3em;
            text-align: justify;
        }
        #home_content {
            font-family: 'Raleway', sans-serif; 
        }
        #home-content .custom-panel{
            height: 500px;
        }
        #home-content .indent{
            text-indent: 3em;
        }

    </style>
</head>
<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper blue-grey darken-1">
                <a href="{{ url('/') }}" class="brand-logo"><img id="nav-logo-image" src="https://image.ibb.co/dBHtKq/logo-poultry.png" alt="poultry-logo"/></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down nav-button-div">
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#Data" class="menu_links">Data</a></li>
                    <li><a href="#Summary" class="menu_links">Summary</a></li>
                    <li><a href="#PHNativeChickens" class="menu_links">PH Native Chickens</a></li>
                    <li><a href="#ChickenBreeds" class="menu_links">Chicken Breeds</a></li>
                    <li><a href="#PHNativeDucks" class="menu_links">PH Native Ducks</a></li>
                    <li><a href="#DuckBreeds" class="menu_links">Duck Breeds</a></li>
                    <li><a href="{{ route('google_login') }}" class="waves-effect waves-light btn-large blue-grey lighten-1"><i id="gicon" class="fab fa-google left"></i>Login</a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="#Home">Home</a></li>
                    <li><a href="#Data" class="menu_links">Data</a></li>
                    <li><a href="#Summary" class="menu_links">Summary</a></li>
                    <li><a href="#PHNativeChickens" class="menu_links">PH Native Chickens</a></li>
                    <li><a href="#ChickenBreeds" class="menu_links">Chicken Breeds</a></li>
                    <li><a href="#PHNativeDucks" class="menu_links">PH Native Ducks</a></li>
                    <li><a href="#DuckBreeds" class="menu_links">Duck Breeds</a></li>
                    <li><a href="{{ route('google_login') }}"><i class="fab fa-google left"></i>Login</a></li>
                </ul>
            </div>
        </nav>
    </div>

    {{-- SLIDER --}}
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="img" style="background-image:url('https://i.ibb.co/FH2x3Gb/darag1-1.png')"></div>
            <div class="text">Darag Native Chicken</div>
        </div>
        
        <div class="mySlides fade">
            <div class="img" style="background-image:url('https://i.ibb.co/qYDGLVP/boholano-2.png')"></div>
            <div class="text">Boholano Native Chicken</div>
        </div>
        <div class="mySlides fade">
            <div class="img" style="background-image:url('https://i.ibb.co/z5LnxzW/IMG-0600.png')"></div>
            <div class="text">Camarines Native Chicken © T. Pequeña</div>
        </div>
        <div class="mySlides fade">
                <div class="img" style="background-image:url('https://i.ibb.co/xFKfW8h/zampencarousel.png')"></div>
                <div class="text">Zampen Native Chicken</div>
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
    <br/>
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
                    <h5 class="black-text">Philippine Native Chicken and Itik Pinas Breed Information System</h5>
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
        var slideIndex = 1;

        var myTimer;

        window.addEventListener("load",function() {
            showSlides(slideIndex);
            myTimer = setInterval(function(){plusSlides(1)}, 4000);
        })

        // NEXT AND PREVIOUS CONTROL
        function plusSlides(n){
        clearInterval(myTimer);
        if (n < 0){
            showSlides(slideIndex -= 1);
        } else {
        showSlides(slideIndex += 1); 
        }
        if (n === -1){
            myTimer = setInterval(function(){plusSlides(n + 2)}, 4000);
        } else {
            myTimer = setInterval(function(){plusSlides(n + 1)}, 4000);
        }
        }

        //Controls the current slide and resets interval if needed
        function currentSlide(n){
        clearInterval(myTimer);
        myTimer = setInterval(function(){plusSlides(n + 1)}, 4000);
        showSlides(slideIndex = n);
        }

        function showSlides(n){
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
        
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
                document.getElementById("back_to_top").style.display = "block";
            } else {
                document.getElementById("back_to_top").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
        $( document ).ready(function() {
            $(".button-collapse").sideNav({
                closeOnClick: false,
            });
            $('.scrollspy').scrollSpy({
                scrollOfffset: 110,
                activeClass : null
            });
        });
        
    </script>
</body>
</html>