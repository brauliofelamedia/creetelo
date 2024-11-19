@extends('layouts.main')
@section('content')    
    <div class="about-us-banner mb-160 md-mb-100">
        <div class="about-three-rapper position-relative">
            <img src="images/shape/shape-2.png" alt="" class="shape shape-12">
            <img src="images/shape/shape-3.png" alt="" class="shape shape-13">
            <div class="container">	
                <div class="row d-flex align-items-center justify-content-center flex-column text-center">
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-100">
                        <h1 class="mb-30">Obtenga solicitudes de los mejores talentos del mundo.</h1>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-60">
                        <form class="form-3 d-flex align-items-center justify-content-between">
                            <div class="item_1"><img src="images/icon/search.svg" alt=""></div>
                            <div class="placeholder">
                                <input type="text" id="username" placeholder="Job title" required>
                            </div>
                            <div class="location d-flex">
                                <img src="images/icon/map.svg" alt="">
                                <select class="nice-select">
                                    <option value="0" data-display="Location..">Ubicaciones..</option>
                                    <option value="1">Bangladesh</option>
                                    <option value="2">India</option>
                                    <option value="3">America</option>
                                    <option value="4">Canada</option>
                                </select>
                                </div>
                            <div class="button"><a href="custom-btn" class=""><span>Search Now</span></a></div>	
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
    <section class="feature-job-grid">
        <div class="feature-job-grid-rapper">
            <div class="container">
                <div class="row job-grid-heading">
                    <div class="col-lg-8 md-pb-20" data-aos="zoom-in">
                        <div class="left-grid">
                            <span class="">Mostrando {{count($contacts)}} candidatos</span>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="zoom-in">
                        <div class="right-grid d-flex align-items-center">
                            <span>Filtrar por</span>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Categorías</option>
                                <option value="1">Design</option>
                                <option value="2">Marketing</option>
                                <option value="3">web Design</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row px-0 d-flex align-items-center justify-content-center">
                    @foreach($contacts as $contact)
                        <div class="col-lg-4">
                            <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                <div class="round-pic"><img src="images/team/team-10.png" alt=""></div>
                                <div class="Candidates-grid">
                                    <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                        <div class=" d-flex flex-column align-items-center justify-content-center ">
                                            <h3 class="mb-20">{{(($contact['firstName'])? $contact['firstName'] :'-')}}</h3>
                                            <span>Sr. UX/UI Designer</span>
                                        </div>
                                        <div class="mt-20 mb-20 ">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <strong>4.7</strong>
                                        </div>
                                    </div>
                                    <div class="top-grid-2 d-flex align-items-center justify-content-between">
                                        <div class="mb-20">
                                            <span><i class="bi bi-geo-alt"></i></span>
                                            <span>{{$contact['country']}}</span>
                                        </div>
                                        <div class="mb-20">
                                            <span><i class="bi bi-calendar2-week"></i></span>
                                            <span>2 Years Experi..</span>
                                        </div>
                                    </div>
                                    <div class="top-grid-3 d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <span><i class="bi bi-email-inbound"></i></span>
                                            <span>{{$contact['phone']}}</span>
                                        </div>
                                        <div class="">
                                            <span><i class="bi bi-clock"></i></span>
                                            <span>{{(($contact['email'])? $contact['email'] :'-')}}</span>
                                        </div>
                                    </div>
                                    <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                        <a href="{{route('front.contact.detail',$contact['id'])}}"><span>Ver perfil completo</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="explore-btn"><a href="" class="btn-custom">Más candidatos</a></div>
            </div>
        </div>
    </section>
    <!-- =========================================
    .FEATURED JOBS
    ============================================= -->
    <!-- =========================================
    Customers 10
    ============================================= -->
    <section class="Customer-one mb-160 mt-160 md-mb-80 md-mt-80">
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
    <!-- =========================================
    Customers
    ============================================= -->
@endsection