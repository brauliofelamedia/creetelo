@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .heading-2 {
        font-size: 35px!important;
    }

    .select2-selection--multiple {
        padding: 10px;
    }

    li {
        list-style-type: none;
    }

    .select2-container--bootstrap-5 .select2-selection {
        min-height: 60px!important;
        border-radius: 5px!important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        line-height: 2.7!important;
    }

    .select2-container--default .select2-selection--multiple {
        padding-bottom: 12px!important;
    }

    .select2-container .select2-search--inline .select2-search__field {
        vertical-align: baseline!important;
    }

    span.select2.select2-container {
        margin-top: 3px!important;
    }

    /* Padding para los tags individuales */
    .select2-selection__choice {
        padding: 5px 10px;
        margin: 2px;
    }

    /* Padding para el campo de entrada de texto */
    .select2-search__field {
        padding: 5px;
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
            width: 120px;
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

        .profile {
            font-size: 11px;
            border-radius: 6px;
        }
    }

    .message-danger {
        background-color: red;
        color: white;
        padding: 2px 8px;
        display: inline-block;
        border-radius: 4px;
        margin-top: 5px;
        font-size: 13px;
    }

    .profile {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #fe5600;
        font-size: 12px;
        padding: 3px 10px;
        border-radius: 11px;
        color: white;
        font-weight: 500;
        cursor: pointer;
    }

    .profile:hover {
        color: white;
        background-color: #d14a06;
    }

    /* Styling for tabs */
    .nav-tabs {
        border-bottom: 2px solid #f3bfa5;
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 5px 5px 0 0;
        transition: all 0.3s ease;
    }
    
    .nav-tabs .nav-link:hover {
        color: white;
        background-color: #d14a06;
    }
    
    .nav-tabs .nav-link.active {
        color: white;
        background-color: #d14a06;
        border: none;
    }
    
    .tab-content {
        padding: 20px 0;
    }
    
    /* Full width button styling */
    .btn-update {
        background-color: #292775;
        color: white;
        font-weight: 600;
        padding: 15px;
        width: 100%;
        border-radius: 5px;
        margin-top: 20px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    
    .btn-update:hover {
        background-color: #1c1a6a;
        color: white;
    }
    
    /* Tab pane consistent spacing */
    .tab-pane {
        padding: 20px 0;
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
        <div class="avatar" style="background-image:url('{{$user->avatar}}');">
            <a href="{{route('front.contact.detail',$user->slug)}}" target="_blank" class="profile">Mi página</a>
        </div>
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
                <div class="row">
                    <div class="col-xl-12">

                        <div class="mb-4">
                            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Perfil general</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">Sobre mí</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="work-tab" data-bs-toggle="tab" data-bs-target="#work" type="button" role="tab" aria-controls="work" aria-selected="false">Sobre Mi Trabajo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="know-me-tab" data-bs-toggle="tab" data-bs-target="#know-me" type="button" role="tab" aria-controls="know-me" aria-selected="false">Conóceme Más</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="gift-tab" data-bs-toggle="tab" data-bs-target="#gift" type="button" role="tab" aria-controls="gift" aria-selected="false">Te regalo</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="profileTabsContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Contenido del perfil general -->
                                <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_tab" value="profile">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Actualizar avatar:</label>
                                                <input type="file" class="form-control" name="avatar">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Nombre: <span class="required">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid border-danger @enderror" name="name" value="{{ old('name', ucfirst($user->name)) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Apellidos: <span class="required">*</span></label>
                                                <input type="text" class="form-control @error('last_name') is-invalid border-danger @enderror" name="last_name" value="{{ old('last_name', ucfirst($user->last_name)) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Correo electrónico: <span class="required">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid border-danger @enderror" name="email" value="{{$user->email}}" readonly required>
                                                <div class="form-check" style="float: right;margin-top: 11px;">
                                                    <input class="form-check-input" type="checkbox" name="is_email" {{ old('is_email', $user->is_email) == 1 ? 'checked' : '' }} style="padding: 10px !important;" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;margin-left:8px;">Mostrar el correo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">WhatsApp: <small style="color:#ff5600;">Recuerda agregar el código de tu país.</small></label>
                                                <input class="form-control" type="tel" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" placeholder="Ejemplo: 523114174458">
                                                <small class="message-danger">Si llenas el campo de WhatsApp, será público y se mostrará en tu biografía.</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">País:<span class="required">*</span></label>
                                                <select class="form-control @error('country') is-invalid border-danger @enderror" name="country" id="country" required>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->iso2}}" {{($country->iso2 == $user->country)? 'selected' : ''}}>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Estado:<span class="required">*</span></label>
                                                <select class="form-control" name="state" id="state" required></select>
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
                                                <div class="input-group">
                                                    <span class="input-group-text">https://instagram.com/</span>
                                                    <input class="form-control" type="text" name="instagram" value="{{ old('instagram', $user->instagram) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Linkedin:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">https://linkedin.com/</span>
                                                    <input class="form-control" type="text" name="linkedin" value="{{ old('linkedin', $user->linkedin) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Página Web:</label>
                                                <input class="form-control" type="url" name="website" value="{{ old('website', $user->website) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-update">Actualizar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <!-- Contenido de Sobre mí -->
                                <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_tab" value="about">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Bio corta:<span class="required">*</span></label>
                                                <textarea name="about_me" rows="5" required maxlength="1000" class="form-control @error('amout_me') is-invalid border-danger @enderror">{{ old('about_me', $user->about_me) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Soy increíble en (mis habilidades):<span class="required">*</span></label>
                                                <select required name="abilities[]" id="selectSkills" class="form-control" multiple="multiple" style="width: 100%;">
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
                                                <select required name="interests[]" id="selectInterests" class="selectInterests form-control" multiple="multiple" style="width: 100%;">
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
                                                <textarea class="form-control" name="how_vain">{{ old('how_vain', @$user->additional->how_vain) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Te atreves a contarnos tu sueño más grande? #manifiestababy:</label>
                                                <textarea class="form-control" name="biggest_dream">{{ old('biggest_dream', @$user->additional->biggest_dream) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Qué te hace bien o te trae felicidad?</label>
                                                <textarea class="form-control" name="brings_you_happiness">{{ old('brings_you_happiness', @$user->additional->brings_you_happiness) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Entré a Créetelo buscando:</label>
                                                <textarea class="form-control" name="looking_for_in_creelo">{{ old('looking_for_in_creelo', @$user->additional->looking_for_in_creelo) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-update">Actualizar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="work" role="tabpanel" aria-labelledby="work-tab">
                                <!-- Contenido de Sobre Mi Trabajo -->
                                <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_tab" value="work">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Ocupación:<span class="required">*</span></label>
                                                <input class="form-control @error('ocupation') is-invalid border-danger @enderror" type="text" name="ocupation" value="{{ old('ocupation', $user->ocupation) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Mi emprendimiento/negocio/trabajo trata sobre: <span class="required">*</span></label>
                                                <textarea class="form-control @error('business_about') is-invalid border-danger @enderror" name="business_about" required>{{ old('business_about', @$user->additional->business_about) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Mi audiencia IDEAL es:</label>
                                                <textarea class="form-control" name="ideal_audience">{{ old('ideal_audience', @$user->additional->ideal_audience) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Mis valores más importantes son:</label>
                                                <textarea class="form-control" name="values">{{ old('values', @$user->additional->values) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Mi tono es:</label>
                                                <textarea class="form-control" name="tone">{{ old('tone', @$user->additional->tone) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Mi misión es ayudar a que más personas:</label>
                                                <textarea class="form-control" name="mission">{{ old('mission', @$user->additional->mission) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Prefiero no trabajar con personas que:</label>
                                                <textarea class="form-control" name="dont_work_with">{{ old('dont_work_with', @$user->additional->dont_work_with) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Algún LOGRO que nos quieras compartir importante para ti?:</label>
                                                <textarea class="form-control" name="achievement">{{ old('achievement', @$user->additional->achievement) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">Trabajo en el corporativo, me dedico a:</label>
                                                <textarea class="form-control" name="corporate_job">{{ old('corporate_job', @$user->additional->corporate_job) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-update">Actualizar</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="know-me" role="tabpanel" aria-labelledby="know-me-tab">
                                <!-- Contenido de Conóceme Más -->
                                <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_tab" value="know-me">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Dónde naciste y creciste?:</label>
                                                <textarea class="form-control" name="birthplace">{{ old('birthplace', @$user->additional->birthplace) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Qué signo eres?:</label>
                                                <select class="form-select" name="sign" aria-label="Selecciona tu signo zodiacal">
                                                    <option selected>Selecciona tu signo</option>
                                                    <option value="Aries" {{ old('sign', @$user->additional->sign) == 'Aries'? 'selected':'' }}>Aries</option>
                                                    <option value="Tauro" {{ old('sign', @$user->additional->sign) == 'Tauro'? 'selected':'' }}>Tauro</option>
                                                    <option value="Géminis" {{ old('sign', @$user->additional->sign) == 'Géminis'? 'selected':'' }}>Géminis</option>
                                                    <option value="Cáncer" {{ old('sign', @$user->additional->sign) == 'Cáncer'? 'selected':'' }}>Cáncer</option>
                                                    <option value="Leo" {{ old('sign', @$user->additional->sign) == 'Leo'? 'selected':'' }}>Leo</option>
                                                    <option value="Virgo" {{ old('sign', @$user->additional->sign) == 'Virgo'? 'selected':'' }}>Virgo</option>
                                                    <option value="Libra" {{ old('sign', @$user->additional->sign) == 'Libra'? 'selected':'' }}>Libra</option>
                                                    <option value="Escorpio" {{ old('sign', @$user->additional->sign) == 'Escorpio'? 'selected':'' }}>Escorpio</option>
                                                    <option value="Sagitario" {{ old('sign', @$user->additional->sign) == 'Sagitario'? 'selected':'' }}>Sagitario</option>
                                                    <option value="Capricornio" {{ old('sign', @$user->additional->sign) == 'Capricornio'? 'selected':'' }}>Capricornio</option>
                                                    <option value="Acuario" {{ old('sign', @$user->additional->sign) == 'Acuario'? 'selected':'' }}>Acuario</option>
                                                    <option value="Piscis" {{ old('sign', @$user->additional->sign) == 'Piscis'? 'selected':'' }}>Piscis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Bebida favorita?:</label>
                                                <textarea class="form-control" name="favorite_drink">{{ old('favorite_drink', @$user->additional->favorite_drink) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Tienes hijos?:</label>
                                                <select name="has_children" class="form-control">
                                                    <option value="si" {{ old('has_children', @$user->additional->has_children) == 'si'? 'selected':'' }}>Sí</option>
                                                    <option value="no" {{ old('has_children', @$user->additional->has_children) == 'no'? 'selected':'' }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Tu viaje favorito que has hecho?:</label>
                                                <textarea class="form-control" name="favorite_trip">{{ old('favorite_trip', @$user->additional->favorite_trip) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿A dónde te gustaría viajar next?:</label>
                                                <textarea class="form-control" name="next_trip">{{ old('next_trip', @$user->additional->next_trip) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Postre favorito?:</label>
                                                <textarea class="form-control" name="favorite_dessert">{{ old('favorite_dessert', @$user->additional->favorite_dessert) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Estás casada?:</label>
                                                <select name="is_married" class="form-control">
                                                    <option value="si" {{ old('is_married', @$user->additional->is_married) == 'si'? 'selected':'' }}>Sí</option>
                                                    <option value="no" {{ old('is_married', @$user->additional->is_married) == 'no'? 'selected':'' }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Comida favorita?:</label>
                                                <textarea class="form-control" name="favorite_food">{{ old('favorite_food', @$user->additional->favorite_food) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Qué serie o película recomiendas mucho?:</label>
                                                <textarea class="form-control" name="movie_recommendation">{{ old('movie_recommendation', @$user->additional->movie_recommendation) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Qué libro recomiendas? (Aparte de Hello Fears, obvio):</label>
                                                <textarea class="form-control" name="book_recommendation">{{ old('book_recommendation', @$user->additional->book_recommendation) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="mb-10 form-label">¿Qué PODCAST amas?:</label>
                                                <textarea class="form-control" name="podcast_recommendation">{{ old('podcast_recommendation', @$user->additional->podcast_recommendation) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-update">Actualizar</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="gift" role="tabpanel" aria-labelledby="gift-tab">
                                <!-- Contenido de Te Regalo -->
                                <form action="{{route('dashboard.account.update')}}" method="post" enctype="multipart/form-data" id="form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_tab" value="gift">
                                    <div class="blue">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="mb-10 form-label">¿Qué te gustaría regalar? (Una guía, una meditación, un producto, una mentoría, una sesión, una clase...):</label>
                                                    <textarea class="form-control" name="gift">{{ old('gift', @$user->additional->gift) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="mb-10 form-label">Comparte un link:</label>
                                                    <input type="text" class="form-control" name="gift_link" value="{{ old('gift_link', @$user->additional->gift_link) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-update">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Check for active tab in session and activate it
    $(document).ready(function() {
        // If there is an active tab from the session data, activate it
        var activeTab = "{{ session('active_tab') ?? 'profile' }}";
        if(activeTab) {
            var tabId = activeTab.replace('_', '-');
            $('#profileTabs button[data-bs-target="#' + tabId + '"]').tab('show');
        }

        // Initialize Select2 with loading state
        $('#country, #state, #city').select2({
            theme: 'bootstrap-5',
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
    
        // Function to load initial state and city values
        function loadInitialStateAndCity() {
            if ($('#country').val()) {
                $.ajax({
                    url: '{{route('api.new.states')}}',
                    type: 'POST',
                    data: {
                        country: $('#country').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#state').empty();
                        $('#state').append('<option value="">Selecciona un estado</option>');
                        $.each(response, function(key, value) {
                            let selected = value.name === '{{$user->state}}' ? 'selected' : '';
                            $('#state').append('<option value="' + value.name + '" ' + selected + '>' + value.name + '</option>');
                        });

                        // Load cities after state is loaded
                        if ('{{$user->state}}') {
                            $.ajax({
                                url: '{{route('api.new.cities')}}',
                                type: 'POST',
                                data: {
                                    country: $('#country').val(),
                                    state: '{{$user->state}}',
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    $('#city').empty();
                                    $('#city').append('<option value="">Selecciona una ciudad</option>');
                                    $.each(response, function(key, value) {
                                        let selected = value.name === '{{$user->city}}' ? 'selected' : '';
                                        $('#city').append('<option value="' + value.name + '" ' + selected + '>' + value.name + '</option>');
                                    });
                                }
                            });
                        }
                    }
                });
            }
        }

        // Load initial values when document is ready
        $(document).ready(function() {
            loadInitialStateAndCity();
        });

        // Event handlers for dropdown changes
        $('#country').on('change', function(){
            $.ajax({
                url: '{{route('api.new.states')}}',
                type: 'POST',
                data: {
                    country: $(this).val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#state').empty();
                    $('#state').append('<option value="">Selecciona un estado</option>');
                    $.each(response, function(key, value) {
                        $('#state').append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

        $('#state').on('change', function(){
            $.ajax({
                url: '{{route('api.new.cities')}}',
                type: 'POST',
                data: {
                    country: $('#country').val(),
                    state: $(this).val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#city').empty();
                    $('#city').append('<option value="">Selecciona una ciudad</option>');
                    $.each(response, function(key, value) {
                        $('#city').append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });

        // Skills
        $('#selectSkills').select2({
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            }
        });

        $('#selectSkills').on('select2:select', function(e) {
            var selectedData = e.params.data;

            // Verifica si es un nuevo tag
            if (selectedData.newTag) {
                console.log('Nuevo tag detectado:', selectedData.text);

                // Guarda los valores actuales seleccionados
                var currentValues = $('#selectSkills').val();

                // Envía el nuevo tag al backend mediante AJAX
                $.ajax({
                    url: '{{ route("api.skill.create") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: selectedData.text
                    },
                    success: function(response) {
                        console.log('Tag creado:', response);

                        // Elimina el tag temporal de los valores actuales
                        var updatedValues = currentValues.filter(function(value) {
                            return value !== selectedData.id; // Elimina el ID temporal
                        });

                        // Agrega el nuevo tag con el ID devuelto por el backend
                        updatedValues.push(response.id);

                        // Actualiza el Select2 con los valores actualizados
                        $('#selectSkills').val(updatedValues).trigger('change');

                        // Agrega la opción al Select2 (si no está ya presente)
                        var newOption = new Option(response.name, response.id, true, true);
                        $('#selectSkills').append(newOption).trigger('change');
                    },
                    error: function(xhr) {
                        console.error('Error al crear el tag:', xhr.responseText);

                        // Si hay un error, elimina solo el tag temporal
                        var updatedValues = currentValues.filter(function(value) {
                            return value !== selectedData.id; // Elimina el ID temporal
                        });

                        // Actualiza el Select2 con los valores actualizados
                        $('#selectSkills').val(updatedValues).trigger('change');
                    }
                });
            }
        });

        // Hobbies
        $('#selectInterests').select2({
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            }
        });

        $('#selectInterests').on('select2:select', function(e) {
            var selectedData = e.params.data;

            // Verifica si es un nuevo tag
            if (selectedData.newTag) {
                console.log('Nuevo tag detectado:', selectedData.text);

                // Guarda los valores actuales seleccionados
                var currentValues = $('#selectInterests').val();

                // Envía el nuevo tag al backend mediante AJAX
                $.ajax({
                    url: '{{ route("api.interest.create") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: selectedData.text
                    },
                    success: function(response) {
                        console.log('Tag creado:', response);

                        // Elimina el tag temporal de los valores actuales
                        var updatedValues = currentValues.filter(function(value) {
                            return value !== selectedData.id; // Elimina el ID temporal
                        });

                        // Agrega el nuevo tag con el ID devuelto por el backend
                        updatedValues.push(response.id);

                        // Actualiza el Select2 con los valores actualizados
                        $('#selectInterests').val(updatedValues).trigger('change');

                        // Agrega la opción al Select2 (si no está ya presente)
                        var newOption = new Option(response.name, response.id, true, true);
                        $('#selectInterests').append(newOption).trigger('change');
                    },
                    error: function(xhr) {
                        console.error('Error al crear el tag:', xhr.responseText);

                        // Si hay un error, elimina solo el tag temporal
                        var updatedValues = currentValues.filter(function(value) {
                            return value !== selectedData.id; // Elimina el ID temporal
                        });

                        // Actualiza el Select2 con los valores actualizados
                        $('#selectInterests').val(updatedValues).trigger('change');
                    }
                });
            }
        });

        // Add social
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

        $(document).on('click', '.delete-row', function() {
            $(this).closest('.row').remove();
        });

        // Delete social
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
                        console.error(error);
                        alert('Ocurrió un error al eliminar el registro');
                    }
                });
            }
        });
    });
</script>
@endpush
