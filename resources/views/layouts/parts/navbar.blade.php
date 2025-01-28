<div class="theme-main-menu sticky-menu theme-menu-one">
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-4 col-5">
                <a href="{{route('front.home')}}" class="d-block"><img class="logo" src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" style="width:230px;"></a>
            </div>
            <div class="col-md-5 col-xs-5 col-2"></div>
            <div class="col-md-3 col-xs-3 col-5">
                <ul class="navbar-menu">
                    @if (auth()->check())
                    <li><a href="{{route('dashboard.account.index')}}" class="user-account"><i class="fas fa-user"></i></a></li>
                    <li><a href="{{route('logout')}}" class="sign-up"><i class="fas fa-unlock-alt"></i></a></li>
                    @else
                        <li><a href="{{route('filament.admin.auth.login')}}">Iniciar sesión</a></li>
                    @endif
                </ul>
            </div>
        </div>
	</div>
    <div class="border-curve" style="background-image: url('{{asset('images/border-curve.png')}}')"></div>
</div>
