@extends('layouts.main')

@push('css')
<style>
    .center-flex {
        justify-content: center;
        display: flex;
        margin: 35px 0;
    }
    li {
        list-style-type: none;
        display: inline;
    }

    .mb-3 {
        position: relative;
        margin-bottom: 21px !important;
    }

    .label-top {
        position: absolute;
        top: -12px;
        background-color: #111d3b;
        color: white;
        border-radius: 6px;
        padding: 2px 10px;
        font-size: 11px;
    }

    .country {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: white;
        box-shadow: 0 0 10px rgba(1, 1, 1, 0.2);
    }

    .country svg {
        width: 30px;
        margin-top: 12px;
        margin-left: 8px;
    }

    .about-three-rapper .logo-directorio {
        width: 40%;
    }

    .logo {
        opacity: 0;
    }

    .page-item {
        margin-right: 5px;
    }

    .page-link, .page-link:hover {
        margin: 0!important;
    }

    .message-paginate {
        margin: 30px auto;
        font-size: 22px;
        text-align: center;
    }
    ul {
        margin:0 auto;
        text-align: center;
    }

    .typed {
        position: absolute;
        left: 0;
        color: black;
        font-size: 18px;
        padding: 15px 20px;
        width: 87%;
        border-radius: 8px;
        text-align: left;
        bottom: -3px;
    }

    .btn-filter {
        background-color: #ff5600;
        float: right;
        font-size: 18px;
        color: white;
        font-weight: 600;
        padding: 9px 30px;
        border-radius: 7px;
    }

    .btn-filter:hover {
        background-color: #e14c01;
        color:white;
    }

    .page-link,.page-link:hover {
        margin-top: 30px;
        padding: 5px 10px;
        background-color: #474588;
        color: white;
        border-radius: 5px;
    }

    .women-mobile {
        display: none;
        width: 80%;
    }

    .form-filter {
        position: relative;
    }

    @media (max-width: 992px) {
        .about-three-rapper h1 {
            font-size: 25px;
            line-height: 1.2em;
        }

        #feature-job-grid {
            padding: 40px;
        }

        .message-paginate {
            margin: 20px auto;
            font-size: 23px;
        }

        .page-link, .page-link:hover {
            margin: 0;
        }
    }

    @media (max-width: 768px) {
        .job-grid-heading .right-grid span {
            font-size: 17px;
        }

        .message-paginate {
            margin: 20px auto;
            font-size: 20px;
        }

        .md-mt-50 {
            margin-top: 0!important;
        }

        .about-three-rapper .logo-directorio {
            width: 60%;
        }

        .about-us-banner {
            padding: 50px 90px;
        }

        .job-grid-heading .right-grid .form-select {
            width: 50%;
            font-size: 16px;
        }

        .job-grid-heading .left-grid span {
            font-size: 16px;
        }

        #feature-job-grid {
            padding: 50px 30px;
        }
    }

    @media (max-width: 480px) {

        .women-mobile {
            display: block!important;
            margin-bottom: 10px;
        }

        .about-us-banner {
            background-image: url('../images/bg-mobile.jpg')!important;
        }

        .page-link, .page-link:hover {
            margin-top: 0;
        }

        .typed {
            font-size: 15px;
        }

        .page-item.disabled, .page-item:nth-child(9), .page-item:nth-child(10) {
            display:none;
        }

        .page-item:first-child {
            display: block!important;
        }

        .job-grid-heading .aos-init:nth-child(1) {
            display: none;
        }
        .about-us-banner {
            position: relative;
            padding: 30px;
            padding-top: 80px;
            padding-bottom: 60px;
            background-position: bottom !important;
        }

        .about-three-rapper h1 {
            font-size: 19px;
            line-height: 1.2em;
            color: #484584;
        }

        .about-three-rapper .logo-directorio {
            width: 65%;
        }

        .job-grid-heading .right-grid {
            display: block!important;
        }

        .job-grid-heading select {
            width: 100%!important;
        }
    }
</style>
@endpush

@section('content')

    <div class="about-us-banner pt-120 pb-120" style="background-image: url('{{asset('images/banner.png')}}')">
        <div class="about-three-rapper position-relative">
            <div class="container">
                <div class="text-center row d-flex align-items-center justify-content-center flex-column">
                    <img src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" class="logo-directorio">
                    <div class="mt-20 d-flex align-items-center justify-content-center md-mt-50">
                        <h1 class="mb-50 mt-50 sm-mb-10 sm-mt-10">Créetelo es una comunidad que empodera a emprendedoras auténticas que quieren aportar a la vida de otros desde su propósito y sus conocimientos.</h1>
                    </div>
                    <img src="{{asset('images/cover-mobile.png')}}" class="women-mobile">
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="get" action="{{route('front.home')}}" class="form-filter">
                            <div class="mb-3">
                                <input type="text" name="search" id="search" class="form-control" value="{{@$search}}">
                                <h4 class="typed">Buscar por <span id="typed"></span></h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                        <!-- Campo para Habilidades -->
                                    <div class="mb-3">
                                        <label class="label-top">Habilidades</label>
                                        <select class="form-control" name="skillSelect">
                                            <option value="*">Todos</option>
                                            @foreach ($skills as $skill)
                                                <option value="{{$skill->id}}" {{($skill->id == $skillSelect)? 'selected':''}}>{{$skill->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Campo para País -->
                                    <div class="mb-3">
                                        <label class="label-top">Paises</label>
                                        <select name="countrySelect" class="form-control" required>
                                            <option value="*">Todos</option>
                                            @foreach($countries as $code => $name)
                                                <option value="{{$code}}" {{($code == $countrySelect)? 'selected':''}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Campo para Estado -->
                                    <div class="mb-3">
                                        <label class="label-top">Estados</label>
                                        <select name="stateSelect" class="form-control" required>
                                            <option value="*">Todas</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->state}}" {{($state->state == $stateSelect)? 'selected':''}}>{{$state->state}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Campo para Ciudad -->
                                    <div class="mb-3">
                                        <label class="label-top">Ciudad</label>
                                        <select name="citySelect" class="form-control" required>
                                            <option value="*">Todas</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->city}}" {{($city->city == $citySelect)? 'selected':''}}>{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Campo para Signo Astral -->
                                    <div class="mb-3">
                                        <label class="label-top">Signo</label>
                                        <select class="form-control" name="signSelect" aria-label="Selecciona tu signo zodiacal">
                                            <option value="*">Todos</option>
                                            <option value="Aries" {{@$signSelect == 'Aries'? 'selected':''}}>Aries</option>
                                            <option value="Tauro" {{@$signSelect == 'Tauro'? 'selected':''}}>Tauro</option>
                                            <option value="Géminis" {{@$signSelect == 'Géminis'? 'selected':''}}>Géminis</option>
                                            <option value="Cáncer" {{@$signSelect == 'Cáncer'? 'selected':''}}>Cáncer</option>
                                            <option value="Leo" {{@$signSelect == 'Leo'? 'selected':''}}>Leo</option>
                                            <option value="Virgo" {{@$signSelect == 'Virgo'? 'selected':''}}>Virgo</option>
                                            <option value="Libra" {{@$signSelect == 'Libra'? 'selected':''}}>Libra</option>
                                            <option value="Escorpio" {{@$signSelect == 'Escorpio'? 'selected':''}}>Escorpio</option>
                                            <option value="Sagitario" {{@$signSelect == 'Sagitario'? 'selected':''}}>Sagitario</option>
                                            <option value="Capricornio" {{@$signSelect == 'Capricornio'? 'selected':''}}>Capricornio</option>
                                            <option value="Acuario" {{@$signSelect == 'Acuario'? 'selected':''}}>Acuario</option>
                                            <option value="Piscis" {{@$signSelect == 'Piscis'? 'selected':''}}>Piscis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Campo para Tienes hijos? -->
                                    <div class="mb-3">
                                        <label class="label-top">¿Tienes hijos?</label>
                                        <select class="form-control" name="childrenSelect" required>
                                            <option value="*">Todos</option>
                                            <option value="si" {{@$childrenSelect == 'si'? 'selected':''}}>Si</option>
                                            <option value="no" {{@$childrenSelect == 'no'? 'selected':''}}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-filter">Buscar</button>
                        </form>
                    </div>
                    <div class="col-xl-12" style="display: none;">
                        <form class="form-3" action="{{route('front.home')}}" method="get">
                            <input type="text" name="search" id="search" class="form-control" required>
                            <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                            <h4 class="typed">Buscar por <span id="typed"></span></h4>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select name="skill[]" multiple="multiple" class="form-control js-example-basic-multiple">
                                                <option value="">Todas las habilidades</option>
                                            @foreach ($skills as $skill)
                                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="feature-job-grid pb-30 pt-30" id="feature-job-grid">
        <div class="feature-job-grid-rapper">
            <div class="container">
                <div class="px-0 row d-flex align-items-center">
                    @if(count($users) >= 1)
                        @foreach($users as $contact)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12">
                                <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic">
                                        <img src="{{$contact->avatar}}" alt="{{$contact->name}}">
                                        @if($contact->country)
                                            <span class="country">{{ flag($contact->country, 'w-32') }}</span>
                                        @endif
                                    </div>
                                    <div class="Candidates-grid">
                                        <div class="mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center">
                                                <h3>{{$contact->full_name}}</h3>
                                                @php
                                                    $countries = Config::get('countries.countries');
                                                    $countryName = $countries[$contact['country']] ?? '-';
                                                    ($countryName == 'Mexico')? $countryName = 'México': $countryName;
                                                @endphp
                                                <span>{{$countryName}}</span>
                                            </div>
                                        </div>
                                        <div class="pt-20 top-grid-4 d-flex flex-column align-items-center justify-content-center">
                                            <a href="{{route('front.contact.detail',$contact->slug)}}"><span>Conoce esta Creída</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <h6 style="display: none;" class="message-paginate">Mostrando 20 {{$users->total() == 1 ? 'candidato' : 'candidatos'}} de {{$users->total()}}</h6>
                        <div class="center-flex" style="margin-top:25px;">{{$users->onEachSide(1)->links()}}</div>
                    @else
                        <h4 class="mb-20 text-center">No hay candidados relacionados con tu búsqueda.</h4>
                        <div class="explore-btn" style="padding:0;">
                            <form action="{{route('front.home')}}" method="GET">
                                <input type="hidden" name="">
                                <button type="submit" class="btn-custom">Reiniciar busqueda</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
     $(function () {
        $(".multiselect").selectize();
    });

    $(document).ready(function() {
        $("#search").on("input", function() {
            if ($(this).val()) {
                $(".typed").hide();
            } else {
                $(".typed").show();
            }
        });

        $('.typed').on('click', function() {
            $('.typed').hide();
            $("#search").focus();
            $('#search').val('');
        });

        $("#search").blur(function() {
            $(".typed").show();
        });

        //Typed.js
        var typed = new Typed('#typed', {
            strings: ['Nombre', 'Apellidos'],
            typeSpeed: 50,
            backSpeed: 50,
            loop: true
        });

        //Change order
        $('#change-order').change(function() {
            var order = $(this).val();
            window.location.href = '{{route('front.home')}}?order=' + order  + '#feature-job-grid';
        });

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 150) {
                $('.logo').css('opacity', '1');
            } else {
                $('.logo').css('opacity', '0');
            }
        });
    });
</script>
@endpush
