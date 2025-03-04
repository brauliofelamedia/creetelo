@extends('layouts.main')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 58px !important;
        padding: 14px 20px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 56px !important;
        right: 10px !important;
    }

    .select2-dropdown {
        border: 1px solid #ced4da !important;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 10px !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #292775 !important;
    }

    .select2-results__option {
        padding: 10px 20px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }

    .heading-2 {
        font-size: 35px!important;
    }
    .blue {
        padding: 20px;
        background-color: #f3bfa5;
        border-radius: 10px;
    }

    .required {
        color: red;
    }

    button[disabled], button[disabled]:hover {
        opacity: 1!important;
    }

    #sendData {
        position: fixed;
        bottom: 0;
        width: 310px;
        right: 298px;
        z-index: 10000;
        border-radius: 10px 10px 0 0;
    }

    .btn-add {
        background-color: #292775;
        padding: 10px 18px;
        border-radius: 7px;
        color: white !important;
        font-size: 14px !important;
        cursor: pointer;
    }

    .delete-row, .delete-save {
        position: absolute;
        right: 14px;
        padding: 1px 6px;
        font-size: 12px;
        top: 10px;
    }

    #formSocial {
        padding: 30px;
        background-color: #ececec;
        border-radius: 10px;
        margin-top: 20px;
    }

    #btnSocial {
        margin-top: 20px;
    }

    .btn-add:hover {
        background-color: #322f9b;
    }

    label {
        font-weight: 600 !important;
    }

    .form-group {
        margin-bottom: 13px;
    }

    .form-control:focus {
        box-shadow: none;
    }

    button[disabled],button[disabled]:hover {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
        opacity: 0.6;
    }

    h3 {
        margin: 10px 0px;
        color: #d17d24;
        font-weight: 600;
        font-size: 23px;
    }

    input, select,textarea {
        padding: 17px!important;
        font-size: 15px!important;
        font-weight: 400!important;
    }

    .avatar {
        background-color: white;
        width:180px;
        height: 180px;
        position: absolute;
        border-radius: 15px;
        top:-150px;
        left: 300px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow:0 0 10px rgba(1,1,1,0.5);
    }

    .btn-succcess {
        background-color: #292775;
        font-weight: 700;
        color: white;
        padding:20px;
        font-size: 15px;
        text-transform: uppercase;
        border-radius: 6px;
        width: 100%;
    }

    .btn-succcess:hover {
        background-color: #1c1a6a;
    }

    h1 {
        color: #292775!important;
    }

    @media (max-width: 992px) {
        .avatar {
            width: 170px;
            height: 170px;
            top: -140px;
            left: 44px;
        }
        .contact-form {
            padding: 40px;
            padding-top: 60px !important;
        }
    }

    @media (max-width: 768px) {
        .avatar {
            width: 110px;
            height: 110px;
            top: -70px;
            left: 38px;
        }

        .contact-form {
            padding:20px;
            padding-top: 60px!important;
        }
    }

    @media (max-width: 480px) {
        #sendData {
            right: 0;
            width: 100%;
            font-size: 12px;
            border-radius: 0;
            padding: 18px 0;
        }

        .avatar {
            width: 100px;
            height: 100px;
            top: -69px;
            left: 30px;
            border-radius: 10px;
        }

        .heading-2 {
            font-size: 23px !important;
            margin: 0;
        }

        .contact-form {
            padding:5px;
            padding-top: 40px!important;
        }
    }
</style>
@endpush

@section('content')
    <div class="about-us-banner" style="background-image: url('{{asset('images/banner-detail.png')}}')">
        <div class="about-three-rapper position-relative">
            <img src="{{asset('images/shape/shape-2.png')}}" alt="" class="shape shape-12">
            <img src="{{asset('images/shape/shape-3.png')}}" alt="" class="shape shape-13">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center flex-column">
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-120 pb-60 md-pb-80 ">
                        <h1 class="mb-10 my-account-title">Mi cuenta</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-form pt-60 pb-60" style="position:relative;">
        <div class="avatar" style="background-image:url('{{$user->avatar}}');"></div>
        <div class="container">
            <div class="text-left">
                <h2 class="heading-2 mb-30">Hola, {{$user->fullname}}</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Información personal</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Actualizar avatar:</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Nombre: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ucfirst($user->name)}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Apellidos: <span class="required">*</span></label>
                            <input type="text" class="form-control" name="last_name" value="{{ucfirst($user->last_name)}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Correo electrónico: <span class="required">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly required>
                            <div class="form-check" style="float: right;margin-top: 11px;">
                                <input class="form-check-input" type="checkbox" name="is_email" {{($user->is_email == 1)? 'checked' : false}} style="padding: 10px !important;" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;margin-left:8px;">Mostrar el correo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">WhatsApp:</label>
                            <input class="form-control" type="tel" name="whatsapp" value="{{$user->whatsapp}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">País:<span class="required">*</span></label>
                            <select class="form-control" name="country" id="country" required>
                                <option value="">Selecciona un país</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Estado:</label>
                            <select class="form-control" name="state" id="state" required>
                                <option value="">Selecciona un estado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Ciudad:<span class="required">*</span></label>
                            <select class="form-control" name="city" id="city" required>
                                <option value="">Selecciona una ciudad</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Instagram:</label>
                            <input class="form-control" type="url" name="instagram" value="{{$user->instagram}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Linkedin:</label>
                            <input class="form-control" type="url" name="instagram" value="{{$user->instagram}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Página Web:</label>
                            <input class="form-control" type="url" name="website" value="{{$user->website}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Sobre mí</h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="mb-10 form-label">Bio corta:<span class="required">*</span></label>
                            <textarea name="about_me" rows="5" required maxlength="1000" class="form-control">{{$user->about_me}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Soy increíble en (mis habilidades):<span class="required">*</span></label>
                            <select required name="abilities[]" class="selectSkills" multiple="multiple">
                                @isset($userSkills)
                                    @if(count($userSkills) > 0)
                                        @foreach($skills as $skill)
                                            <option value="{{$skill->id}}" @if(in_array($skill->id, $userSkills)) selected @endif>{{$skill->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($skills as $skill)
                                            <option value="{{$skill->id}}">{{$skill->name}}</option>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach($skills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Tus intereses/hobbies?:</label>
                            <select required name="interests[]" class="selectInterests" multiple="multiple">
                                @isset($userInterests)
                                    @if(count($userInterests) > 0)
                                        @foreach($interests as $interest)
                                            <option value="{{$interest->id}}" @if(in_array($interest->id, $userInterests)) selected @endif>{{$interest->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($interests as $interest)
                                            <option value="{{$interest->id}}">{{$interest->name}}</option>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach($interests as $interest)
                                        <option value="{{$interest->id}}">{{$interest->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Soy una Creída muy:</label>
                            <textarea class="form-control" name="how_vain">{{@$user->additional->how_vain}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Te atreves a contarnos tu sueño más grande? #manifiestababy:</label>
                            <textarea class="form-control" name="biggest_dream">{{@$user->additional->biggest_dream}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Qué te hace bien o te trae felicidad?</label>
                            <textarea class="form-control" name="brings_you_happiness">{{@$user->additional->brings_you_happiness}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Entré a Créetelo buscando:</label>
                            <textarea class="form-control" name="looking_for_in_creelo">{{@$user->additional->looking_for_in_creelo}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <h3>Sobre Mi Trabajo:</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Ocupación:<span class="required">*</span></label>
                                <input class="form-control" type="text" name="ocupation" value="{{$user->ocupation}}" required>
                            </div>
                        </div>  
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Mi emprendimiento/negocio/trabajo trata sobre: <span class="required">*</span></label>
                                <textarea class="form-control" name="business_about" required>{{@$user->additional->business_about}}</textarea>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Mi audiencia IDEAL es:</label>
                                <textarea class="form-control" name="ideal_audience">{{@$user->additional->ideal_audience}}</textarea>
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Mis valores más importantes son:</label>
                                <textarea class="form-control" name="values">{{@$user->additional->values}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Mi tono es:</label>
                                <textarea class="form-control" name="tone">{{@$user->additional->tone}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Mi misión es ayudar a que más personas:</label>
                                <textarea class="form-control" name="mission">{{@$user->additional->mission}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">Prefiero no trabajar con personas que:</label>
                                <textarea class="form-control" name="dont_work_with">{{@$user->additional->dont_work_with}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="mb-10 form-label">¿Algún LOGRO que nos quieras compartir importante para ti?:</label>
                                <textarea class="form-control" name="achievement">{{@$user->additional->achievement}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Trabajo en el corporativo, me dedico a:</label>
                            <textarea class="form-control" name="corporate_job">{{@$user->additional->corporate_job}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Conóceme Más:</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Dónde naciste y creciste?:</label>
                            <textarea class="form-control" name="birthplace">{{@$user->additional->birthplace}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Qué signo eres?:</label>
                            <select class="form-select" name="sign" aria-label="Selecciona tu signo zodiacal">
                                <option selected>Selecciona tu signo</option>
                                <option value="Aries" {{@$user->additional->sign == 'Aries'? 'selected':''}}>Aries</option>
                                <option value="Tauro" {{@$user->additional->sign == 'Tauro'? 'selected':''}}>Tauro</option>
                                <option value="Géminis" {{@$user->additional->sign == 'Géminis'? 'selected':''}}>Géminis</option>
                                <option value="Cáncer" {{@$user->additional->sign == 'Cáncer'? 'selected':''}}>Cáncer</option>
                                <option value="Leo" {{@$user->additional->sign == 'Leo'? 'selected':''}}>Leo</option>
                                <option value="Virgo" {{@$user->additional->sign == 'Virgo'? 'selected':''}}>Virgo</option>
                                <option value="Libra" {{@$user->additional->sign == 'Libra'? 'selected':''}}>Libra</option>
                                <option value="Escorpio" {{@$user->additional->sign == 'Escorpio'? 'selected':''}}>Escorpio</option>
                                <option value="Sagitario" {{@$user->additional->sign == 'Sagitario'? 'selected':''}}>Sagitario</option>
                                <option value="Capricornio" {{@$user->additional->sign == 'Capricornio'? 'selected':''}}>Capricornio</option>
                                <option value="Acuario" {{@$user->additional->sign == 'Acuario'? 'selected':''}}>Acuario</option>
                                <option value="Piscis" {{@$user->additional->sign == 'Piscis'? 'selected':''}}>Piscis</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Bebida favorita?:</label>
                            <textarea class="form-control" name="favorite_drink">{{@$user->additional->favorite_drink}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Tienes hijos?:</label>
                            <select name="has_children" class="form-control">
                                <option value="si" {{@$user->additional->has_children == 'si'? 'selected':''}}>Sí</option>
                                <option value="no" {{@$user->additional->has_children == 'no'? 'selected':''}}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Tu viaje favorito que has hecho?:</label>
                            <textarea class="form-control" name="favorite_trip">{{@$user->additional->favorite_trip}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿A dónde te gustaría viajar next?:</label>
                            <textarea class="form-control" name="next_trip">{{@$user->additional->next_trip}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Postre favorito?:</label>
                            <textarea class="form-control" name="favorite_dessert">{{@$user->additional->favorite_dessert}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Estás casada?:</label>
                            <select name="is_married" class="form-control">
                                <option value="si" {{@$user->additional->is_married == 'si'? 'selected':''}}>Sí</option>
                                <option value="no" {{@$user->additional->is_married == 'no'? 'selected':''}}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  class="mb-10 form-label">¿Comida favorita?:</label>
                            <textarea class="form-control" name="favorite_food">{{@$user->additional->favorite_food}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  class="mb-10 form-label">¿Qué serie o película recomiendas mucho?:</label>
                            <textarea class="form-control" name="movie_recommendation">{{@$user->additional->movie_recommendation}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  class="mb-10 form-label">¿Qué libro recomiendas? (Aparte de Hello Fears, obvi):</label>
                            <textarea class="form-control" name="book_recommendation">{{@$user->additional->book_recommendation}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label  class="mb-10 form-label">¿Qué PODCAST amas?:</label>
                            <textarea class="form-control" name="podcast_recommendation">{{@$user->additional->podcast_recommendation}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="blue">
                    <div class="row">
                        <div class="col-xl-12">
                            <h3>Te Regalo:</h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mb-10 form-label">¿Qué te gustaría regalar? (Una guía, una meditación, un producto, una mentoría, una sesión, una clase...):</label>
                                <textarea class="form-control" name="gift">{{@$user->additional->gift}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mb-10 form-label">Comparte un link:</label>
                                <input type="text" class="form-control" name="gift_link" value="{{@$user->additional->gift_link}}">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-succcess" id="sendData">Actualizar perfil</button>
            </form>
        </div>
    </section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Initialize Select2 with loading state
    $('#country, #state, #city').select2({
        placeholder: "Selecciona una opción",
        allowClear: true,
        width: '100%',
        language: {
            searching: function() {
                return "Buscando...";
            },
            noResults: function() {
                return "No se encontraron resultados";
            },
            loadingMore: function() {
                return "Cargando más resultados...";
            }
        }
    });

    // Disable state and city initially
    $('#state, #city').prop('disabled', true);

    async function loadInitialData() {
        try {
            // Show loading state
            $('#country').prop('disabled', true);
            
            const countryResponse = await $.ajax({
                url: '/api/countries',
                type: 'GET'
            });

            let countrySelect = $('#country');
            countrySelect.empty();
            countrySelect.append('<option value="">Selecciona un país</option>');
            
            let defaultCountryId = null;
            countryResponse.data.forEach(function(country) {
                // Assuming USA has ID 234 (verify this in your database)
                defaultCountryId = 236;
                let selected = country.id === parseInt("{{$user->country}}") ? 'selected' : '';
                countrySelect.append(`<option value="${country.id}" data-name="${country.name}" ${selected}>${country.name}</option>`);
            });

            // Enable country select
            $('#country').prop('disabled', false);

            // If user has a country, use that, otherwise use USA
            const countryId = "{{$user->country}}" || defaultCountryId;
            
            if(countryId) {
                countrySelect.val(countryId).trigger('change');
                await new Promise(resolve => setTimeout(resolve, 100)); // Small delay to ensure select2 is ready
                await loadStates(countryId);
            }
        } catch (error) {
            console.error('Error loading initial data:', error);
            $('#country').prop('disabled', false);
        }
    }

    async function loadStates(countryId) {
        try {
            // Disable and clear dependent selects
            $('#state, #city').prop('disabled', true).empty();
            $('#state').append('<option value="">Selecciona un estado</option>');
            $('#city').append('<option value="">Selecciona una ciudad</option>');

            const stateResponse = await $.ajax({
                url: `/api/states/${countryId}`,
                type: 'GET'
            });

            console.log(stateResponse);

            let stateSelect = $('#state');
            
            if (stateResponse && Array.isArray(stateResponse)) {
                stateResponse.forEach(function(state) {
                    let selected = state.id === parseInt("{{$user->state}}") ? 'selected' : '';
                    stateSelect.append(`<option value="${state.id}" ${selected}>${state.name}</option>`);
                });
            } else if (stateResponse && Array.isArray(stateResponse.data)) {
                stateResponse.data.forEach(function(state) {
                    let selected = state.id === parseInt("{{$user->state}}") ? 'selected' : '';
                    stateSelect.append(`<option value="${state.id}" ${selected}>${state.name}</option>`);
                });
            }

            $('#state').prop('disabled', false);

            // If there's a selected state, wait for select2 to initialize before loading cities
            if("{{$user->state}}") {
                await new Promise(resolve => setTimeout(resolve, 100)); // Small delay to ensure select2 is ready
                await loadCities(countryId, "{{$user->state}}");
            }
        } catch (error) {
            console.error('Error loading states:', error);
            $('#state').prop('disabled', false);
        }
    }

    async function loadCities(countryId, stateId) {
        try {
            $('#city').prop('disabled', true).empty();
            $('#city').append('<option value="">Selecciona una ciudad</option>');

            const cityResponse = await $.ajax({
                url: `/api/cities/${countryId}/${stateId}`,
                type: 'GET'
            });

            let citySelect = $('#city');
            
            if (cityResponse && Array.isArray(cityResponse)) {
                cityResponse.forEach(function(city) {
                    let selected = city.id === parseInt("{{$user->city}}") ? 'selected' : '';
                    citySelect.append(`<option value="${city.id}" ${selected}>${city.name}</option>`);
                });
            } else if (cityResponse && Array.isArray(cityResponse.data)) {
                cityResponse.data.forEach(function(city) {
                    let selected = city.id === parseInt("{{$user->city}}") ? 'selected' : '';
                    citySelect.append(`<option value="${city.id}" ${selected}>${city.name}</option>`);
                });
            }

            $('#city').prop('disabled', false);
        } catch (error) {
            console.error('Error loading cities:', error);
            $('#city').prop('disabled', false);
        }
    }

    // Event Handlers using Select2 events
    $('#country').on('select2:select select2:clear', async function(e) {
        const countryId = $(this).val();
        if(countryId) {
            await loadStates(countryId);
        } else {
            $('#state, #city').prop('disabled', true).empty();
            $('#state').append('<option value="">Selecciona un estado</option>');
            $('#city').append('<option value="">Selecciona una ciudad</option>');
            $('#state, #city').trigger('change');
        }
    });

    $('#state').on('select2:select select2:clear', async function(e) {
        const countryId = $('#country').val();
        const stateId = $(this).val();
        if(countryId && stateId) {
            await loadCities(countryId, stateId);
        } else {
            $('#city').prop('disabled', true).empty();
            $('#city').append('<option value="">Selecciona una ciudad</option>');
            $('#city').trigger('change');
        }
    });

    // Initialize on document ready
    $(document).ready(function() {
        loadInitialData();
    });
</script>
<script>
    $(function () {
        $(".selectSkills").selectize({
            create: false,
        });
        $(".selectInterests").selectize({
            create: false,
        });
    });
    $(document).on('click', '.delete-row', function() {
        $(this).closest('.row').remove();
    });

    $(document).ready(function() {

        //Borrado
        $('.delete-save').click(function() {
            var id = $(this).data('id');

            // Confirmar la eliminación
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                $.ajax({
                    url: '{{route('dashboard.social.delete')}}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(error) {
                        // Manejar errores
                        console.error(error);
                        alert('Ocurrió un error al eliminar el registro');
                    }
                });
            }
        });

        //Add social
        $('#add-row-btn').click(function() {
            $('#your-container-id').append(`
                <div class="row" style="position:relative;">
                    <div class="col-lg-12">
                        <a class="btn btn-danger btn-sm delete-row">X</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Red social:</label>
                            <select name="social[]" class="form-control">
                                <option value="email">Email</option>
                                <option value="whatsapp">Whatsapp</option>
                                <option value="instagram">Instagram</option>
                                <option value="linkedin">Linkedin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Url:</label>
                            <input type="text" name="url[]" class="form-control">
                        </div>
                    </div>
                </div>
            `);
        });


        let formulario = $('#form');
        let elementosFormulario = formulario.find('input, select, textarea');
        $('#sendData').prop('disabled', true);

        function habilitarBoton() {
            $('#sendData').prop('disabled', false);
        }

        elementosFormulario.on('input', function() {
            habilitarBoton();
        });
    });
</script>
@endpush
