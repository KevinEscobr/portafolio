<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['hero_title'] ?? 'Portafolio Profesional' }}</title>
    <meta name="description" content="{{ Str::limit($settings['bio'] ?? '', 150) }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Meta tags adicionales -->
    <meta name="robots" content="index, follow">
</head>
<body class="bg-[#050c09] text-gray-100 overflow-x-hidden font-sans selection:bg-[#1b4d3e] selection:text-white">
    
    <!-- Contenedor del Canvas de Three.js -->
    <div id="canvas-container" class="fixed top-0 left-0 w-full h-full -z-10 pointer-events-none"></div>

    <!-- Barra de Navegación -->
    <nav class="fixed top-0 left-0 w-full z-50 backdrop-blur-md bg-[#050c09]/60 border-b border-[#1b4d3e]/20 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="#" class="text-xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">
                PORTAFOLIO
            </a>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#inicio" class="hover:text-emerald-400 transition-colors">Inicio</a>
                <a href="#sobre-mi" class="hover:text-emerald-400 transition-colors">Sobre Mí</a>
                <a href="#proyectos" class="hover:text-emerald-400 transition-colors">Proyectos</a>
                <a href="#contacto" class="hover:text-emerald-400 transition-colors">Contacto</a>
            </div>
            <!-- Botón de acceso directo a admin en móvil o pc -->
            <a href="{{ route('admin.dashboard') }}" class="text-xs uppercase tracking-widest text-gray-400 hover:text-emerald-400 transition-colors">
                Admin
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-[#1b4d3e]/20 bg-[#040807]/90 py-10 text-center text-sm text-gray-500">
        <div class="max-w-7xl mx-auto px-6">
            <p>&copy; {{ date('Y') }} Portafolio 3D. Desarrollado con Laravel, Tailwind y Three.js.</p>
        </div>
    </footer>
</body>
</html>
