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
            <a href="#" class="group flex items-center gap-3">
                <div class="relative flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors duration-300">
                    <svg class="w-6 h-6 text-emerald-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                    <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-teal-400 rounded-full animate-ping"></span>
                    <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-teal-400 rounded-full"></span>
                </div>
                <span class="text-lg font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-white via-emerald-400 to-teal-200 group-hover:from-emerald-300 group-hover:to-white transition-all duration-300">
                    Kevin Escobar
                </span>
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
