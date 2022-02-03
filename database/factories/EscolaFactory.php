<?php

namespace Database\Factories;

use App\Models\Escola;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EscolaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Escola::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'vc_escola' => 'Sem Escola',
            'vc_logo'  => 'sem',
            'vc_num_ide' => 'sem',
            'vc_localizacao' => 'sem',
            'it_id_provincia' => '1',
            'it_id_minicipio' => '1',
            'vc_director' => 'sem',
            'vc_email' => 'sem',
            'vc_senha' => 'sem',
            'it_id_utilizador' => '1',
            'dt_data_registro' => '2021-05-28'
        ];
    }
}
