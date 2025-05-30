<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tropiconecta | Bienvenido</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            background-image: url('https://www.unitropico.edu.co/images/2019/Comunicaciones/fachada.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .welcome-container {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 2rem;
            max-width: 800px;
        }
        
        .logo {
            margin-bottom: 2.5rem;
            animation: fadeInDown 1s ease-out;
        }
        
        .logo img {
            max-width: 280px;
            height: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
        }
        
        .welcome-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            margin-bottom: 1.5rem;
            letter-spacing: -0.5px;
            line-height: 1.1;
            animation: fadeIn 1.2s ease-out;
        }
        
        .welcome-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1.4s ease-out;
        }
        
        .auth-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            animation: fadeInUp 1s ease-out;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1.1rem 2.5rem;
            font-size: 1.15rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
            cursor: pointer;
            min-width: 200px;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            transition: width 0.4s ease;
            z-index: -1;
        }
        
        .btn:hover::before {
            width: 100%;
        }
        
        .btn-login {
            background-color: #3498db;
            color: white;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }
        
        .btn-register {
            background-color: #2ecc71;
            color: white;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2.5rem;
            }
            
            .welcome-subtitle {
                font-size: 1.2rem;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn {
                width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
        }
    </style>
    
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="welcome-container">
        <div class="logo">
            <link rel="icon" href="{{ asset('dist/media/img/logo-2x.png') }}" type="image/png">
        </div>
        
        <h1 class="welcome-title">Bienvenido a Tropiconecta</h1>
        <p class="welcome-subtitle">La plataforma de comunicación para la comunidad universitaria</p>
        
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-register">
                    <i class="fas fa-user-plus"></i> Registrarse
                </a>
            @endif
        </div>
    </div>
</body>
</html>