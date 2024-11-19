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
                                    <option value="0" data-display="Location..">Location..</option>
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
    <!--================================
    banner section end
    ===========================  -->
    <!-- =========================================
    .job-details
    ============================================= -->
    <section class="job-details mb-160 md-mb-80">
        <div class="job-details-rapper">
            <div class="container">
                <div class="row px-0 gx-5">
                    <div class="col-lg-4">
                    <div class="candidates-details-left d-flex flex-column justify-content-center pt-60 mb-60">
                            <div class="save-candidate d-flex align-items-start justify-content-start">
                                <img src="images/team/team-24.png" alt="">
                                <span>Disponible</span>
                                <span><i class="bi bi-bookmark-dash"></i></span>
                            </div>
                            <div class="Profile-name pt-30 d-flex flex-column">
                                <h4 class="mt-20 mb-20">{{$contact['firstName']}} {{@$contact['lastName']}}</h4>
                                <small>Sr. UX/UI Designer</small>
                                <div class="social-link">
                                    <ul>
                                        <li><a href=""><i class="fab fa-behance"></i></a></li>
                                        <li><a href=""><i class="bi bi-linkedin"></i></a></li>
                                        <li><a href=""><i class="fab fa-dribbble"></i></a></li>
                                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="bi bi-twitter"></i></a></li>
                                        <li><a href=""><i class="bi bi-instagram"></i></a></li>
                                        <li><a href=""><i class="bi bi-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Correo electrónico</p>
                                <span>{{(@$contact['email'])? $contact['email']:'-'}}</span>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Teléfono</p>
                                <span>{{$contact['phone']}}</span>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Ubicación</p>
                                <span>{{@$contact['city']}} {{@$contact['state']}} {{@$contact['country']}}</span>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Creación de la cuenta</p>
                                <span>{{(@$contact['dateAdded'])? \Carbon\Carbon::parse($contact['dateAdded'])->format('d-m-Y'):'-'}}</span>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Última conexión</p>
                                <span>{{(@$contact['lastActivity'])? \Carbon\Carbon::parse($contact['lastActivity'])->format('d-m-Y'):'-'}}</span>
                            </div>
                    </div>	
                    </div>
                    <div class="col-lg-8">
                        <div class="candidates-details-right">
                            <div class="candidate-list-1 mb-40 d-flex align-items-center justify-content-between">
                                <div class="Candidate-pic">
                                    <img src="images/team/team-25.png" alt="">
                                </div>
                                <div class="Candidate-name d-flex align-items-start justify-content-center flex-column">
                                    <h4 class="mb-20">{{$contact['firstName']}} {{@$contact['lastName']}}</h4>
                                    <span>Sr. UX/UI Designer</span>
                                    <div class="mb-20"></div>
                                    <span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><strong>(5.00)</strong></span>
                                </div>
                                <div class="candidate-place d-flex align-items-start justify-content-center flex-column">
                                    <div class="mb-20"><span><i class="bi bi-geo-alt"></i></span><span>{{@$contact['city']}} {{@$contact['state']}} {{@$contact['country']}}</span></div>
                                    <div class="mb-20"><span><i class="bi bi-calendar2-week"></i></span><span>2 Años de experiencia</span></div>
                                    <div class=""><span><i class="bi bi-clock"></i></span><span>$55 USD /hora</span></div>
                                </div>
                                <div class="Candidate-contact">
                                    <a href="" class="d-flex align-items-center justify-content-center"> <span>Contactame</span></a>
                                </div>
                            </div>
                            <div class="candidate-list-2">
                                <h4 class="mt-50 mb-30">Acerca de mi</h4>
                                <p>Dramatically envisioneer interactive leadership through functionalized ROI. Professionally simplify synergistic initiatives before effective channels. Dramatically create fully researched innovation without multifunctional partnerships.Collaboratively facilitate clicks-and-mortar strategic theme areas whereas parallel total linkage. Authoritatively engage long-term high-impact schemas after.</p>
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
                            <div class="candidate-list-3">
                                <h4 class="mt-50 mb-30">Experiencia</h4>
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="candidate-list-5">
                                <h4 class="mt-50 mb-30">Habilidades:</h4>
                                <p class="mb-30">Dramatically envisioneer interactive leadership through functionalized ROI. Professionally simplify synergistic initiatives before effective channels.</p>
                                <div class="btn-group d-inline">
                                    <a href="#" class="btn btn-primary">UI/UX Design</a>
                                    <a href="#" class="btn btn-primary">Graphic Design</a>
                                    <a href="#" class="btn btn-primary">Product Design</a>
                                    <a href="#" class="btn btn-primary">HTML</a>
                                </div>
                                <div class="btn-group d-inline">
                                    <a href="#" class="btn btn-primary">Development</a>
                                    <a href="#" class="btn btn-primary">Wordpress</a>
                                    <a href="#" class="btn btn-primary">Back-End</a>
                                    <a href="#" class="btn btn-primary">Front-End</a>
                                </div>
                            </div>
                            <div class="candidate-list-6">
                                <div class="d-flex align-items-center justify-content-between mt-60">
                                    <a href="" class="apply-btn d-flex align-items-center justify-content-center">Apply For The Job</a>
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
                    <h3 class="heading-3 mb-60 md-mb-90">Candidatos similares</h3>
                </div>
                <div class="recent-job-slider" id="recent-job-slider">
                    <div class="candidates-job-item">
                        <div class="row px-0 g-5">
                            <div class="col">
                                <div class="candidates-1 mt-40 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="images/team/team-10.png" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                <h3 class="mt-20 mb-20">Courtney Henry</h3>
                                                <span>Sr. UX/UI Designer</span>
                                            </div>
                                            <div class=" mt-20">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <strong>4.7</strong>
                                            </div>
                                        </div>
                                        <div class="top-grid-2 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-geo-alt"></i></span>
                                                <span>Dubai , UAE</span>
                                            </div>
                                            <div class="mt-20">
                                                <span><i class="bi bi-calendar2-week"></i></span>
                                                <span>2 Years Experi..</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-3 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-telephone-inbound"></i></span>
                                                <span>(704) 555-0127</span>
                                            </div>
                                            <div class=" mt-20">
                                                <span><i class="bi bi-clock"></i></span>
                                                <span>web@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                            <a href="" class=""><span>View Full Profile</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>		
                        </div>
                    </div>
                    <div class="candidates-job-item">
                        <div class="row px-0 g-5">
                            <div class="col">
                                <div class="candidates-1 mt-40 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="images/team/team-11.png" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                <h3 class="mt-20 mb-20">Courtney Henry</h3>
                                                <span>Sr. UX/UI Designer</span>
                                            </div>
                                            <div class=" mt-20">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <strong>4.7</strong>
                                            </div>
                                        </div>
                                        <div class="top-grid-2 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-geo-alt"></i></span>
                                                <span>Dubai , UAE</span>
                                            </div>
                                            <div class="mt-20">
                                                <span><i class="bi bi-calendar2-week"></i></span>
                                                <span>2 Years Experi..</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-3 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-telephone-inbound"></i></span>
                                                <span>(704) 555-0127</span>
                                            </div>
                                            <div class=" mt-20">
                                                <span><i class="bi bi-clock"></i></span>
                                                <span>web@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                            <a href="" class=""><span>View Full Profile</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>			
                        </div>
                    </div>
                    <div class="candidates-job-item">
                        <div class="row px-0 g-5">	
                            <div class="col">
                                <div class="candidates-1 mt-40 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="images/team/team-12.png" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                <h3 class="mt-20 mb-20">Courtney Henry</h3>
                                                <span>Sr. UX/UI Designer</span>
                                            </div>
                                            <div class=" mt-20">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <strong>4.7</strong>
                                            </div>
                                        </div>
                                        <div class="top-grid-2 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-geo-alt"></i></span>
                                                <span>Dubai , UAE</span>
                                            </div>
                                            <div class="mt-20">
                                                <span><i class="bi bi-calendar2-week"></i></span>
                                                <span>2 Years Experi..</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-3 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-telephone-inbound"></i></span>
                                                <span>(704) 555-0127</span>
                                            </div>
                                            <div class=" mt-20">
                                                <span><i class="bi bi-clock"></i></span>
                                                <span>web@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                            <a href="" class=""><span>View Full Profile</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </div>
                    <div class="candidates-job-item">
                        <div class="row px-0 g-5">
                            <div class="col">
                                <div class="candidates-1 mt-40 d-flex flex-column align-items-center justify-content-center">
                                    <div class="round-pic"><img src="images/team/team-13.png" alt=""></div>
                                    <div class="Candidates-grid">
                                        <div class=" mt-20 top-grid-1 d-flex flex-column align-items-center justify-content-center">
                                            <div class=" d-flex flex-column align-items-center justify-content-center ">
                                                <h3 class="mt-20 mb-20">Courtney Henry</h3>
                                                <span>Sr. UX/UI Designer</span>
                                            </div>
                                            <div class=" mt-20">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <strong>4.7</strong>
                                            </div>
                                        </div>
                                        <div class="top-grid-2 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-geo-alt"></i></span>
                                                <span>Dubai , UAE</span>
                                            </div>
                                            <div class="mt-20">
                                                <span><i class="bi bi-calendar2-week"></i></span>
                                                <span>2 Years Experi..</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-3 d-flex align-items-center justify-content-between">
                                            <div class="mt-20">
                                                <span><i class="bi bi-telephone-inbound"></i></span>
                                                <span>(704) 555-0127</span>
                                            </div>
                                            <div class=" mt-20">
                                                <span><i class="bi bi-clock"></i></span>
                                                <span>web@mail.com</span>
                                            </div>
                                        </div>
                                        <div class="top-grid-4 pt-20 d-flex flex-column align-items-center justify-content-center">
                                            <a href="" class=""><span>View Full Profile</span></a>
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