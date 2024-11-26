<div class="theme-main-menu sticky-menu theme-menu-one">
	<div class="inner-content container">
		<div class="d-flex align-items-center justify-content-between">
			<div class="d-flex logo order-lg-0"><a href="{{route('front.home')}}" class="d-block"><img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" style="width:230px;"></a></div>
			<div class="right-wiget d-lg-flex align-items-center order-lg-3 ">
				<div class="people"><a href="{{route('dashboard.account.index')}}"><img src="{{asset('images/icon/user.svg')}}" alt="user"></a></div>
				@if (auth()->check())
					<form action="{{route('filament.admin.auth.logout')}}" method="post">
						@csrf
						<button type="submit" class="sign-up"><a class="custom-btn">Cerrar sesión</a></button>
					</form>
				@else
					<div class="sign-up"><a class="custom-btn" href="{{route('dashboard.account.login')}}">Iniciar sesión</a></div>
				@endif
			</div>
		</div>
	</div>
</div>