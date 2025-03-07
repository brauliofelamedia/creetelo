@extends('layouts.main-blank')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-4 offset-xl-4 bg-white" id="form-code">
                <div class="logo">
                    <img src="{{asset('images/logo.webp')}}" class="logo">
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h3 class="text-center mb-4">Solicitar link mágico</h3>
                <form method="POST" action="{{route('front.magic.generate')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-submit">Solicitar link</button>
                    </div>
                    <p style="line-height: 1.2em;font-size:14px;margin-top:10px;">Recuerda que solo tienes 5 minutos antes de que caduque el enlace que llega a tu bandeja de entrada o carpeta de spam.</>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    body {
        background-color: #fafafa!important;
    }

    .alert {
        font-size: 14px!important;
    }

    label {
        font-weight: 500;
        font-size: 15px;
        color: black;
    }

    #form-code {
        padding:40px;
        padding-top: 20px;
        border-radius: 14px;
        position: relative;
        margin-top: 150px;
        top:50%;
        border: 1px solid #ececec;
    }

    h3 {
        font-size: 24px;
        font-weight: 600;
        padding:10px 20px;
        color: black;
    }

    .btn-submit {
        background-color: #585388;
        color: white;
        font-weight: 600;
        padding: 10px;
    }

    .btn-submit:hover {
        background-color: #4a437f;
        color: white;
    }

    .logo {
        width: 170px;
        display: block;
        margin: 20px auto;
    }

    @media (max-width:480px){
        #form-code {
            margin-top: 10px;
            padding:20px;
        }
    }
</style>
@endpush