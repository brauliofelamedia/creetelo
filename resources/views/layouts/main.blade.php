<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="">
		<meta name="description" content="">
      	<meta property="og:site_name" content="Creételo Club">
      	<meta property="og:url" content="https://creetelo.club">
      	<meta property="og:type" content="website">
      	<meta property="og:title" content="#">
		<meta name="og:image" content="images/assets/ogg.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="theme-color" content="#6dbfb8">
		<meta name="msapplication-navbutton-color" content="#6dbfb8">
		<meta name="apple-mobile-web-app-status-bar-style" content="#6dbfb8">
		<title>Creételo Club - Michelle Poler</title>
		<link rel="icon" type="image/png" sizes="72x33" href="{{asset('images/favicon.png')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" media="all">
		<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" media="all">
		@stack('css')
		<!-- Fix Internet Explorer ______________________________________-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="{{asset('vendor/html5shiv.js')}}"></script>
			<script src="{{asset('vendor/respond.js')}}"></script>
		<![endif]-->
	</head>

	<body>
		<div class="main-page-wrapper">
			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="preloader">
				<div id="khoj-preloader" class="khoj-preloader">
					<div class="animation-preloader">
					  <h1>Créetelo</h1>
                    </div>
				</div>
			</div>

			@include('layouts.parts.navbar')

            @yield('content')

			<div class="pt-20 pb-20 footer-one">
				<div class="container">
					<div class="row">
						<div class="pt-20 text-center copy-right" data-aos="zoom-in">
							<h5>{{env('APP_NAME')}} {{date('Y')}}©. Todos los derechos reservados</h5>
						</div>
					</div>
				</div>
			</div>
			<!-- =========================================
			Footer
			============================================= -->
			<button class="scroll-top">
				<i class="bi bi-arrow-up-short"></i>
			</button>
		<!-- Optional JavaScript   -->
    	<!-- jQuery first, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="{{asset('vendor/jquery.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AOS js -->
		<script src="{{asset('vendor/aos-next/dist/aos.js')}}"></script>
		<!-- Slick Slider -->
		<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
		<!-- js Counter -->
		<script src="{{asset('vendor/jquery.counterup.min.js')}}"></script>
		<script src="{{asset('vendor/jquery.waypoints.min.js')}}"></script>
		<!-- Theme js -->
		@stack('js')
		<script src="{{asset('js/theme.js')}}"></script>
		</div> <!-- /.main-page-wrapper -->
	</body>
</html>
