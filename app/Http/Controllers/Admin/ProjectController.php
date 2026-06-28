<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tags' => ['nullable', 'string', 'max:255'], // separated by commas, e.g. "Vue, PHP"
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:4096'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'order' => ['required', 'integer'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'tags' => $request->input('tags'),
            'image_path' => $imagePath,
            'github_url' => $request->input('github_url'),
            'live_url' => $request->input('live_url'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto creado correctamente.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in database.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:4096'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'order' => ['required', 'integer'],
        ]);

        $imagePath = $project->image_path;
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $project->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'tags' => $request->input('tags'),
            'image_path' => $imagePath,
            'github_url' => $request->input('github_url'),
            'live_url' => $request->input('live_url'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Remove the specified project from database.
     */
    public function destroy(Project $project)
    {
        // Eliminar imagen si existe
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto eliminado correctamente.');
    }
}
