<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="job Search, Career, Resume, Career Builder, Employment">
		<meta name="description" content="Khuj - the job finder HTML5 Template is designed especially for the  job related agency, multipurpose and business and those who offer job related services.">
      	<meta property="og:site_name" content="Khuj">
      	<meta property="og:url" content="https://sayfurrahaman.com/">
      	<meta property="og:type" content="website">
      	<meta property="og:title" content="Khuj - the job finder HTML5 Template">
		<meta name="og:image" content="images/assets/ogg.png">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- For Window Tab Color -->
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#6dbfb8">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#6dbfb8">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#6dbfb8">
		<title>Khuj-the job finder HTML5 Template</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="72x33" href="images/fabicon.png">
		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" media="all">
		<!-- responsive style sheet -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" media="all">

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

			<section class="subscribe-one pb-80">
				<div class="container">
					<div class="row g-5 d-flex align-items-center">
						<div class="col-lg-6">
							<div class="subscriber-content-left">
								<h2 class="">Subscribe to Our<br> Newsletter</h2>
							</div>	
						</div>
						<div class="col-lg-6 ms-auto">
							<div class="subscriber-content-right">
								<form class="">
									<input type="email" placeholder="Your Email Address">
									<a href="" class="custom_btn ms-auto">SUBSCRIBE</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>

			<div class="footer-one pt-80 pb-80">
				<div class="container">
					<div class="row d-flex align-items-center">
						<div class="col-lg-8 col-xl-8" data-aos="zoom-in">
							<div class="row">
								<div class="col-lg-8 col-xl-8" data-aos="zoom-in">
									<div class="footer-one_1">
										<img src="images/logo/Logo.png" alt="" class="pb-30">
										<p class="">Collaboratively parallel task functionalized tailers whereas principle-centered schemas. Continually enable multifunctional.</p>
										<div class="social_group pt-40">
											<ul>
												<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
												<li><a href=""><i class="fab fa-twitter"></i></a></li>
												<li><a href=""><i class="fab fa-instagram"></i></a></li>
												<li><a href=""><i class="fab fa-youtube"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-xl-4 ms-auto">
									<div class="footer-one_2">
										<h4>Quick Links</h4>
										<ul>
											<li><a href="">Home</a></li>
											<li><a href="">Popular</a></li>
											<li><a href="">Best Offer</a></li>
											<li><a href="">Destinations</a></li>
											<li><a href="">Changelog</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-xl-4" data-aos="zoom-in">
							<div class="row">
								<div class="col-lg-6 col-xl-6" data-aos="zoom-in">
									<div class="footer-one_2">
										<h4>Company</h4>
										<ul>
											<li><a href="">About</a></li>
											<li><a href="">Contact</a></li>
											<li><a href="">Careers</a></li>
											<li><a href="">Press</a></li>
											<li><a href="">Presentation</a></li>
										</ul>
									</div>	
								</div>
								<div class="col-lg-6 col-xl-6 ms-auto" data-aos="zoom-in">
									<div class="footer-one_2">
										<h4>Services</h4>
										<ul>
											<li><a href="">Contact & Faq</a></li>
											<li><a href="">Track Your Order</a></li>
											<li><a href="">Shipping</a></li>
											<li><a href="">Trade Program</a></li>
										</ul>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="copy-right text-center pt-60" data-aos="zoom-in">
							<h5 class="">Todos los derechos reservados ©{{date('Y')}} Creételo.</h5>
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