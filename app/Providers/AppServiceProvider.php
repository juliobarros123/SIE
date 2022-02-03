<?php

namespace App\Providers;

use ConsoleTVs\Charts\Registrar as Charts;
use App\Models\Cabecalho;
use App\Models\TempoSessao;
use App\Models\User;
use App\Models\UnidadeMateria;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {

        
        view()->composer('*', function ($view) {
            $response['cabecalho'] = Cabecalho::orderby('id', 'desc')->first();
            $cabecalhos = $response['cabecalho'];
            $cabe = session()->get('cabecalhos', $cabecalhos);
            $cab = $cabe;
            session()->has('cabecalhos') ? session()->get('cabecalhos') : [''];
            $tempoSessao=TempoSessao::orderby('id', 'desc')->first();
       
            if(isset($tempoSessao))
            $view->with('tempoSessao', $tempoSessao);
            else{
                $view->with('tempoSessao', ''); 
            }
            $ttl_users = User::where( 'tipoUtilizador','!=', 'Administrador')->where( 'tipoUtilizador','!=', 'Desenvolvedor')->count();
            $view->with('ttl_users', $ttl_users);
            $ttl_encarregados = User::where( 'tipoUtilizador', 'Encarregado' )->count();
            $view->with('ttl_encarregados', $ttl_encarregados);
            $ttl_filhos = User::where( 'tipoUtilizador', 'Filho' )->count();
            $view->with('ttl_filhos', $ttl_filhos);
            $ttl_professores = User::where( 'tipoUtilizador', 'Professor' )->count();
            $view->with('ttl_professores', $ttl_professores);
            $educandos = User::where('tipoUtilizador','Filho')->get();
            $view->with('educandos', $educandos);
            $unidades=UnidadeMateria::all();
            $view->with('unidades', $unidades);

           $matriculas_view= DB::table('matriculas')
            ->join('users', 'users.id', 'matriculas.it_id_utilizador')
            ->join('classes', 'classes.id', 'matriculas.it_id_classe')
            ->select( 'classes.vc_classe','users.id')->get();
            $view->with('matriculas_view', $matriculas_view);
                 });

        $charts->register([
            \App\Charts\AlunoClasseChart::class,
            \App\Charts\AlunosPorProvincia::class
        ]);
    }
}