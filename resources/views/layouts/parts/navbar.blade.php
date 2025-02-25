<div class="theme-main-menu sticky-menu theme-menu-one">
	<div class="container">
        <div class="row">
            <div class="col-lg-4 col-xs-4 col-5">
                <a href="{{route('front.home')}}" class="d-block"><img class="logo" src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" style="width:230px;"></a>
            </div>
            <div class="col-lg-3 offset-lg-5 col-xs-3 col-7">
                <ul class="navbar-menu">
                    @if (auth()->check())
                        <li><a style="font-weight:500;" href="{{route('dashboard.account.index')}}" class="user-account"><i class="fas fa-user"></i> <span class="hidden-phone">Mi Perfil</span></a></li>
                        <li><a href="{{route('logout')}}" class="sign-up"><i class="fas fa-unlock-alt"></i></a></li>
                        @if (auth()->user()->hasRole(['admin', 'super_admin']))
                           <li><a href="{{route('filament.admin.pages.dashboard')}}" class="sign-up"><i class="fas fa-user-cog"></i></a></li>
                        @endif
                    @else
                        <li><a href="{{route('filament.admin.auth.login')}}"><i class="fas fa-user"></i> <span class="hidden-phone">Iniciar sesión</span></a></li>
                    @endif
                </ul>
            </div>
        </div>
	</div>
    <div class="border-curve" style="background-image: url('{{asset('images/border-curve.png')}}')"></div>
</div>
