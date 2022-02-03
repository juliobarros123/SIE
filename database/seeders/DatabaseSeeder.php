<?php

namespace database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Cabecalho::factory(1)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\Escola::factory(1)->create();

         // \App\Models\Aluno::factory(10)->create();
        // \App\Models\Candidatura::factory(150)->create();

         // DB::table('alunos')->insert([
         //     'nome' => Str::random(10)
         // ]);
       /*  DB::table('candidatos')->insert([
              'nome' => Str::random(10)
         ]);*/
       
        

     

    }
}
