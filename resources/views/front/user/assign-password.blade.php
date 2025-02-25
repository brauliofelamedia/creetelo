@extends('layouts.main')

@push('css')
<style>
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

    .navbar-menu {
        display:none!important;
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
                        <h1 class="mb-10">Asigna una contraseña</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-form pt-60 pb-60" style="position:relative;">
        <div class="container">
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
            <div class="col-6 offset-3">
                <div class="text-left">
                    <h2 class="heading-2 mb-30">Hola, {{$user->fullname}}</h2>
                </div>
                <form action="{{route('front.account.assign')}}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{$user->password_assign_token}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mb-10 form-label">Contraseña:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="mb-10 form-label">Repite tu contraseña:</label>
                                <input type="password" name="repeat_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn-succcess">Crear contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('js')
@endpush
