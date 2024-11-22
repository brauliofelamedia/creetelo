<div class="theme-main-menu sticky-menu theme-menu-one">
	<div class="inner-content container">
		<div class="d-flex align-items-center justify-content-between">
			<div class="d-flex logo order-lg-0"><a href="{{route('front.home')}}" class="d-block"><img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" style="width:200px;"></a></div>
			<div class="right-wiget d-lg-flex align-items-center order-lg-3 ">
				<div class="people"><a href=""><img src="{{asset('images/icon/user.svg')}}" alt="user"></a></div>
				<div class="sign-up"><a class="custom-btn" href="#">Iniciar sesión</a></div>
			</div>
				<!-- ================================================
									nav bar start
				================================================ -->
			<div class="left-wiget">
				<nav class="navbar navbar-expand-lg order-lg-2">
					<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0" style="display: none;">
							<li class="nav-item">
								<a class="nav-link @if(Route::is('front.home')) active @endif" href="{{route('front.home')}}">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link  @if(Route::is('front.about')) active @endif" href="{{route('front.about')}}">Nosotros</a>
							</li>
							<li class="nav-item">
							<a class="nav-link  @if(Route::is('front.contact')) active @endif" href="{{route('front.contact')}}">Contacto</a>
							</li>
						</ul>
						<div class="right-wiget d-flex align-items-center order-lg-3 d-lg-none ">
							<div class="people"><a href=""><img src="{{asset('images/icon/user.svg')}}" alt=""></a></div>
							<div class="sign-up"><a class="custom-btn" href="{{route('front.account.login')}}">Iniciar sesión</a></div>
						</div>
					</div>
				</nav>
			</div>
				<!-- //header nav  -->
				<!-- ================================================
									nav bar start
		================================================ -->
		</div>
	</div>
</div>