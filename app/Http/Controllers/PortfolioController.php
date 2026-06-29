<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProfileSetting;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Render the public portfolio page.
     */
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        // Obtener configuraciones de perfil
        $settings = [
            'phone' => ProfileSetting::getValue('phone', '+56912345678'),
            'email' => ProfileSetting::getValue('email', 'admin@nennge.me'),
            'linkedin' => ProfileSetting::getValue('linkedin', '#'),
            'github' => ProfileSetting::getValue('github', '#'),
            'bio' => ProfileSetting::getValue('bio', 'Hola, soy desarrollador fullstack.'),
            'hero_title' => ProfileSetting::getValue('hero_title', 'Hola, Soy Desarrollador Web'),
            'hero_subtitle' => ProfileSetting::getValue('hero_subtitle', 'Diseño y desarrollo experiencias digitales interactivas.'),
            'whatsapp_message' => ProfileSetting::getValue('whatsapp_message', '¡Hola! Me gustaría contactarme contigo.'),
        ];

        return view('portfolio', compact('projects', 'settings'));
    }
}
