@extends('layouts.main')
@section('content')    
    <div class="about-us-banner pt-120" style="background-image: url('{{asset('images/home.webp')}}')">
        <div class="about-three-rapper position-relative">
            <img src="images/shape/shape-2.png" alt="" class="shape shape-12">
            <img src="images/shape/shape-3.png" alt="" class="shape shape-13">
            <div class="container">	
                <div class="row d-flex align-items-center justify-content-center flex-column text-center">
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-100">
                        <h1 class="mb-30">Créetelo es una comunidad que empodera a emprendedoras auténticas que quieren aportar a la vida de otros desde su propósito y sus conocimientos.</h1>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-60">
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
                <div class="row px-0 d-flex align-items-center">
                    @if(count($data['contacts']) >= 1)
                        <div class="row job-grid-heading">
                            <div class="col-lg-8 md-pb-20" data-aos="zoom-in">
                                <div class="left-grid">
                                    <span class="">Mostrando {{count($data['contacts'])}} de {{number_format($data['meta']['total'])}} candidatos</span>
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

                            <div class="col-lg-4">
                                <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="{{Gravatar::get($contact['email'])}}" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                <h3>{{(($contact['contactName'])? $contact['contactName'] :'-')}}</h3>
                                                <span>{{(($contact['email'])? $contact['email'] :'-')}}</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-2 mt-20 d-flex align-items-center justify-content-center">
                                            <div class="mb-20 text-center">
                                                <span><i class="bi bi-geo-alt"></i></span>
                                                <span>{{$contact['country']}}</span>
                                            </div>
                                            <div class="mb-20">
                                                <span><i class="bi bi-email-inbound"></i></span>
                                                <span>{{$contact['phone']}}</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                            <a href="{{route('front.contact.detail',$contact['id'])}}"><span>Ver perfil completo</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination d-flex align-items-center justify-content-center">
                            <button class="btn">Anterior</button>
                            <button class="btn">Siguiente</button>
                        </div>

                    @else
                        <h4 class="text-center mb-20">No hay candidados relacionados con tu búsqueda.</h4>
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
                    <div class=" col customer_content text-center pt-80 pb-80">
                        <h2 class="">200k+ Customers Regular Visit Our Site.Try it now!</h2>
                        <p class="mb-30">Enthusiastically mesh user friendly content with long-term high-impact architectures. Proactively underwhelm .</p>
                        <a href="" class="custom-btn">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection