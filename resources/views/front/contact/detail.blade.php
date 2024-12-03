@extends('layouts.main')

@push('css')
<style>
    .btn-submit {
        background-color: #d17d24;
        padding: 16px 30px;
        width: 100%;
        color: white;
        font-weight: 700;
        text-transform: uppercase;
    }

    .btn-submit:hover {
        color: white;
        background-color: #b16413;
    }

    #form h5 {
        font-weight: 700;
    }

    #form label {
        font-weight: 500;
        font-size: 16px;
    }

    #form span {
        color: red;
    }

    #form p {
        line-height: 1.2em;
        margin-bottom: 15px;
        font-size: 15px;
    }
</style>
@endpush

@section('content')

    <div class="about-us-banner" style="background-image: url('{{asset('images/home.webp')}}')">
        <div class="about-three-rapper position-relative">
            <img src="{{asset('images/shape/shape-2.png')}}" alt="" class="shape shape-12">
            <img src="{{asset('images/shape/shape-3.png')}}" alt="" class="shape shape-13">
            <div class="container">	
                <div class="row d-flex align-items-center justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-100 pb-30">
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <section class="job-details mb-160 md-mb-80 pt-70">
        <div class="job-details-rapper">
            <div class="container">
                <div class="row px-0 gx-5">
                    <div class="col-lg-4">
                        <div class="candidates-details-left d-flex flex-column justify-content-center pt-60 mb-20">
                            <div class="save-candidate d-flex align-items-start justify-content-start">
                                <img src="{{$user->avatar}}" alt="">
                                <span style="background: green;color:white;border-color:white;">Disponible</span>
                            </div>
                            <div class="Profile-name pt-30 d-flex flex-column">
                                <h4 class="mt-20 mb-20">{{$user->fullname}}</h4>
                                <span>{{$user->ocupation}}</span>
                                @if(!is_null($user->socials))
                                    <div class="social-link-front">
                                        <ul>
                                            @foreach($user->socials as $social)
                                                <li><a href="{{$social->url}}" target="_blank"><i class="bi bi-{{$social->title}}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Ubicación</p>
                                <span>{{@$user->fullUbication}}</span>
                            </div>
                        </div>
                        <div class="candidates-details-left d-flex flex-column justify-content-center pt-60" style="background-color: rgb(41 39 117);color:white;">
                            <form action="{{route('front.send_email')}}" method="POST" id="form">
                                @csrf
                                <h5>¡Contáctame ahora!</h5>
                                <p>¿Tienes preguntas o necesitas más información? Completa nuestro formulario y nos pondremos en contacto contigo lo antes posible.</p>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="form-group">
                                    <label>Nombre:<span>*</span></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Correo electrónico:<span>*</span></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>WhatsApp / Teléfono:</label>
                                    <input type="tel" name="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Comentarios:</label>
                                    <textarea name="comments" class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-submit">Solicitar información</button>
                            </form>
                        </div>	
                    </div>
                    <div class="col-lg-8">
                        <div class="candidates-details-right">
                            <div class="candidate-list-1 mb-40 d-flex align-items-center justify-content-between" style="display: none!important;">
                                <div class="Candidate-pic">
                                    <img src="{{$user->avatar}}" alt="{{$user->fullname}}">
                                </div>
                                <div class="Candidate-name d-flex align-items-start justify-content-center flex-column">
                                    <h4 class="mb-20">{{$user->fullname}}</h4>
                                    <div class="mb-20"></div>
                                </div>
                                <div class="candidate-place d-flex align-items-start justify-content-center flex-column">
                                    <div class="mb-20"><span><i class="bi bi-geo-alt"></i></span><span>{{@$user->city}} {{@$user->state}} {{@$user->country}}</span></div>
                                </div>
                                <div class="Candidate-contact">
                                    <a href="#" class="d-flex align-items-center justify-content-center"> <span>Contactame</span></a>
                                </div>
                            </div>
                            <div class="candidate-list-2">
                                <h4 class="mt-50 mb-30">Acerca de mi</h4>
                                <p>{{$user->about_me}}</p>
                            </div>
                            <div class="candidate-list-5">
                                <h4 class="mt-50 mb-30">Servicios:</h4>
                                <div class="btn-group d-inline">
                                    @if(!is_null($user->services()))
                                        @foreach($user->services() as $service)
                                            <a href="#" class="btn btn-primary">{{$service->service->name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="candidate-list-5">
                                <h4 class="mt-50 mb-30">Habilidades:</h4>
                                <p class="mb-30">{{$user->skills}}</p>
                                <div class="btn-group d-inline">
                                    @if(!is_null($user->abilities()))
                                        @foreach($user->abilities as $ability)
                                            <a href="#" class="btn btn-primary">{{$ability->skill->name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="candidate-list-3">
                                <h4 class="mt-50 mb-30">Educación</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="timeline">
                                            <li class="event" data-date="2010-2014">
                                                <h4 class="mb-20">Diploma In Human Interface</h4>
                                                <span>University Of Temporary</span>
                                                <p class="mt-20">Interactively provide access to world-class material for unique  catalysts for change progressive.</p>
                                            </li>
                                            <li class="event" data-date="2014-2016">
                                                <h4 class="mb-20">Diploma In Human Interface</h4>
                                                <span>University Of Temporary</span>
                                                <p class="mt-20">Interactively provide access to world-class material for unique  catalysts for change progressive.</p>
                                            </li>
                                            <li class="event" data-date="2016-2018">
                                                <h4 class="mb-20">Diploma In Human Interface</h4>
                                                <span>University Of Temporary</span>
                                                <p class="mt-20">Interactively provide access to world-class material for unique  catalysts for change progressive.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="recent-job pb-160 md-pb-80">
        <div class="recent-job-rapper">
            <div class="container">
                <div class="feature-job-title">
                    <h3 class="heading-3 mb-60 md-mb-90">Otros perfiles</h3>
                </div>
                <div class="recent-job-slider" id="recent-job-slider">
                    @foreach($otherUsers as $user)
                        <div class="candidates-job-item">
                            <div class="row px-0 g-5">
                                <div class="col">
                                    <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                        <div class="round-pic"><img src="{{$user['avatar']}}" alt=""></div>
                                        <div class="Candidates-grid">
                                            <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                                <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                    <h3>{{(($user['name'])? $user['name'] :'-')}} {{(($user['name'])? $user['last_name'] :'-')}}</h3>
                                                    @php
                                                        $countries = Config::get('countries.countries');
                                                        $countryName = $countries[$user['country']] ?? '-';
                                                        ($countryName == 'Mexico')? $countryName = 'México': $countryName;
                                                    @endphp
                                                    <span>{{$countryName}}</span>
                                                    <ul class="social-link-front">
                                                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                                        <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                                <a href="{{route('front.contact.detail',$user['contact_id'])}}"><span>Ver perfil completo</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>		
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection