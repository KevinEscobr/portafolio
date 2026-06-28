<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear usuario administrador por defecto
        User::updateOrCreate(
            ['email' => 'admin@nennge.me'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin12345'), // Se sugiere cambiar la contraseña en el primer inicio de sesión
            ]
        );

        // Crear configuraciones por defecto
        $defaults = [
            'phone' => '+56912345678',
            'email' => 'admin@nennge.me',
            'linkedin' => 'https://linkedin.com/in/username',
            'github' => 'https://github.com/username',
            'bio' => 'Desarrollador Full Stack apasionado por las tecnologías web, el backend robusto y las experiencias visuales en 3D interactivo de alto rendimiento.',
            'hero_title' => 'Hola, Soy Desarrollador Web',
            'hero_subtitle' => 'Diseño y desarrollo experiencias digitales interactivas, desde servidores estables hasta mundos en 3D.',
        ];

        foreach ($defaults as $key => $value) {
            \App\Models\ProfileSetting::setValue($key, $value);
        }
    }
}
