@extends('layouts.main')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .heading-2 {
        font-size: 35px!important;
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
</style>
@endpush

@section('content')
    <div class="about-us-banner" style="background-image: url('{{asset('images/home.webp')}}')">
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
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Imagen de perfil</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{ucfirst($user->name)}}" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Apellidos:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ucfirst($user->last_name)}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Teléfono:</label>
                            <input class="form-control" type="tel" name="phone" value="{{$user->phone}}" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Ocupación:</label>
                            <input class="form-control" type="text" name="ocupation" value="{{$user->ocupation}}" required>
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
                            <label class="form-label mb-10">Estado:</label>
                            <input class="form-control" type="text" name="state" value="{{$user->state}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Ciudad:</label>
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
                            <label class="form-label mb-10">Código postal:</label>
                            <input class="form-control" type="text" name="postal_code" value="{{$user->postal_code}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Dirección:</label>
                            <input class="form-control" type="text" name="address" value="{{$user->address}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Empresa / emprendimiento:</label>
                            <input class="form-control" type="text" name="company_or_venture" value="{{$user->company_or_venture}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label mb-10">Sobre mí:</label>
                            <textarea name="about_me" rows="6" class="form-control">{{$user->about_me}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label mb-10">Descripción de habilidades:</label>
                            <textarea name="skills" rows="6" class="form-control">{{$user->skills}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label mb-10">Habilidades:</label>
                            <select class="select2 form-control" name="abilities[]" multiple="multiple">
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}" @if(in_array($skill->id, $userSkills)) selected @endif>{{$skill->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label mb-10">Servicios:</label>
                            <select class="select2 form-control" name="services[]" multiple="multiple">
                                @if(count($userServices) > 0)
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" @if(in_array($service->id, $userServices)) selected @endif>{{$service->name}}</option>
                                    @endforeach
                                @else
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                @endif
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
                                    <label class="form-label mb-10">Red social:</label>
                                    <select name="social[]" class="form-control" required>
                                        <option value="facebook" @if($social->title == 'facebook') selected @endif>Facebook</option>
                                        <option value="linkedin" @if($social->title == 'linkedin') selected @endif>Linkedin</option>
                                        <option value="x" @if($social->title == 'x') selected @endif>X (Twitter)</option>
                                        <option value="instagram" @if($social->title == 'instagram') selected @endif>Instagram</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label mb-10">Url:</label>
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
                            <label class="form-label mb-10">Red social:</label>
                            <select name="social[]" class="form-control">
                                <option value="facebook">Facebook</option>
                                <option value="x">X (Twitter)</option>
                                <option value="linkedin">Linkedin</option>
                                <option value="instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label mb-10">Url:</label>
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