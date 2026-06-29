<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard/profile settings.
     */
    public function index()
    {
        $settings = [
            'phone' => ProfileSetting::getValue('phone'),
            'email' => ProfileSetting::getValue('email'),
            'linkedin' => ProfileSetting::getValue('linkedin'),
            'github' => ProfileSetting::getValue('github'),
            'bio' => ProfileSetting::getValue('bio'),
            'hero_title' => ProfileSetting::getValue('hero_title'),
            'hero_subtitle' => ProfileSetting::getValue('hero_subtitle'),
            'whatsapp_message' => ProfileSetting::getValue('whatsapp_message'),
        ];

        $user = auth()->user();

        return view('admin.dashboard', compact('settings', 'user'));
    }

    /**
     * Update the profile settings and administrator details.
     */
    public function update(Request $request)
    {
        $request->validate([
            // Info de Perfil Público
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'bio' => ['nullable', 'string'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'whatsapp_message' => ['nullable', 'string', 'max:500'],
            
            // Info de Cuenta Administrativa (Privada)
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'admin_email.unique' => 'Este correo ya está registrado por otro usuario.',
        ]);

        // Guardar valores del perfil público
        ProfileSetting::setValue('phone', $request->input('phone'));
        ProfileSetting::setValue('email', $request->input('email'));
        ProfileSetting::setValue('linkedin', $request->input('linkedin'));
        ProfileSetting::setValue('github', $request->input('github'));
        ProfileSetting::setValue('bio', $request->input('bio'));
        ProfileSetting::setValue('hero_title', $request->input('hero_title'));
        ProfileSetting::setValue('hero_subtitle', $request->input('hero_subtitle'));
        ProfileSetting::setValue('whatsapp_message', $request->input('whatsapp_message'));

        // Guardar valores del usuario administrador
        $user = auth()->user();
        $user->name = $request->input('admin_name');
        $user->email = $request->input('admin_email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return back()->with('success', 'Configuración de perfil y cuenta actualizada con éxito.');
    }
}
