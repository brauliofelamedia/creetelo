@extends('layouts.main')

@push('css')
<style>
    .avatar {
        height: 290px;
        background-size: cover;
        background-repeat: no-repeat;
        width: 290px;
        background-position: center;
        border-radius: 50%;
        position: relative;
    }

    .avatar .country {
        position: absolute;
        bottom: 26px;
        right: 20px;
    }

    .avatar .country svg {
        width: 50px;
        box-shadow: 0 0 10px rgba(1, 1, 1, 0.2);
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

    h5 {
        font-weight: bold;
        margin: 0;
    }

    h1 {
        font-size: 50px;
        font-weight: 700;
        color: white;
    }

    .social-link-front {
        list-style-type: none;
        border: 0!important;
        padding: 0!important;
    }

    .accordion-item {
        margin-bottom: 5px;
    }

    .accordion-header {
        background-color: #292775;
        padding: 20px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        color: white;
        text-transform: uppercase;
    }

    .accordion-content {
        display: none;
        padding: 20px;
        background-color: #efefef;
    }

    .social-link-front {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .social-link-front li a {
        background-color:#292775;
        color: white;
    }

    .social-link-front li a:hover {
        background-color: white;
        color: #292775;
    }

    .ocupation {
        font-size:18px;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
    }
    .skills {
        margin-top: 30px;
        list-style-type: none;
    }

    .accordion-content .candidate-list-2 h5 {
        font-size: 16px;
    }

    .accordion-content .candidate-list-2 p {
        font-size: 16px;
    }

    .skills li {
        background-color: #292775;
        display: inline-block;
        border-radius: 9px;
        padding: 7px 10px;
        color: white;
    }

    .skills li:hover {
        background-color: #33308a;
    }

    .skills li:hover a {
        color: white;
    }

    .about-me {
        line-height: 1.5em;
        color: #e7e7e7;
        margin-top: 22px;
        font-size: 16px;
        width: 80%;
    }

    .line {
        width: 85px;
        height: 3px;
        background-color: white;
        margin-top: 10px;
    }

    @media (max-width: 992px) {
        .about-us-banner {
            background-position: right bottom;
        }

        .social-link-front {
            right: 20px;
        }

        h1 {
            font-size: 35px;
        }

        .about-me {
            line-height: 1.3em;
            font-size: 15px;
            width: 100%;
        }

        #about-me, .recent-job {
            padding: 0 30px;
        }
    }

    @media (max-width: 768px) {
        .avatar {
            margin:0 auto;
            margin-bottom: 20px;
        }

        .container {
            max-width: 90%;
        }

        #about-me, .recent-job {
            padding: 0;
        }
    }

    @media (max-width: 480px) {
        h1 {
            font-size: 27px;
        }

        .ocupation {
            font-size: 15px;
        }

        .about-me {
            width: 100%;
        }
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

    <section class="pt-40 pb-40 mb-50 mt-60 md-mt-10" style="background-color:#e55707;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="avatar" style="background-image:url('{{$user->avatar}}');">
                        <span class="country">{{ flag($user->country, 'w-32') }}</span>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8" style="position: relative;">
                        <h1>{{$user->fullname}}</h1>
                        <p class="ocupation">{{$user->ocupation}}</p>
                        <div class="line"></div>
                        <p class="about-me">{{$user->about_me}}</p>
                        @if($user->abilities)
                            <ul class="skills">
                                @foreach ($user->abilities as $ability)
                                    @php
                                        $new_title = str_replace(' ', '+', $ability->skill->name);
                                    @endphp
                                    <li><a href="{{route('front.home')}}?search={{$new_title}}#feature-job-grid">{{$ability->skill->name}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                        @if(!is_null($user->socials))
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
                        @endif
                </div>
            </div>
        </div>
    </section>

    <section id="about-me">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    @if($user->additional->how_vain)
                        <div class="mb-10 candidate-list-2">
                            <h5>Hola! Soy una Creída muy:</h5><p>{{$user->additional->how_vain}}</p>
                        </div>
                    @endif
                    @if($user->additional->skills)
                        <div class="mb-10 candidate-list-2">
                            <h5>Soy increíble en (mis habilidades):</h5><p>{{$user->additional->skills}}</p>
                        </div>
                    @endif
                    @if($user->additional->business_about)
                        <div class="mb-10 candidate-list-2">
                            <h5>Mi emprendimiento trata sobre:</h5><p>{{$user->additional->business_about}}</p>
                        </div>
                    @endif
                    @if($user->additional->corporate_job)
                        <div class="mb-10 candidate-list-2">
                            <h5>Trabajo en el corporativo, me dedico a:</h5><p>{{$user->additional->corporate_job}}</p>
                        </div>
                    @endif
                    @if($user->additional->mission)
                        <div class="mb-10 candidate-list-2">
                            <h5>Mi misión es ayudar a que más personas:</h5><p>{{$user->additional->mission}}</p>
                        </div>
                    @endif
                    @if($user->additional->ideal_audience)
                        <div class="mb-10 candidate-list-2">
                            <h5>Mi audiencia IDEAL es:</h5><p>{{$user->additional->ideal_audience}}</p>
                        </div>
                    @endif
                    @if($user->additional->dont_work_with)
                        <div class="mb-10 candidate-list-2">
                            <h5>Prefiero no trabajar con personas que:</h5><p>{{$user->additional->dont_work_with}}</p>
                        </div>
                    @endif
                    @if($user->additional->values)
                        <div class="mb-10 candidate-list-2">
                            <h5>Mis valores más importantes son:</h5><p>{{$user->additional->values}}</p>
                        </div>
                    @endif
                    @if($user->additional->tone)
                        <div class="mb-10 candidate-list-2">
                            <h5>Mi tono es:</h5><p>{{$user->additional->tone}}</p>
                        </div>
                    @endif
                    @if($user->additional->looking_for_in_creelo)
                        <div class="mb-10 candidate-list-2">
                            <h5>Entré a Créetelo buscando:</h5><p>{{$user->additional->looking_for_in_creelo}}</p>
                        </div>
                    @endif

                    <div class="accordion">
                        <div class="accordion-item">
                          <h2 class="accordion-header">Más sobre ti</h2>
                          <div class="accordion-content">
                            @if($user->additional->birthplace)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Dónde naciste y creciste?:</h5><p>{{$user->additional->birthplace}}</p>
                                </div>
                            @endif
                            @if($user->additional->sign)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué signo eres?:</h5><p>{{$user->additional->sign}}</p>
                                </div>
                            @endif
                            @if($user->additional->hobbies)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Tienes hobbies?:</h5><p>{{$user->additional->hobbies}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_drink)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Bebida favorita?:</h5><p>{{$user->additional->favorite_drink}}</p>
                                </div>
                            @endif
                            @if($user->additional->has_children)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Tienes hijos?:</h5><p>{{$user->additional->has_children}}</p>
                                </div>
                            @endif
                            @if($user->additional->is_married)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Estás casada?:</h5><p>{{$user->additional->is_married}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_trip)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Tu viaje favorito que has hecho?:</h5><p>{{$user->additional->favorite_trip}}</p>
                                </div>
                            @endif
                            @if($user->additional->next_trip)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿A dónde te gustaría viajar next?:</h5><p>{{$user->additional->next_trip}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_dessert)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Postre favorito?:</h5><p>{{$user->additional->favorite_dessert}}</p>
                                </div>
                            @endif
                            @if($user->additional->favorite_food)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Comida favorita? (si, el postre va primero):</h5><p>{{$user->additional->favorite_food}}</p>
                                </div>
                            @endif
                            @if($user->additional->movie_recommendation)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué serie o película recomiendas mucho?:</h5><p>{{$user->additional->movie_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->book_recommendation)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué libro recomiendas? (Aparte de Hello Fears, obvi):</h5><p>{{$user->additional->book_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->podcast_recommendation)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué PODCAST amas?:</h5><p>{{$user->additional->podcast_recommendation}}</p>
                                </div>
                            @endif
                            @if($user->additional->podcast_recommendation)
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué PODCAST amas?:</h5><p>{{$user->additional->podcast_recommendation}}</p>
                                </div>
                            @endif
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">Para cerrar</h2>
                            <div class="accordion-content">
                                @if($user->additional->irreplaceable)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{$user->additional->irreplaceable}}</p>
                                    </div>
                                @endif
                                @if($user->additional->achievement)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Algún LOGRO que nos quieras compartir importante para ti?:</h5><p>{{$user->additional->achievement}}</p>
                                    </div>
                                @endif
                                @if($user->additional->biggest_dream)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Te atreves a contarnos tu sueño más grande? #manifiestababy:</h5><p>{{$user->additional->biggest_dream}}</p>
                                    </div>
                                @endif
                                @if($user->additional->irreplaceable)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{$user->additional->irreplaceable}}</p>
                                    </div>
                                @endif
                                @if($user->additional->like_to_receive)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Qué te gustaría recibir?:</h5><p>{{$user->additional->like_to_receive}}</p>
                                    </div>
                                @endif
                                @if($user->additional->brings_you_happiness)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Qué te hace bien o te trae felicidad?:</h5><p>{{$user->additional->brings_you_happiness}}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">Somos Abundantes</h2>
                            <div class="accordion-content">
                                @if($user->additional->gift)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>¿Qué te gustaría regalar? (Una guía, una meditación, un producto, una mentoría, una sesión, una clase...):</h5><p>{{$user->additional->gift}}</p>
                                    </div>
                                @endif
                                @if($user->additional->gift_link)
                                    <div class="mb-10 candidate-list-2">
                                        <h5>Comparte un link:</h5><p>{{$user->additional->gift_link}}</p>
                                    </div>
                                @endif
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
                    <h2 class="mb-20 heading-3 mt-50 md-mb-90">Otros perfiles</h2>
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

@push('js')
    <script>
        $(document).ready(function(){
            $(".accordion-header").click(function(){
                $(this).next().slideToggle();
            });
        });
    </script>
@endpush
