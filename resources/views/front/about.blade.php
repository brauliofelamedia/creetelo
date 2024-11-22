@extends('layouts.main')
@section('content')
    <div class="about-us-banner pb-60 mb-160 md-mb-100">
        <div class="about-three-rapper position-relative">
            <img src="images/shape/shape-2.png" alt="" class="shape shape-12">
            <img src="images/shape/shape-3.png" alt="" class="shape shape-13">
            <div class="container">	
                <div class="row d-flex align-items-center justify-content-center flex-column text-center">
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-100">
                        <h1 class="mb-30">Obtenga solicitudes de los mejores talentos del mundo.</h1>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <section class="dream-job2 mb-160 md-mb-80">
        <div class="container">
            <div class="text-center dream-heading">
                <span class="span-two">How It Works</span>
                <h3 class="heading-text3 mt-20 mb-60">Easy Step To Get Your <span class="span-color">Dream Job</span></h3>
            </div>
            <div class="dremjob-content">
                <div class="row d-flex align-items-center justify-content-between g-5">
                    <div class="col-lg-4">
                        <div class="dreamitem-1">
                            <div class="dream-icon mb-30">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <a href=""><span>Create Your Account</span></a>
                        </div>
                    </div>
                    <div class="col-lg-4 ms-auto">
                        <div class="dreamitem-1">
                            <div class="dream-icon mb-30">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <a href=""><span>Search Your  Job</span></a>
                        </div>
                    </div>
                    <div class="col-lg-4 ms-auto">
                        <div class="dreamitem-1">
                            <div class="dream-icon mb-30">
                                <i class="bi bi-file-text"></i>
                            </div>	
                            <a href=""><span>Apply For  Job</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us mb-160 md-mb-80 pt-20 pb-20" style="background-color: #88b9d7;">
        <div class="container">
            <div class="about-us-rapper position-relative">
                <img src="images/shape/shape-5.png" alt="" class="shape shape-5">
                <img src="images/shape/shape-6.png" alt="" class="shape shape-6">
                <img src="images/shape/shape-6.png" alt="" class="shape shape-7">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <div class="left-about left-about-us position-relative">
                            <img src="images/banner/banner-14.png" alt="" class="">
                            <img src="{{asset('images/michelle.webp')}}" alt="" class="">
                            <img src="images/screen/screen-9.png" alt="" class="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-5 offset-lg-1 offset-xl-1 md-mt-80">
                        <div class="right-about-two">
                            <img src="{{asset('images/logo.png')}}" alt="{{env('APP_NAME')}}" style="margin-block: 30px;">
                            <p>Créetelo es una comunidad que empodera a emprendedoras auténticas que quieren aportar a la vida de otros desde su propósito y sus conocimientos, ser reconocidas por su valor, hacer buen dinero de su pasión y conectar con otras mujeres exitosas.</p>
                            <p>No es para personas que creen que se merecen el mundo sin hacer el mínimo esfuerzo, es para gente buena vibra, talentosa, profunda, auténtica, de mente abierta, potencial infinito y dispuestas a darlo TODO para comerse el mundo.</p>
                            <p>A través de sesiones de mentoría, programas como “Vender(te) Sin Miedo”, clases y retos mensuales, Michelle usa su autenticidad, su valentía y su transparencia, con un tono positivo y real, para que más mujeres vean su valor y se atrevan a EMPRENDER con CONFIANZA.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="staticties mb-160 md-mb-80">
        <div class="container">
            <div class="row d-flex align-items-center pt-80 pb-80">
                <div class="col-lg-3">
                    <div class="statistics-1 d-flex align-items-center flex-column">
                        <div class="top"><span class="counter">12.6</span>K</div>
                        <div class="bottom"><span class="">Project Done</span></div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="statistics-1 d-flex align-items-center flex-column">
                        <div class="top"><span class="counter">25</span>+</div>
                        <div class="bottom"><span class="">Years Experience</span></div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="statistics-1 d-flex align-items-center flex-column">
                        <div class="top"><span class="counter">14.6</span>K</div>
                        <div class="bottom"><span class="">World Wide Clients</span></div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="statistics-1 d-flex align-items-center flex-column">
                        <div class="top"><span class="counter">4.7</span>K+</div>
                        <div class="bottom"><span class="">Customer Reviews</span></div>
                    </div>
                </div>					
            </div>
        </div>
    </div>

    <section class="why-choose-us why-choose-us-three pb-160 md-pb-80">
        <div class="why-choose-us-rapper">
            <div class="container">
                <div class="choose-us-content position-relative mt-80">
                    <img src="images/shape/shape-6.png" alt="" class="shape shape-5">
                    <img src="images/shape/shape-6.png" alt="" class="shape shape-6">
                    <img src="images/shape/shape-6.png" alt="" class="shape shape-7">
                    <div class="row g-5 align-items-center">
                        <div class="col-xl-5 left-choose-content ">
                            <div class="choose-us-heading md-pb-80">
                                <span class="span-two">Why Choose Us</span>
                                <h2 class="text-justify mt-20 mb-30"><span>Khuj.</span> Website Only For Your Dream Jobs</h2>
                                <div class="">
                                    <button class="item1" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">01. Payment Gateway Secure</button>
                                    <div class="collapse" id="collapse1">
                                        Energistically iterate effective data whereas is to highly efficient e-business. Conveniently and productivate.
                                    </div>
                                    <button class="item1" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">02. Quick Delivery & Fast Load</button>
                                    <div class="collapse" id="collapse2">
                                        Energistically iterate effective data whereas is to highly efficient e-business. Conveniently and productivate.
                                    </div>
                                    <button class="item1" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">03. Work Per Hour & Screenshots</button>
                                    <div class="collapse" id="collapse3">
                                        Energistically iterate effective data whereas is to highly efficient e-business. Conveniently and productivate.
                                    </div>
                                </div>
                                <a href="" class="custom-btn custom-2-btn">Learn More</a>
                            </div>
                        </div>
                        <div class="col-xl-7 right-choose-content-three">
                            <img src="images/banner/banner-16.jpg" alt="" class="ms-auto">
                            <img src="images/banner/banner-15.jpg" alt="" class="ms-auto">
                            <img src="images/screen/screen-24.png" alt="" class="ms-auto">
                            <img src="images/screen/screen-4.png" alt="" class="ms-auto">
                            <img src="images/screen/screen-5.png" alt="" class="ms-auto">
                            <img src="images/screen/screen-10.png" alt="" class="ms-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="watch_Our_video mt-160 md-mt-80">
        <div class="container">
            <div class="row">
                <div class="our_video_rapper">
                    <div class="video-top d-flex align-items-start justify-content-evenly flex-column">
                        <span>Watch Our Video</span>
                        <h5 class="mt-20">Find your dream job</h5>
                    </div>
                    <div class="video-icon d-flex align-items-center justify-content-center">
                        <a class="watch-video" href="https://www.youtube.com/watch?v=BJ2BG1Af8cc"><i class="bi bi-play-circle"></i></a>
                    </div>
                    <img src="images/bg/bg-4.png" alt="" class="">
                </div>
            </div>
        </div>
    </section>

    <section class="our_team mt-160 md-mt-80 pb-80">
        <div class="container">
            <div class="team-heading text-justify pt-80 mb-80">
                <span class="span-two">Team Management</span>
                <h3 class="mt-20 mb-20">Our Creative Team</h3>
            </div>
            <div class="our_team_slider" id="our_team_slider">
                <div class="our_team_item">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/team/team-9.jpg" alt="">
                                <div class="social_group">
                                    <ul>
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5>Courtney Henry</h5>
                                    <span>Sr. UX/UI Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="our_team_item">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/team/team-8.jpg" alt="">
                                <div class="social_group">
                                    <ul>
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5>Devon Lane</h5>
                                    <span>Sr. UX/UI Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="our_team_item">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/team/team-7.jpg" alt="">
                                <div class="social_group">
                                    <ul>
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5>Jenny Wilson</h5>
                                    <span>Sr. UX/UI Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="our_team_item">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <img src="images/team/team-9.jpg" alt="">
                                <div class="social_group">
                                    <ul>
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5>Courtney Henry</h5>
                                    <span>Sr. UX/UI Designer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial mt-160 mb-160 md-mt-80 md-mb-80">
        <div class="container-fluid">
            <div class=" testimonial-rapper-three">
                <div class="heding-center text-center">
                    <span class="span-two">Testimonial</span>
                    <h2 class="heading-2 mt-20 ">What Client Say About Us</h2>
                </div>
                <div class="testimonial-content-Three pt-80">
                    <div class="container">
                        <div class="testimonial-slider-Three" id="testimonial_slider-three">
                            <div class="testimonial_item">
                                <div class="row">
                                    <div class="col">
                                        <div class="item-rapper d-flex flex-column align-items-start justify-content-center">
                                            <div class="item1 mb-30"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                            <div class="item2 mb-30"><p>Progressively transform high-quality web services via magnetic synergy.Profession e-enable functional users without.</p></div>
                                            <div class="item3 d-flex align-items-center">
                                                <div class="left-side">
                                                    <img src="images/team/team-4.jpg" alt="">
                                                </div>
                                                <div class="right-side d-flex flex-column align-items-start">
                                                    <h5 class="mb-20">Rashed Kabir</h5>
                                                    <span>Sr. UX/UI Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial_item">
                                <div class="row">
                                    <div class="col">
                                        <div class="item-rapper d-flex flex-column align-items-start justify-content-center">
                                            <div class="item1 mb-30"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                            <div class="item2 mb-30"><p>Progressively transform high-quality web services via magnetic synergy.Profession e-enable functional users without.</p></div>
                                            <div class="item3 d-flex align-items-center">
                                                <div class="left-side">
                                                    <img src="images/team/team-5.jpg" alt="">
                                                </div>
                                                <div class="right-side d-flex flex-column align-items-start">
                                                    <h5 class="mb-20">Rashed Kabir</h5>
                                                    <span>Sr. UX/UI Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial_item">
                                <div class="row">
                                    <div class="col">
                                        <div class="item-rapper d-flex flex-column align-items-start justify-content-center">
                                            <div class="item1 mb-30"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                            <div class="item2 mb-30"><p>Progressively transform high-quality web services via magnetic synergy.Profession e-enable functional users without.</p></div>
                                            <div class="item3 d-flex align-items-center">
                                                <div class="left-side">
                                                    <img src="images/team/team-6.jpg" alt="">
                                                </div>
                                                <div class="right-side d-flex flex-column align-items-start">
                                                    <h5 class="mb-20">Rashed Kabir</h5>
                                                    <span>Sr. UX/UI Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial_item">
                                <div class="row">
                                    <div class="col">
                                        <div class="item-rapper d-flex flex-column align-items-start justify-content-center">
                                            <div class="item1 mb-30"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                                            <div class="item2 mb-30"><p>Progressively transform high-quality web services via magnetic synergy.Profession e-enable functional users without.</p></div>
                                            <div class="item3 d-flex align-items-center">
                                                <div class="left-side">
                                                    <img src="images/team/team-4.jpg" alt="">
                                                </div>
                                                <div class="right-side d-flex flex-column align-items-start">
                                                    <h5 class="mb-20">Rashed Kabir</h5>
                                                    <span>Sr. UX/UI Designer</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="Customer-one mb-160 md-mb-80">
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

@push('js')
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
@endpush