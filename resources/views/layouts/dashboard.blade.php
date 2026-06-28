<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#030705] text-gray-100 min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-[#050c09] border-r border-[#1b4d3e]/20 flex flex-col shrink-0">
        <!-- Logo -->
        <div class="h-20 border-b border-[#1b4d3e]/20 flex items-center px-6 gap-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo KVN" class="h-10 w-auto rounded-lg object-contain">
            <span class="text-sm font-bold tracking-wider text-emerald-400 uppercase">Admin</span>
        </div>
        
        <!-- User Info -->
        <div class="p-6 border-b border-[#1b4d3e]/10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center font-bold text-emerald-400 text-sm">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <h4 class="text-sm font-semibold text-white">{{ auth()->user()->name }}</h4>
                <p class="text-[10px] text-gray-500 uppercase tracking-wider">Administrador</p>
            </div>
        </div>

        <!-- Menu Navigation -->
        <nav class="flex-grow p-4 space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#0b3c2d]/40 text-emerald-300 border-l-4 border-emerald-400' : 'text-gray-400 hover:bg-[#0b3c2d]/20 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                Mi Perfil
            </a>
            
            <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.projects.*') ? 'bg-[#0b3c2d]/40 text-emerald-300 border-l-4 border-emerald-400' : 'text-gray-400 hover:bg-[#0b3c2d]/20 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/></svg>
                Proyectos
            </a>

            <a href="{{ route('portfolio') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-[#0b3c2d]/10 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                Ver Portafolio
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-[#1b4d3e]/10">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-grow flex flex-col min-w-0">
        <!-- Top bar -->
        <header class="h-20 border-b border-[#1b4d3e]/20 flex items-center justify-between px-8 bg-[#050c09]">
            <h2 class="text-lg font-semibold text-white">
                @yield('header_title', 'Administración')
            </h2>
            <div class="text-xs text-gray-500">
                Sesión activa: <span class="text-emerald-400">{{ auth()->user()->email }}</span>
            </div>
        </header>

        <!-- Body Content -->
        <div class="flex-grow p-8 overflow-y-auto">
            @if(session('success'))
                <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm p-4 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>
