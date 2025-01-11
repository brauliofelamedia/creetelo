<div class="theme-main-menu sticky-menu theme-menu-one">
	<div class="container inner-content">
		<div class="d-flex align-items-center justify-content-between">
			<div class="d-flex logo order-lg-0"><a href="{{route('front.home')}}" class="d-block"><img src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" style="width:230px;"></a></div>
			<div class="right-wiget d-lg-flex align-items-center order-lg-3">
				@if (auth()->check())
					<div class="people"><a href="{{route('dashboard.account.index')}}"><img src="{{asset('images/icon/user.svg')}}" alt="user"></a></div>
					<a href="{{route('logout')}}" class="sign-up"><span class="custom-btn"><i class="fas fa-unlock-alt"></i></span></a>
				@else
					<div class="sign-up"><a class="custom-btn" href="{{route('filament.admin.auth.login')}}">Iniciar sesión</a></div>
				@endif
			</div>
		</div>
	</div>
</div>
