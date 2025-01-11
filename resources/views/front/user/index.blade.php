@extends('layouts.main')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .heading-2 {
        font-size: 35px!important;
    }
    .blue {
        padding: 20px;
        background-color: #f3bfa5;
        border-radius: 10px;
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
        .avatar {
            width: 130px;
            height: 130px;
            top: -119px;
            left: 35px;
        }

        .heading-2 {
            font-size: 28px !important;
            margin: 0;
        }

        .contact-form {
            padding:20px;
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
                    <div class="d-flex align-items-center justify-content-center mt-240 md-mt-100 pb-60">
                        <h1 class="mb-10">Mi cuenta</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-form pt-60 pb-60" style="position:relative;">
        <div class="avatar" style="background-image:url('{{Gravatar::fallback($user->avatar)->get($user->email)}}');"></div>
        <div class="container">
            <div class="text-left">
                <h2 class="heading-2 mb-30">Hola, {{$user->fullname}}</h2>
            </div>
            @if ($errors->has('ocupation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ocupation') }}</strong>
                </span>
            @endif
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
                            <label class="mb-10 form-label">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{ucfirst($user->name)}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ucfirst($user->last_name)}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Teléfono:</label>
                            <input class="form-control" type="tel" name="phone" value="{{$user->phone}}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="mb-10 form-label">Ocupación:</label>
                            <input class="form-control" type="text" name="ocupation" value="{{$user->ocupation}}" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="mb-10 form-label">Sobre mi:</label>
                            <textarea name="about_me" rows="5" class="form-control">{{$user->about_me}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Sobre mí</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Hola! Soy una Creída muy:</label>
                            <textarea class="form-control" name="how_vain">{{@$user->additional->how_vain}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Soy increíble en (mis habilidades):</label>
                            <textarea class="form-control" name="skills">{{@$user->additional->skills}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Mi emprendimiento trata sobre:</label>
                            <textarea class="form-control" name="business_about">{{@$user->additional->business_about}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Trabajo en el corporativo, me dedico a:</label>
                            <textarea class="form-control" name="corporate_job">{{@$user->additional->corporate_job}}</textarea>
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
                            <label class="mb-10 form-label">Mi audiencia IDEAL es:</label>
                            <textarea class="form-control" name="ideal_audience">{{@$user->additional->ideal_audience}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Prefiero no trabajar con personas que:</label>
                            <textarea class="form-control" name="dont_work_with">{{@$user->additional->dont_work_with}}</textarea>
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
                            <label class="mb-10 form-label">Entré a Créetelo buscando:</label>
                            <textarea class="form-control" name="looking_for_in_creelo">{{@$user->additional->looking_for_in_creelo}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Más sobre TI:</h3>
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
                            <textarea class="form-control" name="sign">{{@$user->additional->sign}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Tienes hobbies?:</label>
                            <textarea class="form-control" name="hobbies">{{@$user->additional->hobbies}}</textarea>
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
                            <textarea class="form-control" name="has_children">{{@$user->additional->has_children}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Estás casada?:</label>
                            <textarea class="form-control" name="is_married">{{@$user->additional->is_married}}</textarea>
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
                            <label  class="mb-10 form-label">¿Comida favorita? (si, el postre va primero):</label>
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
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Para cerrar:</h3>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Qué te hace IRREMPLAZABLE?:</label>
                            <textarea class="form-control" name="irreplaceable">{{@$user->additional->irreplaceable}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Algún LOGRO que nos quieras compartir importante para ti?:</label>
                            <textarea class="form-control" name="achievement">{{@$user->additional->achievement}}</textarea>
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
                            <label class="mb-10 form-label">¿Qué te gustaría recibir?:</label>
                            <textarea class="form-control" name="like_to_receive">{{@$user->additional->like_to_receive}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="mb-10 form-label">¿Qué te hace bien o te trae felicidad?</label>
                            <textarea class="form-control" name="brings_you_happiness">{{@$user->additional->brings_you_happiness}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="blue">
                    <div class="row">
                        <div class="col-xl-12">
                            <h3>Somos abundantes:</h3>
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
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Ubicación</h3>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label">País</label>
                            <select name="country" class="form-control">
                                @foreach($countries as $code => $name)
                                    <option value="{{$code}}" {{($user->country == $code)? 'selected':''}}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="mb-10 form-label">Estado:</label>
                            <input class="form-control" type="text" name="state" value="{{$user->state}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="mb-10 form-label">Ciudad:</label>
                            <input class="form-control" type="text" name="city" value="{{$user->city}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <h3>Información extra</h3>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="mb-10 form-label">Código postal:</label>
                            <input class="form-control" type="text" name="postal_code" value="{{$user->postal_code}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="mb-10 form-label">Dirección:</label>
                            <input class="form-control" type="text" name="address" value="{{$user->address}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="mb-10 form-label">Empresa / emprendimiento:</label>
                            <input class="form-control" type="text" name="company_or_venture" value="{{$user->company_or_venture}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="mb-10 form-label">Habilidades:</label>
                            <select class="select2 form-control" name="abilities[]" multiple="multiple">
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
                            <label class="mb-10 form-label">Servicios:</label>
                            <select class="select2 form-control" name="services[]" multiple="multiple">
                                @isset($userServices)
                                    @if(count($userServices) > 0)
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}" @if(in_array($service->id, $userServices)) selected @endif>{{$service->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    @endif
                                @else
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-succcess" id="sendData">Actualizar información</button>
                </form>
                <form action="{{route('dashboard.social.update')}}" id="formSocial" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-12">
                            <h3>Redes sociales</h3>
                        </div>
                    </div>
                    @foreach($user->socials as $social)
                        <div class="row" style="position: relative;">
                            <div class="col-lg-12">
                                <a data-id="{{$social->id}}" class="btn btn-danger btn-sm delete-save">X</a>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="mb-10 form-label">Red social:</label>
                                    <select name="social[]" class="form-control" required>
                                        <option value="email" @if($social->title == 'email') selected @endif>Email</option>
                                        <option value="whatsapp" @if($social->title == 'whatsapp') selected @endif>Whatsapp</option>
                                        <option value="instagram" @if($social->title == 'instagram') selected @endif>Instagram</option>
                                        <option value="linkedin" @if($social->title == 'linkedin') selected @endif>Linkedin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="mb-10 form-label">Url:</label>
                                    <input type="text" name="url[]" class="form-control" value="{{$social->url}}" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div id="your-container-id"></div>
                        <a id="add-row-btn" class="btn-add">Agregar nueva fila</a>
                    </div>
                    <button type="submit" class="btn-succcess" id="btnSocial">Actualizar redes sociales</button>
                </form>
        </div>
    </section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
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

        $('.select2').select2({
            allowClear: true,
            createTag: function (params) {
                return {
                    id: params.term,
                    text: params.term
                }
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
