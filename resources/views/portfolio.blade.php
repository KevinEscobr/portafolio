@extends('layouts.layout')

@section('content')
    <!-- Sección de Inicio / Hero -->
    <section id="inicio" class="min-h-screen flex items-center justify-center relative pt-20 px-6 overflow-hidden">
        <div class="max-w-4xl text-center z-10 select-none">
            <span class="text-xs uppercase tracking-widest text-emerald-400 font-semibold mb-4 inline-block bg-[#0b3c2d]/30 px-4 py-1.5 rounded-full border border-emerald-500/20">
                Bienvenido a mi espacio digital
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6">
                {{ $settings['hero_title'] ?? 'Hola, Soy Desarrollador Web' }}
            </h1>
            <p class="text-lg md:text-2xl text-gray-300 max-w-2xl mx-auto mb-10 font-light leading-relaxed">
                {{ $settings['hero_subtitle'] ?? 'Diseño y desarrollo experiencias interactivas y escalables.' }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#proyectos" class="w-full sm:w-auto px-8 py-4 rounded-xl font-medium bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 shadow-[0_4px_20px_rgba(16,185,129,0.25)] hover:shadow-[0_4px_25px_rgba(16,185,129,0.4)] transform hover:-translate-y-0.5">
                    Ver Proyectos
                </a>
                <a href="#contacto" class="w-full sm:w-auto px-8 py-4 rounded-xl font-medium border border-[#1b4d3e] text-white bg-transparent hover:bg-[#0b3c2d]/20 transition-all duration-300">
                    Contáctame
                </a>
            </div>
        </div>
        
        <!-- Indicador de Scroll -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex flex-col items-center gap-2">
            <span class="text-[10px] uppercase tracking-widest text-gray-500">Scroll</span>
            <div class="w-6 h-10 border-2 border-gray-600 rounded-full flex justify-center py-1.5">
                <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- Sección Sobre Mí -->
    <section id="sobre-mi" class="py-24 px-6 relative border-t border-[#1b4d3e]/10">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Info personal -->
                <div class="lg:col-span-7">
                    <span class="text-xs uppercase tracking-widest text-emerald-400 font-semibold mb-3 inline-block">Conóceme</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Sobre Mí</h2>
                    <div class="text-gray-300 space-y-6 leading-relaxed font-light">
                        <p>{!! nl2br(e($settings['bio'] ?? 'Desarrollador enfocado en brindar soluciones digitales.')) !!}</p>
                    </div>
                </div>
                
                <!-- Tarjeta con Información rápida y habilidades -->
                <div class="lg:col-span-5 bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/20 p-8 rounded-2xl">
                    <h3 class="text-xl font-semibold text-white mb-6 border-b border-[#1b4d3e]/20 pb-4">Detalles Rápidos</h3>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-400">Ubicación:</span>
                            <span class="text-emerald-400 font-medium">Chile</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-400">Especialidad:</span>
                            <span class="text-emerald-400 font-medium">Full Stack / Laravel / 3D Web</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-400">Trabajo:</span>
                            <span class="text-emerald-400 font-medium">Disponible para Proyectos</span>
                        </li>
                    </ul>
                    
                    <div class="mt-8">
                        <h4 class="text-sm font-semibold text-white mb-4">Habilidades Fuertes</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Laravel', 'PHP', 'JavaScript', 'Three.js', 'Tailwind CSS v4', 'MySQL', 'Docker', 'Vite'] as $skill)
                                <span class="text-xs px-3 py-1.5 rounded-lg bg-[#0b3c2d]/30 border border-[#1b4d3e]/30 text-emerald-300 font-medium">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Proyectos -->
    <section id="proyectos" class="py-24 px-6 relative border-t border-[#1b4d3e]/10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs uppercase tracking-widest text-emerald-400 font-semibold mb-3 inline-block">Mis trabajos</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white">Proyectos Destacados</h2>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto font-light">Una selección de desarrollos en los que he trabajado recientemente.</p>
            </div>
            
            @if($projects->isEmpty())
                <div class="text-center py-20 bg-[#0b3c2d]/5 backdrop-blur-md border border-[#1b4d3e]/20 rounded-2xl">
                    <p class="text-gray-400">Pronto se añadirán nuevos proyectos desde el Dashboard de administración.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div data-project-card
                             data-title="{{ $project->title }}"
                             data-description="{{ $project->description }}"
                             data-image="{{ $project->image_path ? asset('storage/' . $project->image_path) : '' }}"
                             data-github="{{ $project->github_url ?? '' }}"
                             data-live="{{ $project->live_url ?? '' }}"
                             data-tags="{{ json_encode($project->tags_array ?? []) }}"
                             class="group cursor-pointer bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/20 rounded-2xl overflow-hidden hover:border-emerald-500/50 hover:shadow-[0_0_30px_rgba(16,185,129,0.15)] transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
                            <!-- Imagen de Proyecto -->
                            <div class="aspect-video w-full overflow-hidden bg-emerald-950/40 relative">
                                @if($project->image_path)
                                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0b3c2d] to-[#050c09]">
                                        <span class="text-gray-500 font-mono text-xs">[ Sin Vista Previa ]</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Contenido Tarjeta -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-gray-300 text-sm font-light leading-relaxed mb-6 flex-grow">
                                    {{ Str::limit($project->description, 130) }}
                                </p>
                                
                                <!-- Tags -->
                                @if(!empty($project->tags_array))
                                    <div class="flex flex-wrap gap-1.5 mb-6">
                                        @foreach($project->tags_array as $tag)
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-[#0b3c2d]/40 text-emerald-300 border border-emerald-500/10">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <!-- Enlaces -->
                                <div class="flex items-center gap-4 mt-auto text-sm border-t border-[#1b4d3e]/20 pt-4">
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-gray-400 hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.138 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd"/></svg>
                                            GitHub
                                        </a>
                                    @endif
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1.5 text-emerald-400 hover:text-emerald-300 transition-colors ml-auto">
                                            Live Demo
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section id="contacto" class="py-24 px-6 relative border-t border-[#1b4d3e]/10 bg-[#040807]/30">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs uppercase tracking-widest text-emerald-400 font-semibold mb-3 inline-block">Hablemos</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white">¿Tienes un proyecto en mente?</h2>
                <p class="text-gray-400 mt-4 font-light">Ponte en contacto conmigo a través de cualquiera de los siguientes medios.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Teléfono / WhatsApp -->
                @if($settings['phone'])
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone']) }}" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center p-8 rounded-2xl bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/20 hover:border-emerald-500/50 hover:bg-[#0b3c2d]/20 transition-all duration-300 text-center group">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.122-4.1-6.924-6.924l1.293-.97a1.242 1.242 0 00.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-white mb-1">WhatsApp / Teléfono</span>
                        <span class="text-xs text-gray-400">{{ $settings['phone'] }}</span>
                    </a>
                @endif
                
                <!-- Email -->
                @if($settings['email'])
                    <a href="mailto:{{ $settings['email'] }}" class="flex flex-col items-center p-8 rounded-2xl bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/20 hover:border-emerald-500/50 hover:bg-[#0b3c2d]/20 transition-all duration-300 text-center group">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <span class="text-sm font-semibold text-white mb-1">Correo Electrónico</span>
                        <span class="text-xs text-gray-400 break-all px-2">{{ $settings['email'] }}</span>
                    </a>
                @endif
                
                <!-- Redes Sociales (LinkedIn / GitHub) -->
                <div class="flex flex-col items-center p-8 rounded-2xl bg-[#0b3c2d]/10 backdrop-blur-md border border-[#1b4d3e]/20 hover:border-emerald-500/50 hover:bg-[#0b3c2d]/20 transition-all duration-300 text-center group sm:col-span-2 md:col-span-1 justify-center">
                    <span class="text-sm font-semibold text-white mb-4">Redes Profesionales</span>
                    <div class="flex gap-4">
                        @if($settings['github'] && $settings['github'] !== '#')
                            <a href="{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 hover:bg-emerald-500 hover:text-gray-950 transition-all duration-300" title="GitHub">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.138 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd"/></svg>
                            </a>
                        @endif
                        @if($settings['linkedin'] && $settings['linkedin'] !== '#')
                            <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 hover:bg-emerald-500 hover:text-gray-950 transition-all duration-300" title="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Detalles de Proyecto -->
    <div id="project-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
        <!-- Contenedor del Modal -->
        <div id="project-modal-content" class="relative w-full max-w-3xl bg-[#050c09]/95 backdrop-blur-xl border border-[#1b4d3e]/30 rounded-2xl shadow-[0_0_50px_rgba(16,185,129,0.25)] overflow-hidden scale-95 transition-all duration-300 flex flex-col max-h-[90vh]">
            
            <!-- Cabecera / Imagen -->
            <div class="relative aspect-video w-full overflow-hidden bg-emerald-950/40 border-b border-[#1b4d3e]/20">
                <img id="modal-project-image" src="" alt="" class="w-full h-full object-cover">
                <div id="modal-project-image-fallback" class="hidden w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0b3c2d] to-[#050c09]">
                    <span class="text-gray-500 font-mono text-xs">[ Sin Vista Previa ]</span>
                </div>
                
                <!-- Botón de Cerrar Flotante -->
                <button id="close-modal-btn" class="absolute top-4 right-4 z-10 w-10 h-10 flex items-center justify-center rounded-xl bg-black/50 border border-white/10 text-white hover:bg-emerald-500 hover:text-gray-950 hover:border-emerald-500 transition-all duration-300 shadow-lg cursor-pointer" aria-label="Cerrar modal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Contenido Desplazable -->
            <div class="p-6 md:p-8 overflow-y-auto flex-grow space-y-6 custom-scrollbar">
                <!-- Categoría / Tags -->
                <div id="modal-project-tags" class="flex flex-wrap gap-2">
                    <!-- Se insertarán dinámicamente -->
                </div>

                <!-- Título -->
                <h3 id="modal-project-title" class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                    <!-- Se insertará dinámicamente -->
                </h3>

                <!-- Descripción -->
                <div class="prose prose-invert max-w-none">
                    <p id="modal-project-description" class="text-gray-300 text-sm md:text-base font-light leading-relaxed whitespace-pre-wrap">
                        <!-- Se insertará dinámicamente -->
                    </p>
                </div>
            </div>

            <!-- Pie de página con Enlaces -->
            <div class="p-6 border-t border-[#1b4d3e]/20 bg-[#040807]/60 flex items-center justify-between gap-4">
                <a id="modal-github-link" href="" target="_blank" rel="noopener noreferrer" class="hidden items-center gap-2 px-5 py-2.5 rounded-xl font-medium border border-[#1b4d3e]/40 text-gray-300 hover:border-emerald-400 hover:text-white hover:bg-emerald-500/5 transition-all duration-300 text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.138 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd"/></svg>
                    GitHub
                </a>
                <a id="modal-live-link" href="" target="_blank" rel="noopener noreferrer" class="hidden items-center gap-2 px-5 py-2.5 rounded-xl font-medium bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 shadow-[0_4px_15px_rgba(16,185,129,0.2)] ml-auto text-sm">
                    Live Demo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Estilos de Scrollbar Personalizada para el Modal -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(11, 60, 45, 0.05);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.2);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(16, 185, 129, 0.4);
        }
    </style>

    <!-- Lógica de Apertura y Cierre de Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('project-modal');
            const modalContent = document.getElementById('project-modal-content');
            const closeModalBtn = document.getElementById('close-modal-btn');
            
            const modalImage = document.getElementById('modal-project-image');
            const modalImageFallback = document.getElementById('modal-project-image-fallback');
            const modalTags = document.getElementById('modal-project-tags');
            const modalTitle = document.getElementById('modal-project-title');
            const modalDescription = document.getElementById('modal-project-description');
            const modalGithubLink = document.getElementById('modal-github-link');
            const modalLiveLink = document.getElementById('modal-live-link');

            // Seleccionar todas las cards
            const cards = document.querySelectorAll('[data-project-card]');

            cards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Evitar abrir modal si se hace clic en un enlace de la card
                    if (e.target.closest('a')) {
                        return;
                    }

                    const title = card.getAttribute('data-title');
                    const description = card.getAttribute('data-description');
                    const image = card.getAttribute('data-image');
                    const github = card.getAttribute('data-github');
                    const live = card.getAttribute('data-live');
                    const tags = JSON.parse(card.getAttribute('data-tags') || '[]');

                    // Poblar información
                    modalTitle.textContent = title;
                    modalDescription.textContent = description;

                    // Imagen o Fallback
                    if (image) {
                        modalImage.src = image;
                        modalImage.alt = title;
                        modalImage.classList.remove('hidden');
                        modalImageFallback.classList.add('hidden');
                    } else {
                        modalImage.classList.add('hidden');
                        modalImageFallback.classList.remove('hidden');
                    }

                    // Etiquetas
                    modalTags.innerHTML = '';
                    tags.forEach(tag => {
                        const span = document.createElement('span');
                        span.className = "text-[10px] px-2 py-0.5 rounded bg-[#0b3c2d]/40 text-emerald-300 border border-emerald-500/10 font-semibold";
                        span.textContent = tag;
                        modalTags.appendChild(span);
                    });

                    // Enlaces
                    if (github && github.trim() !== '') {
                        modalGithubLink.href = github;
                        modalGithubLink.classList.remove('hidden');
                        modalGithubLink.classList.add('inline-flex');
                    } else {
                        modalGithubLink.classList.add('hidden');
                        modalGithubLink.classList.remove('inline-flex');
                    }

                    if (live && live.trim() !== '') {
                        modalLiveLink.href = live;
                        modalLiveLink.classList.remove('hidden');
                        modalLiveLink.classList.add('inline-flex');
                    } else {
                        modalLiveLink.classList.add('hidden');
                        modalLiveLink.classList.remove('inline-flex');
                    }

                    // Mostrar Modal con animación
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                    document.body.style.overflow = 'hidden';
                });
            });

            // Cerrar Modal
            function closeModal() {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                document.body.style.overflow = '';
            }

            closeModalBtn.addEventListener('click', closeModal);

            // Cerrar al hacer clic fuera del modal
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Cerrar con Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('opacity-0')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
