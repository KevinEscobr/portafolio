@extends('layouts.dashboard')

@section('header_title', 'Nuevo Proyecto')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.projects.index') }}" class="text-xs text-emerald-400 hover:text-emerald-300 transition-colors">
            &larr; Volver al listado
        </a>
    </div>

    <div class="bg-[#050c09] border border-[#1b4d3e]/20 rounded-2xl p-6 md:p-8">
        <h3 class="text-lg font-semibold text-white mb-6 border-b border-[#1b4d3e]/10 pb-3">Registrar Nuevo Proyecto</h3>
        
        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 text-sm p-4 rounded-xl">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Título del Proyecto</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
            </div>

            <div>
                <label for="description" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Descripción</label>
                <textarea name="description" id="description" rows="5" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white font-light leading-relaxed">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="tags" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Tecnologías / Tags (separados por comas)</label>
                <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="Ej: Laravel, Tailwind CSS, Three.js, Docker" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="image" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Imagen de Portada (Opcional)</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full text-xs text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0b3c2d]/40 file:text-emerald-400 hover:file:bg-[#0b3c2d]/60 file:cursor-pointer cursor-pointer bg-gray-950/20 border border-[#1b4d3e]/30 rounded-xl p-1.5 focus:outline-none">
                </div>
                <div>
                    <label for="order" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Orden de Prioridad (Menor = Primero)</label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="github_url" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Enlace de GitHub (Opcional)</label>
                    <input type="url" name="github_url" id="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/usuario/repositorio" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
                <div>
                    <label for="live_url" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Enlace de Demo en Vivo (Opcional)</label>
                    <input type="url" name="live_url" id="live_url" value="{{ old('live_url') }}" placeholder="https://mi-proyecto.com" class="w-full px-4 py-3 rounded-xl bg-gray-950/50 border border-[#1b4d3e]/40 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 text-sm text-white">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-[#1b4d3e]/10 pt-6">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-3 rounded-xl text-sm font-semibold text-gray-400 hover:text-white transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 shadow-md shadow-emerald-500/10">
                    Crear Proyecto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
