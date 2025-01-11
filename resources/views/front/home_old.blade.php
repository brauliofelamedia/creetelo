@extends('layouts.main')

@push('css')
<style>
    li {
        list-style-type: none;
        display: inline;
    }

    .logo {
        display: none;
    }

    ul {
        margin:0 auto;
        text-align: center;
    }

    .btn-pagination,.btn-pagination:hover {
        margin-top: 30px;
        padding: 5px 10px;
        background-color: #474588;
        color: white;
        border-radius: 5px;
    }

    .btn-pagination.active,.btn-pagination:hover {
        background-color: #d17d24;
    }
</style>
@endpush

@section('content')
    <div class="about-us-banner pt-120" style="background-image: url('{{asset('images/banner.png')}}')">
        <div class="about-three-rapper position-relative">
            <img src="{{asset('images/shape/shape-2.png')}}" alt="#" class="shape shape-12">
            <img src="{{asset('images/shape/shape-3.png')}}" alt="#" class="shape shape-13">
            <div class="container">
                <div class="text-center row d-flex align-items-center justify-content-center flex-column">
                    <img src="{{asset('images/Directorio-Logo.png')}}" alt="{{env('APP_NAME')}}" style="width:50%;">
                    <div class="mt-20 d-flex align-items-center justify-content-center md-mt-50">
                        <h1 class="mb-130 mt-100">Créetelo es una comunidad que empodera a emprendedoras auténticas que quieren aportar a la vida de otros desde su propósito y sus conocimientos.</h1>
                    </div>
                    <div class="mt-20 d-flex align-items-center justify-content-center">
                        <form class="form-3 d-flex align-items-center justify-content-between" action="{{route('front.home')}}" method="get">
                            <input type="text" name="name" id="searchInput" placeholder="Michelle Poler"  value="{{@$name}}">
                            <button type="submit" class="btn-search">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="feature-job-grid pb-90 pt-90">
        <div class="feature-job-grid-rapper">
            <div class="container">
                <div class="px-0 row d-flex align-items-center">
                    @if(count($data['contacts']) >= 1)
                        <div class="row job-grid-heading">
                            <div class="col-lg-8 md-pb-20" data-aos="zoom-in">
                                <div class="left-grid">
                                    <span class="">Mostrando {{count($data['contacts'])}} de {{$data['total']}} candidatos</span>
                                </div>
                            </div>
                            <div class="col-lg-4" data-aos="zoom-in">
                                <div class="right-grid d-flex align-items-center">
                                    <span>Filtrar por</span>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Habilidades</option>
                                        <option value="1">Design</option>
                                        <option value="2">Marketing</option>
                                        <option value="3">web Design</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach($data['contacts'] as $contact)
                            <div class="col-lg-3">
                                <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="{{$contact['avatar']}}" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class="mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center">
                                                <h3>{{(($contact['firstNameLowerCase'])? $contact['firstNameLowerCase'] :'-')}} {{(($contact['lastNameLowerCase'])? $contact['lastNameLowerCase'] :'-')}}</h3>
                                                @php
                                                    $countries = Config::get('countries.countries');
                                                    $countryName = $countries[$contact['country']] ?? '-';
                                                    ($countryName == 'Mexico')? $countryName = 'México': $countryName;
                                                @endphp
                                                <span>{{$countryName}}</span>
                                                @if(count($contact['socials']) > 0)
                                                    <ul class="social-link-front">
                                                        @foreach ($contact['socials'] as $url => $title)
                                                        <li>
                                                            <a href="{{ $url }}" target="_blank"><i class="bi bi-{{$title}}"></i></a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="pt-20 top-grid-4 d-flex flex-column align-items-center justify-content-center">
                                            <a href="{{route('front.contact.detail',$contact['id'])}}"><span>Conoce esta Creída</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @php
                            $total = $data['total'];
                            $pages = intval(ceil($total / 20));
                        @endphp

                        <ul>
                            @for ($i = 0; $i < $pages; $i++)
                                <li><a href="{{route('front.home')}}/?page={{$i+1}}" class="btn-pagination  {{($page == $i+1)? 'active':''}}">{{$i+1}}</a></li>
                            @endfor
                        </ul>

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
