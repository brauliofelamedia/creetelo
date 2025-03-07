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
        <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css"/>
		<link rel="icon" type="image/png" sizes="72x33" href="{{asset('images/favicon.png')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" media="all">
		<link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" media="all">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
            integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
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
            @yield('content')			
			<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
			@stack('js')
		</div> <!-- /.min-page-wrapper -->
	</body>
</html>
