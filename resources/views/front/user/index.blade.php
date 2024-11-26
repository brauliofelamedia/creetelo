@extends('layouts.main')

@push('css')
<style>
    .heading-2 {
        font-size: 35px!important;
    }

    .avatar {
        width:180px;
        height: 180px;
        background-color: red;
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
        background-color: red;
        padding:20px;
        border-radius: 6px;
        width: 100%;
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
        <div class="avatar" style="background-image:url('{{Gravatar::get($user->email)}}');"></div>
        <div class="container">
            <div class="text-left">
                <h2 class="heading-2 mb-30">Hola, {{$user->name}}</h2>
            </div>
            <form action="{{route('dashboard.account.process')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Nombre:</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Apellidos:</label>
                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-label mb-10">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label class="form-label mb-10">Teléfono:</label>
                        <input class="form-control" type="tel" name="phone" value="{{$user->phone}}" required>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label mb-10">Empresa / emprendimiento:</label>
                        <input class="form-control" type="text" name="company_or_venture" value="{{$user->company_or_venture}}">
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label mb-10">Ocupación:</label>
                        <input class="form-control" type="text" name="ocupation" value="{{$user->ocupation}}" required>
                    </div>
                </div>
                <div class="row">
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
                </div>
                <button type="submit" class="btn-succcess">Actualizar información</button>
            </form>
        </div>
    </section>

@endsection