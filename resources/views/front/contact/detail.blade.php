@extends('layouts.main')

@push('css')
<style>
    .avatar {
        height: 290px;
        background-color: white;
        background-size: cover;
        background-repeat: no-repeat;
        width: 290px;
        background-position: center;
        border-radius: 50%;
        position: relative;
        border: 8px solid #e45607;
    }

    .avatar .country {
        position: absolute;
        bottom: 26px;
        right: 0;
        border-radius: 50%;
        background-color: white;
        padding: 7px;
        width: 70px;
        height: 70px;
    }

    .avatar .country svg {
        width: 50px;
        margin-top: 11px;
        box-shadow: 0 0 10px rgba(1, 1, 1, 0.2);
        margin-left: 7px;
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

    p {
        font-size: 16px;
        color:#161e39!important;
    }

    h5 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color:#161e39!important;
    }

    h1 {
        font-size: 50px;
        font-weight: 700;
        color:#161e39;
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
        margin-top: 15px;
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

    #about-me {
        background-color: #e1c1f2!important;
    }

    .line {
        width: 85px;
        height: 3px;
        background-color:#161e39;
        margin-top: 10px;
    }

    .about-us-banner {
        background-position: right;
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

        .tabs ul {
            margin-bottom: 10px!important;
        }

        .tabs li {
            float: none!important;
            margin-right: 0!important;
            margin-bottom: 5px;
        }

        .tabs a {
            width: 100%;
        }

        .container {
            max-width: 90%;
        }

        #about-me, .recent-job {
            padding: 50px 0;
        }

        .about-us-banner {
            background-size: auto!important;
            background-position: left!important;
        }
    }

    @media (max-width: 480px) {

        .about-us-banner {
            background-size: auto!important;
            background-position: left!important;
        }
        h1 {
            font-size: 27px;
        }

        .ocupation {
            font-size: 15px;
        }

        .about-me {
            width: 100%;
        }

        .tabs a {
            font-size: 14px!important;
        }

        h2 {
            font-size: 20px!important;
        }

        h5 {
            font-size: 17px!important;
            line-height: 1.3em;
        }

        .tab-content {
            padding: 30px!important;
        }
    }

    .tabs {
        overflow: hidden;
    }

    .tabs ul {
        list-style: none;
        margin: 0;
        padding: 0;
        margin-bottom: 70px;

    }

    .tabs li {
        float: left;
        margin-right: 5px!important;
    }

    .tabs a {
        background-color: #484584;
        padding: 20px 25px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        color: white;
        text-transform: uppercase;
        border-radius: 5px;
    }

    .tabs a.active, .tabs a:hover {
        background-color: #ff5600;
    }

    .tab-content {
        display: none;
        padding: 40px;
        border-top: none;
        background-color: #f3f3f3;
        border-radius: 5px;
    }

    .tab-content h2 {
        text-transform: uppercase;
        font-weight: bold;
        color: #e55707;
        margin-bottom: 20px;
    }

    .tab-content.active {
        display: block;
        clear: both;
        background-color: #fef7ee;
        border: 4px solid #ff5600;
    }

    .tab-content.active h5, .tab-content.active p {
        color: #484584!important;
    }

    a.disabled {
        cursor: not-allowed;
        background-color: #858585 !important;
        color: black;
    }

    a.disabled i {
        color: #e5e5e5;
    }

    #border-curve-me {
        width: 100%;
        height: 40px;
        background-repeat: no-repeat;
        position: absolute;
        bottom: -83px;
        background-size: contain;
    }

    .individual-banner {
        height: 250px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: bottom;
    }

    #info-me {
        position: relative;
    }

    @media (max-width: 480px) {
        .individual-banner {
            height: 220px;
            background-position: right;
        }

        #border-curve-me {
            height: 20px;
            bottom: -30px;
            background-size: 250%;
        }

        .recent-job {
            padding:0!important;
            padding-bottom: 25px!important;
        }

        .skills {
            text-align: center;
        }
        .social-link-front {
            position: relative;
            text-align: center;
            margin: 20px 0;
            right: 0;
        }
    }
</style>
@endpush

@section('content')

    <div class="individual-banner" style="background-image: url('{{asset('images/individual.jpg')}}')"></div>

    <section class="mb-60 mt-60 md-mt-30 md-mb-10" id="info-me">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="avatar" style="background-image:url('{{$user->avatar}}');">
                        @if($user->country)
                            <span class="country">{{ flag($user->country, 'w-32') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8" style="position: relative;">
                        <div class="social-link-front">
                            <ul>
                                <li><a href="{{$user->email}}" class="{{(is_null($user->email))? 'disabled' : ''}}" target="_blank"><i class="bi bi-envelope"></i></a></li>
                                <li><a href="{{$user->whatsapp}}" class="{{(is_null($user->whatsapp))? 'disabled' : ''}}" target="_blank"><i class="bi bi-whatsapp"></i></a></li>
                                <li><a href="{{$user->linkedin}}" class="{{(is_null($user->linkedin))? 'disabled' : ''}}" target="_blank"><i class="bi bi-linkedin"></i></a></li>
                                <li><a href="{{$user->instagram}}" class="{{(is_null($user->instagram))? 'disabled' : ''}}" target="_blank"><i class="bi bi-instagram"></i></a></li>
                            </ul>
                        </div>
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
                </div>
            </div>
        </div>
        <div id="border-curve-me" style="background-image:url('{{asset('images/bottom-cream.png')}}');"></div>
    </section>

    <section id="about-me" class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">

                    <div class="tabs">
                        <ul>
                            <li><a href="#tab1" class="active">Sobre mí</a></li>
                            <li><a href="#tab2">Más sobre ti</a></li>
                            <li><a href="#tab3">Para cerrar</a></li>
                            <li><a href="#tab4">Somos Abundantes</a></li>
                        </ul>
                        <div id="tab1" class="tab-content active">
                            <h2>Sobre mí</h2>
                            <div class="mb-10 candidate-list-2">
                                <h5>Hola! Soy una Creída muy:</h5><p>{{(@$user->additional->how_vain)? @$user->additional->how_vain : '-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Soy increíble en (mis habilidades):</h5><p>{{(@$user->additional->skills)? @$user->additional->skills:'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Mi emprendimiento trata sobre:</h5><p>{{(@$user->additional->business_about)? @$user->additional->business_about:'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Trabajo en el corporativo, me dedico a:</h5><p>{{(@$user->additional->corporate_job)? @$user->additional->corporate_job :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Mi misión es ayudar a que más personas:</h5><p>{{(@$user->additional->mission)? @$user->additional->mission :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Mi audiencia IDEAL es:</h5><p>{{(@$user->additional->ideal_audience)? $user->additional->ideal_audience :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Prefiero no trabajar con personas que:</h5><p>{{(@$user->additional->dont_work_with)? $user->additional->dont_work_with :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Mis valores más importantes son:</h5><p>{{(@$user->additional->values)? @$user->additional->values :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Mi tono es:</h5><p>{{(@$user->additional->tone)? $user->additional->tone :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Entré a Créetelo buscando:</h5><p>{{(@$user->additional->looking_for_in_creelo)? $user->additional->looking_for_in_creelo : '-'}}</p>
                            </div>
                        </div>
                        <div id="tab2" class="tab-content">
                            <h2>Más sobre ti</h2>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Dónde naciste y creciste?:</h5><p>{{(@$user->additional->birthplace)? $user->additional->birthplace :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué signo eres?:</h5><p>{{(@$user->additional->sign)? $user->additional->sign :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Tienes hobbies?:</h5><p>{{(@$user->additional->hobbies)? $user->additional->hobbies :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Bebida favorita?:</h5><p>{{(@$user->additional->favorite_drink)? $user->additional->favorite_drink :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Tienes hijos?:</h5><p>{{(@$user->additional->has_children)? $user->additional->has_children :'-'}}</p>
                            </div>
                            @if(!is_null(@$user->additional->is_married))
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Estás casada?:</h5><p>{{(@$user->additional->is_married)? $user->additional->is_married :'-'}}</p>
                                </div>
                            @endif
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Tu viaje favorito que has hecho?:</h5><p>{{(@$user->additional->favorite_trip)? $user->additional->favorite_trip :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿A dónde te gustaría viajar next?:</h5><p>{{(@$user->additional->next_trip)? $user->additional->next_trip:'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Postre favorito?:</h5><p>{{(@$user->additional->favorite_dessert)? $user->additional->favorite_dessert :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Comida favorita? (si, el postre va primero):</h5><p>{{(@$user->additional->favorite_food)? $user->additional->favorite_food :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué serie o película recomiendas mucho?:</h5><p>{{(@$user->additional->movie_recommendation)? $user->additional->movie_recommendation :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué libro recomiendas? (Aparte de Hello Fears, obvi):</h5><p>{{(@$user->additional->book_recommendation)? $user->additional->book_recommendation :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué PODCAST amas?:</h5><p>{{(@$user->additional->podcast_recommendation)? $user->additional->podcast_recommendation :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué PODCAST amas?:</h5><p>{{(@$user->additional->podcast_recommendation)? $user->additional->podcast_recommendation :'-'}}</p>
                            </div>
                        </div>
                        <div id="tab3" class="tab-content">
                            <h2>Para cerrar</h2>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{(@$user->additional->irreplaceable)? $user->additional->irreplaceable :'-'}}</p>
                                </div>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Algún LOGRO que nos quieras compartir importante para ti?:</h5><p>{{(@$user->additional->achievement)? $user->additional->achievement :'-'}}</p>
                                </div>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Te atreves a contarnos tu sueño más grande? #manifiestababy:</h5><p>{{(@$user->additional->biggest_dream)? $user->additional->biggest_dream :'-'}}</p>
                                </div>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué te hace IRREMPLAZABLE?:</h5><p>{{(@$user->additional->irreplaceable)? $user->additional->irreplaceable :'-'}}</p>
                                </div>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué te gustaría recibir?:</h5><p>{{(@$user->additional->like_to_receive)? $user->additional->like_to_receive :'-'}}</p>
                                </div>
                                <div class="mb-10 candidate-list-2">
                                    <h5>¿Qué te hace bien o te trae felicidad?:</h5><p>{{(@$user->additional->brings_you_happiness)? $user->additional->brings_you_happiness :'-'}}</p>
                                </div>
                        </div>
                        <div id="tab4" class="tab-content">
                            <h2>Somos Abundantes</h2>
                            <div class="mb-10 candidate-list-2">
                                <h5>¿Qué te gustaría regalar? (Una guía, una meditación, un producto, una mentoría, una sesión, una clase...):</h5><p>{{(@$user->additional->gift)? $user->additional->gift :'-'}}</p>
                            </div>
                            <div class="mb-10 candidate-list-2">
                                <h5>Comparte un link:</h5><p>{{(@$user->additional->gift_link)? $user->additional->gift_link :'-'}}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>

    @if($otherUsers->count() > 0)
        <section class="recent-job pb-50 md-pb-80">
            <div class="recent-job-rapper">
                <div class="container">
                    <div class="feature-job-title">
                        <h2 class="mb-20 heading-3 mt-50 md-mb-90" style="color:#484584;">Otros perfiles</h2>
                    </div>
                    <div class="recent-job-slider" id="recent-job-slider">
                        @foreach($otherUsers as $user)
                            <div class="candidates-job-item">
                                <div class="px-0 row g-5">
                                    <div class="col">
                                        <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class="round-pic">
                                                <img src="{{$user->avatar}}" alt="{{$user->fullname}}">
                                                @if($user->country)
                                                        <span class="country">{{ flag($user->country, 'w-32') }}</span>
                                                    @endif
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
    @endif
    

@endsection

@push('js')
    <script>
        $(document).ready(function(){

            //Tabs
            $('.tabs li').click(function() {
                // Obtener el ID del contenido
                let li = $(this);
                $('.tabs li a').removeClass('active');

                li.find('a').addClass('active');
                const targetId = $(this).find('a').attr('href').substring(1);

                // Remover la clase 'active' de todos los tabs y contenidos
                $('.tabs li, .tab-content').removeClass('active');

                // Agregar la clase 'active' al tab y contenido seleccionados
                $(this).addClass('active');
                $('#' + targetId).addClass('active');
            });
        });
    </script>
@endpush
