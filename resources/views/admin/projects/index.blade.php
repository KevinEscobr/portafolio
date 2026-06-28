@extends('layouts.dashboard')

@section('header_title', 'Gestión de Proyectos')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white">Listado de Proyectos</h3>
        <a href="{{ route('admin.projects.create') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-emerald-500 to-teal-500 text-gray-950 hover:from-emerald-400 hover:to-teal-400 transition-all duration-300 shadow-md shadow-emerald-500/10">
            + Nuevo Proyecto
        </a>
    </div>

    <div class="bg-[#050c09] border border-[#1b4d3e]/20 rounded-2xl overflow-hidden">
        @if($projects->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0.621 0 1.125.504 1.125 1.125z"/></svg>
                <p class="text-sm">No has agregado ningún proyecto todavía.</p>
                <a href="{{ route('admin.projects.create') }}" class="text-xs text-emerald-400 hover:text-emerald-300 mt-2 inline-block">Crea tu primer proyecto ahora</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-[#040807] text-gray-400 uppercase tracking-widest text-[10px] font-semibold border-b border-[#1b4d3e]/20">
                        <tr>
                            <th class="px-6 py-4">Imagen</th>
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Tags</th>
                            <th class="px-6 py-4 text-center">Orden</th>
                            <th class="px-6 py-4">Enlaces</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1b4d3e]/10">
                        @foreach($projects as $project)
                            <tr class="hover:bg-[#0b3c2d]/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-16 aspect-video rounded-lg overflow-hidden bg-emerald-950/20 border border-[#1b4d3e]/30">
                                        @if($project->image_path)
                                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="Preview" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-600 font-mono">N/A</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-white">
                                    {{ $project->title }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($project->tags)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($project->tags_array as $tag)
                                                <span class="text-[10px] px-2 py-0.5 rounded bg-[#0b3c2d]/30 text-emerald-300 border border-emerald-500/10">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-emerald-400 font-mono font-medium">
                                    {{ $project->order }}
                                </td>
                                <td class="px-6 py-4 text-xs space-y-1">
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="block text-gray-400 hover:text-white transition-colors">GitHub &nearr;</a>
                                    @endif
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" target="_blank" class="block text-emerald-400 hover:text-emerald-300 transition-colors">Demo &nearr;</a>
                                    @endif
                                    @if(!$project->github_url && !$project->live_url)
                                        <span class="text-gray-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-gray-400 hover:text-emerald-400 transition-colors font-medium text-xs">
                                            Editar
                                        </a>
                                        
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors font-medium text-xs">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
