@extends('layouts.main')
@section('content')

    <section class="job-details mb-160 md-mb-80 pt-200">
        <div class="job-details-rapper">
            <div class="container">
                <div class="row px-0 gx-5">
                    <div class="col-lg-4">
                        <div class="candidates-details-left d-flex flex-column justify-content-center pt-60 mb-20">
                            <div class="save-candidate d-flex align-items-start justify-content-start">
                                <img src="{{Gravatar::get($contact['email'])}}" alt="">
                                <span style="background: green;color:white;border-color:white;">Disponible</span>
                            </div>
                            <div class="Profile-name pt-30 d-flex flex-column">
                                <h4 class="mt-20 mb-20">{{@$contact['firstName']}} {{@$contact['lastName']}}</h4>
                                <span>Sr. UX/UI Designer</span>
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
                                <p class="mb-20">Teléfono</p>
                                <span>{{$contact['phone']}}</span>
                            </div>
                            <div class="left-1 pt-40">
                                <p class="mb-20">Ubicación</p>
                                <span>{{@$contact['city']}} {{@$contact['state']}} {{@$contact['country']}}</span>
                            </div>
                        </div>
                        <div class="candidates-details-left d-flex flex-column justify-content-center pt-60" style="background-color: rgb(41 39 117);color:white;">
                            <form action="{{route('front.send_email')}}" method="POST">
                                @csrf
                                <h5>Envia un mensaje</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Correo:</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Servicios de interes:</label>
                                    <select name="services" class="form-control">
                                        <option value="#">UI/UX Design</option>
                                        <option value="#">Graphic Design</option>
                                        <option value="#">Development</option>
                                        <option value="#">Front-End</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Comentarios:</label>
                                    <textarea name="comments" class="form-control" rows="3"></textarea>
                                </div>
                            </form>
                        </div>	
                    </div>
                    <div class="col-lg-8">
                        <div class="candidates-details-right">
                            <div class="candidate-list-1 mb-40 d-flex align-items-center justify-content-between" style="display: none!important;">
                                <div class="Candidate-pic">
                                    <img src="images/team/team-25.png" alt="">
                                </div>
                                <div class="Candidate-name d-flex align-items-start justify-content-center flex-column">
                                    <h4 class="mb-20">{{@$contact['firstName']}} {{@$contact['lastName']}}</h4>
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
                            <div class="candidate-list-5">
                                <h4 class="mt-50 mb-30">Servicios que ofrece:</h4>
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
                    @foreach($otherContacts as $contact)
                        <div class="candidates-job-item">
                            <div class="row px-0 g-5">
                                <div class="col">
                                    <div class="candidates-1 d-flex flex-column align-items-center justify-content-center">
                                        <div class="round-pic"><img src="{{asset('images/team/team-10.png')}}" alt=""></div>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection