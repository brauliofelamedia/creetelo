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

    ul {
        margin:0 auto;
        text-align: center;
    }

    .page-link,.page-link:hover {
        margin-top: 30px;
        padding: 5px 10px;
        background-color: #474588;
        color: white;
        border-radius: 5px;
    }

    @media (max-width: 992px) {
        .about-three-rapper h1 {
            font-size: 25px;
            line-height: 1.2em;
        }

        #feature-job-grid {
            padding: 40px;
        }
    }

    @media (max-width: 768px) {
        .job-grid-heading .right-grid span {
            font-size: 17px;
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

        .job-grid-heading .aos-init:nth-child(1) {
            display: none;
        }
        .about-us-banner {
            position: relative;
            padding: 30px;
            padding-top: 80px;
            background-position: right;
        }

        .about-us-banner::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(255,255,255,0.1), rgba(255,255,255,0.6));
        }

        .about-three-rapper h1 {
            font-size: 19px;
            line-height: 1.2em;
            color: white;
            text-shadow: 0 0 13px rgba(1, 1, 1, 0.4);
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
            <img src="{{asset('images/shape/shape-2.png')}}" alt="#" class="shape shape-12">
            <img src="{{asset('images/shape/shape-3.png')}}" alt="#" class="shape shape-13">
            <div class="container">
                <div class="text-center row d-flex align-items-center justify-content-center flex-column">
                    <img src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" class="logo-directorio">
                    <div class="mt-20 d-flex align-items-center justify-content-center md-mt-50">
                        <h1 class="mb-50 mt-50">Créetelo es una comunidad que empodera a emprendedoras auténticas que quieren aportar a la vida de otros desde su propósito y sus conocimientos.</h1>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <form class="form-3 d-flex align-items-center justify-content-between" action="{{route('front.home')}}" method="get">
                            <input type="text" name="search" id="searchInput" placeholder="Busca por nombre, apellidos o habilidades..."  value="{{@$search}}">
                            <button type="submit" class="btn-search">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="feature-job-grid pb-90 pt-90" id="feature-job-grid">
        <div class="feature-job-grid-rapper">
            <div class="container">
                <div class="px-0 row d-flex align-items-center">
                    @if(count($users) >= 1)
                        <div class="row job-grid-heading">
                            <div class="mt-10 col-lg-6 col-md-5 md-pb-10" data-aos="zoom-in">
                                <div class="left-grid">
                                    <span class="">Mostrando {{$users->total()}} {{$users->total() == 1 ? 'candidato' : 'candidatos'}}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7" data-aos="zoom-in">
                                <form action="{{route('front.home')}}" method="GET">
                                    <div class="right-grid d-flex align-items-center">
                                        <span>Ordenar por:</span>
                                        <select class="form-select" name="order" id="change-order" class="form-control" style="border: 2px solid #111D3B;">
                                            <option value="desc" {{ $order === 'desc' ? 'selected' : '' }}>Más recientes</option>
                                            <option value="asc" {{ $order === 'asc' ? 'selected' : '' }}>Más antiguos</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @foreach($users as $contact)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12">
                                <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic">
                                        <img src="{{$contact->avatar}}" alt="#">
                                        <span class="country">{{ flag($contact->country, 'w-32') }}</span>
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

                        <div class="center-flex">{{$users->links()}}</div>

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

    <section class="Customer-one">
        <div class="container">
            <div class="customer_rapper">
                <img src="images/shape/shape-4.png" alt="">
                <img src="images/shape/shape-4.png" alt="">
                <div class="row">
                    <div class="text-center col customer_content pt-80 pb-80">
                        <h2 class="">200k+ Customers Regular Visit Our Site.Try it now!</h2>
                        <p class="mb-30">Enthusiastically mesh user friendly content with long-term high-impact architectures. Proactively underwhelm .</p>
                        <a href="" class="custom-btn">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        //Change order
        $('#change-order').change(function() {
            var order = $(this).val();
            window.location.href = '{{route('front.home')}}?order=' + order  + '#feature-job-grid';
        });

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $('.logo').css('opacity', '1');
            } else {
                $('.logo').css('opacity', '0');
            }
        });
    });
</script>
@endpush
