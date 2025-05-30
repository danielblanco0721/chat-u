<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tropiconecta | Registro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('dist/media/img/logox2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body.auth {
            min-height: 100vh;
            background-image: url('https://www.unitropico.edu.co/images/2019/Comunicaciones/fachada.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }
        
        body.auth::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .form-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .logo img {
            max-width: 220px;
            height: auto;
        }
        
        h5 {
            text-align: center;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-control {
            width: 100%;
            height: 50px;
            border-radius: 8px;
            padding: 0 15px 0 45px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 18px;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 20px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            cursor: pointer;
            display: block;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .text-primary {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .text-primary:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7f8c8d;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            font-weight: 500;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 576px) {
            .form-wrapper {
                padding: 20px;
            }
        }
    </style>
</head>
<body class="auth">
    <div class="form-wrapper">
        <div class="logo">
            <img src="{{ asset('dist/media/img/logo-2x.png') }}" alt="logo">
        </div>

        <h5>Registrarse</h5>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <i class="input-icon fas fa-user"></i>
                <input type="text" id="name" name="name" class="form-control" 
                       placeholder="Nombre completo" value="{{ old('name') }}" 
                       required autofocus>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <i class="input-icon fas fa-envelope"></i>
                <input type="email" id="email" name="email" class="form-control" 
                       placeholder="Correo electrónico" value="{{ old('email') }}" 
                       required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <i class="input-icon fas fa-lock"></i>
                <input type="password" id="password" name="password" 
                       class="form-control" placeholder="Contraseña" required>
                <i class="password-toggle fas fa-eye" 
                   onclick="togglePassword('password')"></i>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <i class="input-icon fas fa-lock"></i>
                <input type="password" id="password_confirmation" 
                       name="password_confirmation" class="form-control" 
                       placeholder="Confirmar contraseña" required>
                <i class="password-toggle fas fa-eye" 
                   onclick="togglePassword('password_confirmation')"></i>
            </div>

            <div class="form-group d-flex justify-content-between">
                <a href="{{ route('login') }}" class="text-sm text-primary">
                    <i class="fas fa-sign-in-alt"></i> ¿Ya estás registrado?
                </a>
            </div>

            <button class="btn btn-primary" type="submit">
                <i class="fas fa-user-plus"></i> {{ __('Registrarse') }}
            </button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggleIcon = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>