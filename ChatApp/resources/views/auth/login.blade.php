<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tropiconecta | Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('dist/media/img/logox2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('dist/icons/materialicons/css/materialdesignicons.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('dist/vendor/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/landing-page.min.css') }}">
</head>
<body class="auth" style="background-image: url('https://www.unitropico.edu.co/images/2019/Comunicaciones/fachada.jpg'); background-size: contain; background-repeat: no-repeat; background-position: center center;">

<div class="form-wrapper">

    <div class="logo my-5">
        <img src="{{ asset('dist/media/img/logo-2x.png') }}" alt="logo" style="width: 200px; height: auto;">
    </div>

    <h5>Acceder</h5>

    @error('email')
        <strong style="color: red;">{{ $message }}</strong>
    @enderror

    @error('password')
        <strong style="color: red;">{{ $message }}</strong>
    @enderror

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <input type="text" id="email" name="email" class="form-control" placeholder="Ingrese Correo Electronico" required="" autofocus="">
        </div>

        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese Contraseña" required="">
        </div>


        <div class="form-group d-flex justify-content-between">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Recuerdame</label>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">{{ __('Iniciar Sesión') }}</button>
    </form>

</div>
<script src="{{ asset('dist/vendor/bundle.js') }}"></script>
<script src="{{ asset('dist/js/landing-page.min.js') }}"></script>
</body>
</html>
