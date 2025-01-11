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

    .mb-20 {
        margin-bottom: 10px!important;
    }

    h2 {
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-size: 22px;
        color: #e55707;
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

    .online {
        background: green;
        color: white;
        border-color: white;
        padding: 5px 10px;
        border-radius: 7px;
        border: 1px solid #ececec;
    }

    h5 {
        margin-bottom: 0;
    }
    .country {
        position: absolute;
        bottom: 0;
        right: 20px;
    }

    .country svg {
        width: 30px;
        box-shadow: 0 0 10px rgba(1, 1, 1, 0.2);
    }
</style>
@endpush

@section('content')

    <div class="about-us-banner" style="background-image: url('{{asset('images/banner-detail.png')}}')" style="background-position: 0 -90px!important;padding: 60px 0!important;">
        <div class="about-three-rapper position-relative">
            <img src="{{asset('images/shape/shape-2.png')}}" alt="" class="shape shape-12">
            <img src="{{asset('images/shape/shape-3.png')}}" alt="" class="shape shape-13">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-center mt-300 md-mt-100 pb-30">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="job-details mb-160 md-mb-80 pt-70">
        <div class="job-details-rapper">
            <div class="container">
                <div class="px-0 row gx-5">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-20 candidates-details-left d-flex flex-column justify-content-center pt-60">
                            <div class="save-candidate d-flex align-items-start justify-content-start">
                                <div class="country-top">{{ flag($user->country) }}</div>
                                <img src="{{$user->avatar}}" alt="#">
                                <span class="online">Disponible</span>
                            </div>
                            <div class="Profile-name pt-30 d-flex flex-column">
                                <h4 class="mt-20 mb-20">{{$user->fullname}}</h4>
                                <span>{{$user->ocupation}}</span>
                            </div>
                            <div class="pt-40 left-1">
                                <p class="mb-20">Ubicación</p>
                                <span>{{@$user->fullUbication}}</span>
                            </div>
                            @if(!is_null($user->socials))
                                <div class="pt-40 left-1">
                                    <p class="mb-20">Conectemos</p>
                                    <div class="social-link-front">
                                        <ul>
                                            @foreach($user->socials as $social)
                                                @if($social->title == 'email')
                                                    <li><a href="mailto:{{$social->url}}" target="_blank"><i class="bi bi-envelope"></i></a></li>
                                                @elseif($social->title == 'whatsapp')
                                                    <li><a href="https://api.whatsapp.com/send?phone={{$social->url}}" target="_blank"><i class="bi bi-{{$social->title}}"></i></a></li>
                                                @else
                                                    <li><a href="{{$social->url}}" target="_blank"><i class="bi bi-{{$social->title}}"></i></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="candidates-details-left d-flex flex-column justify-content-center pt-60" style="background-color: rgb(41 39 117);color:white;display:none!important;">
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
                            <div class="mb-40 candidate-list-1 d-flex align-items-center justify-content-between" style="display: none!important;">
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
                            @if($user->additional->how_vain)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Hola! Soy una Creída muy:</h5><p>{{$user->additional->how_vain}}</p>
                                </div>
                            @endif
                            @if($user->additional->skills)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Soy increíble en (mis habilidades):</h5><p>{{$user->additional->skills}}</p>
                                </div>
                            @endif
                            @if($user->additional->business_about)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Mi emprendimiento trata sobre:</h5><p>{{$user->additional->business_about}}</p>
                                </div>
                            @endif
                            @if($user->additional->corporate_job)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Trabajo en el corporativo, me dedico a:</h5><p>{{$user->additional->corporate_job}}</p>
                                </div>
                            @endif
                            @if($user->additional->mission)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Mi misión es ayudar a que más personas:</h5><p>{{$user->additional->mission}}</p>
                                </div>
                            @endif
                            @if($user->additional->mission)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Mi audiencia IDEAL es:</h5><p>{{$user->additional->ideal_audience}}</p>
                                </div>
                            @endif
                            @if($user->additional->dont_work_with)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Prefiero no trabajar con personas que:</h5><p>{{$user->additional->dont_work_with}}</p>
                                </div>
                            @endif
                            @if($user->additional->values)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Mis valores más importantes son:</h5><p>{{$user->additional->values}}</p>
                                </div>
                            @endif
                            @if($user->additional->tone)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Mi tono es:</h5><p>{{$user->additional->tone}}</p>
                                </div>
                            @endif
                            @if($user->additional->looking_for_in_creelo)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Entré a Créetelo buscando:</h5><p>{{$user->additional->looking_for_in_creelo}}</p>
                                </div>
                            @endif
                            <h2>Más sobre TI:</h2>
                            @if($user->additional->birthplace)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Dónde naciste y creciste?:</h5><p>{{$user->additional->birthplace}}</p>
                                </div>
                            @endif
                            @if($user->additional->sign)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué signo eres?:</h5><p>{{$user->additional->sign}}</p>
                                </div>
                            @endif
                            @if($user->additional->hobbies)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Tienes hobbies?:</h5><p>{{$user->additional->hobbies}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_drink)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Bebida favorita?:</h5><p>{{$user->additional->favorite_drink}}</p>
                                </div>
                            @endif
                            @if($user->additional->has_children)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Tienes hijos?:</h5><p>{{$user->additional->has_children}}</p>
                                </div>
                            @endif
                            @if($user->additional->is_married)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Estás casada?:</h5><p>{{$user->additional->is_married}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_trip)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Tu viaje favorito que has hecho?:</h5><p>{{$user->additional->favorite_trip}}</p>
                                </div>
                            @endif
                            @if($user->additional->next_trip)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿A dónde te gustaría viajar next?:</h5><p>{{$user->additional->next_trip}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_dessert)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Postre favorito?:</h5><p>{{$user->additional->favorite_dessert}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_food)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Comida favorita? (si, el postre va primero):</h5><p>{{$user->additional->favorite_food}}</p>
                                </div>
                            @endif
                            @if($user->additional->movie_recommendation)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué serie o película recomiendas mucho?:</h5><p>{{$user->additional->movie_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->book_recommendation)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué libro recomiendas? (Aparte de Hello Fears, obvi):</h5><p>{{$user->additional->book_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->podcast_recommendation)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué PODCAST amas?:</h5><p>{{$user->additional->podcast_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->podcast_recommendation)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué PODCAST amas?:</h5><p>{{$user->additional->podcast_recommendation}}</p>
                                </div>
                            @endif
                            <h2>Para cerrar:</h2>
                            @if($user->additional->irreplaceable)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{$user->additional->irreplaceable}}</p>
                                </div>
                            @endif
                            @if($user->additional->achievement)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Algún LOGRO que nos quieras compartir importante para ti?:</h5><p>{{$user->additional->achievement}}</p>
                                </div>
                            @endif
                            @if($user->additional->biggest_dream)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Te atreves a contarnos tu sueño más grande? #manifiestababy:</h5><p>{{$user->additional->biggest_dream}}</p>
                                </div>
                            @endif
                            @if($user->additional->irreplaceable)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{$user->additional->irreplaceable}}</p>
                                </div>
                            @endif
                            @if($user->additional->like_to_receive)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué te gustaría recibir?:</h5><p>{{$user->additional->like_to_receive}}</p>
                                </div>
                            @endif
                            @if($user->additional->brings_you_happiness)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué te hace bien o te trae felicidad?:</h5><p>{{$user->additional->brings_you_happiness}}</p>
                                </div>
                            @endif
                            <h2>SOMOS ABUNDANTES</h2>
                            @if($user->additional->gift)
                                <div class="mb-20 candidate-list-2">
                                    <h5>¿Qué te gustaría regalar? (Una guía, una meditación, un producto, una mentoría, una sesión, una clase...):</h5><p>{{$user->additional->gift}}</p>
                                </div>
                            @endif
                            @if($user->additional->gift_link)
                                <div class="mb-20 candidate-list-2">
                                    <h5>Comparte un link:</h5><p>{{$user->additional->gift_link}}</p>
                                </div>
                            @endif
                            <div class="candidate-list-5" style="display: none;">
                                <h4 class="mt-50 mb-30">Servicios:</h4>
                                <div class="btn-group d-inline">
                                    @if(!is_null($user->services()))
                                        @foreach($user->services() as $service)
                                            <a href="#" class="btn btn-primary">{{$service->service->ideal_audience}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="candidate-list-5" style="display: none;">
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
                            <div class="px-0 row g-5">
                                <div class="col">
                                    <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                        <div class="round-pic">
                                            <img src="{{$user->avatar}}" alt="{{$user->fullname}}">
                                            <span class="country">{{ flag($user->country, 'w-32') }}</span>
                                        </div>
                                        <div class="Candidates-grid">
                                            <div class="mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                                <div class=" d-flex flex-column align-items-center justify-content-center">
                                                    <h3>{{$user->fullname}}</h3>
                                                    @php
                                                        $countries = Config::get('countries.countries');
                                                        $countryName = $countries[$user['country']] ?? '-';
                                                        ($countryName == 'Mexico')? $countryName = 'México': $countryName;
                                                    @endphp
                                                    <span>{{$countryName}}</span>
                                                </div>
                                            </div>
                                            <div class="pt-20 top-grid-4 d-flex flex-column align-items-center justify-content-center">
                                                <a href="{{route('front.contact.detail',$user->slug)}}"><span>Conoce esta Creída</span></a>
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
