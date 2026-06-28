<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Admin Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#050c09] text-gray-100 min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-md bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/30 rounded-2xl p-8 shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white tracking-wide">PANEL DE CONTROL</h1>
            <p class="text-xs text-gray-400 mt-2">Ingresa tus credenciales para acceder</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 text-sm p-4 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-300 uppercase tracking-widest mb-2">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors text-sm text-white">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-300 uppercase tracking-widest mb-2">Contraseña</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors text-sm text-white">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 bg-gray-950">
                <label for="remember" class="ml-2 text-xs text-gray-300">Mantener sesión iniciada</label>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl font-medium bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 font-semibold shadow-lg shadow-emerald-500/10 hover:shadow-emerald-500/20 transform hover:-translate-y-0.5">
                Ingresar al Panel
            </button>
        </form>

        <div class="mt-8 text-center border-t border-[#1b4d3e]/10 pt-4">
            <a href="{{ route('portfolio') }}" class="text-xs text-emerald-400 hover:text-emerald-300 transition-colors">
                &larr; Volver al Portafolio
            </a>
        </div>
    </div>
</body>
</html>
