<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*return [
            'vc_nome' => $this->faker->name,
            'vc_email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];*/
     
        return [
            'nome' =>'admin',
            'primeiro_nome' =>'Admin',
            'ultimo_nome' => 'admin',
            'email' => 'incubadora@gmail.com',
            'password' => '$2y$10$Dq3BKQBfNzsSywtXEY9g6eCTI.r.Gzlh7pH7eSGwJyY5.pks6xK/O',
            'tipoUtilizador' => 'Administrador',
            'telefone' => '999999999',
            'genero' => 'Masculino',
            'profile_photo_path' => '',
            'remember_token' => Str::random(10),
            'slug'=>slug_gerar()
        ];

    }
}

