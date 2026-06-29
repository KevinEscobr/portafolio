@extends('layouts.dashboard')

@section('header_title', 'Configuración de Mi Perfil')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.dashboard.update') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Errores de Validación -->
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-sm p-4 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Bloque 1: Perfil Público -->
        <div class="bg-[#050c09] border border-[#1b4d3e]/20 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-lg font-semibold text-emerald-400 border-b border-[#1b4d3e]/10 pb-3">Información del Portafolio Público</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="hero_title" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Título de Bienvenida (Hero)</label>
                    <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
                <div>
                    <label for="hero_subtitle" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Subtítulo de Bienvenida (Hero)</label>
                    <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>

            <div>
                <label for="bio" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Sobre Mí (Biografía)</label>
                <textarea name="bio" id="bio" rows="6" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white font-light leading-relaxed">{{ old('bio', $settings['bio'] ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">WhatsApp</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" placeholder="Ej: +56912345678" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Email de Contacto Público</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $settings['email'] ?? '') }}" placeholder="Ej: contacto@nennge.me" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>

            <div>
                <label for="whatsapp_message" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Mensaje Personalizado de WhatsApp</label>
                <input type="text" name="whatsapp_message" id="whatsapp_message" value="{{ old('whatsapp_message', $settings['whatsapp_message'] ?? '') }}" placeholder="Ej: ¡Hola! Me gustaría contactarme contigo." class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="github" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Enlace de GitHub</label>
                    <input type="url" name="github" id="github" value="{{ old('github', $settings['github'] ?? '') }}" placeholder="https://github.com/tu-usuario" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
                <div>
                    <label for="linkedin" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Enlace de LinkedIn</label>
                    <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin', $settings['linkedin'] ?? '') }}" placeholder="https://linkedin.com/in/tu-usuario" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>
        </div>

        <!-- Bloque 2: Cuenta de Usuario -->
        <div class="bg-[#050c09] border border-[#1b4d3e]/20 rounded-2xl p-6 md:p-8 space-y-6">
            <h3 class="text-lg font-semibold text-emerald-400 border-b border-[#1b4d3e]/10 pb-3">Seguridad y Cuenta Administrativa</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="admin_name" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Nombre del Administrador</label>
                    <input type="text" name="admin_name" id="admin_name" value="{{ old('admin_name', $user->name) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
                <div>
                    <label for="admin_email" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Correo de Inicio de Sesión</label>
                    <input type="email" name="admin_email" id="admin_email" value="{{ old('admin_email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>

            <div class="border-t border-[#1b4d3e]/10 pt-4">
                <p class="text-xs text-gray-400 mb-4">Completa los siguientes campos solo si deseas cambiar tu contraseña de acceso.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end gap-4">
            <button type="submit" class="px-8 py-4 rounded-xl font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 shadow-lg shadow-emerald-500/10 hover:shadow-emerald-500/20 transform hover:-translate-y-0.5">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
