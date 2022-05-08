<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// ['as' => 'admin.listar', 'uses' => 'Admin\CandidaturaController@index']

// Route::get('/', function () {
//     return view('site.index');
// });
//Tela Inicial
Route::get('/bem-vindo', ['as' => 'sie', 'uses' => 'Site\HomeController@bemVindo']);

//Route::get('/t1   ', ['as' => , 'uses' => 'SiteController@s1']);

//Sobre
Route::get('sobre/', ['as' => 'site.sobre', 'uses' => 'Site\SobreController@index']);

//Ano de Escolaridade
Route::get('ano-de-escolaridade/', ['as' => 'site.anos-escolaridade', 'uses' => 'Site\AnoEscolaridadeController@index']);

//Horário Ensino Básico
Route::get('horarios-basico/', ['as' => 'site.horarios-basico', 'uses' => 'Site\HorarioBasicoController@index']);

//Horário
Route::get('/site/horarios', ['as' => 'site.horarios', 'uses' => 'Site\HorarioController@index']);

//Horário Ensino Secundário
Route::get('horarios-secundario/', ['as' => 'site.horarios-secundario', 'uses' => 'Site\HorarioSecundarioController@index']);

//Anos Lectivo
Route::get('anos-lectivo/', ['as' => 'site.anos-lectivo', 'uses' => 'Site\AnoLectivoController@index']);

//Manuais Escolares
Route::get('manuais-escolares/', ['as' => 'site.manuais-escolares', 'uses' => 'Site\ManuaisController@index']);

//
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'vagas/candidatos/'], function () {
        Route::get('{slug_vaga}/inscrever-se', ['as' => 'site.vagas.candidatos.inscrever-se', 'uses' => 'Site\CandidatoController@inscrever_se']);
        Route::post('{slug_vaga}/inscrever-se-agora', ['as' => 'site.vagas.candidatos.inscrever-se-agora', 'uses' => 'Site\CandidatoController@inscrever_se_agora']);
        Route::get('/minhas-vagas/{slug_candidato}', ['as' => 'admin.vagas.candidatos.minhas.vagas', 'uses' => 'Site\CandidatoController@minhas_vagas']);
        Route::get('/criar', ['as' => 'admin.vagas.criar', 'uses' => 'admin\VagaController@criar']);
        Route::post('/cadastrar', ['as' => 'admin.vagas.cadastrar', 'uses' => 'admin\VagaController@cadastrar']);
        Route::put('/actualizar/{slug}', ['as' => 'admin.vagas.actualizar', 'uses' => 'admin\VagaController@actualizar']);
        Route::get('/editar/{slug}', ['as' => 'admin.vagas.editar', 'uses' => 'admin\VagaController@editar']);
        Route::get('/eliminar/{slug}', ['as' => 'admin.vagas.eliminar', 'uses' => 'admin\VagaController@eliminar']);
        Route::get('/purgar/{slug}', ['as' => 'admin.vagas.purgar', 'uses' => 'admin\VagaController@purgar']);
      
    });
});
//site inicial inicio
Route::get('/', ['as' => 'site.site', 'uses' => 'Site\HomeController@index']);
//site inicial fim

//User-Start
// Route::get('utilizador/cadastrar  ', ['as' => 'site.users.cadastrar', 'uses' => 'Site\UserController@create']);
Route::post('site/users/salvar', ['as' => 'users.salvar', 'uses' => 'Site\UserController@salvar']);
Route::get('encarregado', function () {
    return view('site.encarregado.index');
});
Route::get('encarregado/increver-se', ['as' => 'encarregado.increver_se', 'uses' => 'Site\UserController@increver_se']);
Route::get('encarregado/registrar', ['as' => 'encarregado.registrar', 'uses' => 'Site\UserController@create']);
/* Privacidade */
Route::get('/privacidade', function () {
    return view('site.privacidade.index');
});

Route::get('/termos-de-uso-condicoes', ['as' => 'site.termos', 'uses' => 'Site\TermoController@index']);

Route::group(['prefix' => 'desafios/quizzes/'], function () {
    Route::get('escolha/disciplinas', ['as' => 'desafios.quizzes.disciplinas', 'uses' => 'Site\QuizController@disciplinas']);
    Route::post('{id_video}/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
    Route::get('escolha/{id}/niveis', ['as' => 'desafios.quizzes.niveis', 'uses' => 'Site\QuizController@nivel']);
    Route::get('escolha/{slug}/{id_c_d}/nivel_guardar', ['as' => 'desafios.quizzes.niveis.nivel_guardar', 'uses' => 'Site\QuizController@nivel_guardar']);
    Route::get('questao', ['as' => 'desafios.quizzes.questao', 'uses' => 'Site\QuizController@questao']);
    Route::get('{id_questao}/{slug_resposta}/avaliacao', ['as' => 'desafios.quizzes.questao.avaliacao', 'uses' => 'Site\QuizController@avaliacao']);
    Route::get('classificao/avaliacao', ['as' => 'desafios.quizzes.classificao', 'uses' => 'Site\QuizController@classificao']);
});

Route::group(['prefix' => 'servicos/'], function () {
    Route::get('', ['as' => 'site.servicos', 'uses' => 'Site\ServicoController@index']);
    Route::post('pesquisar', ['as' => 'site.servicos.pesquisar', 'uses' => 'Site\ServicoController@pesquisar']);
  
});
Route::group(['prefix' => 'palavra_passe'], function () {
    route::get('recuperar', ['as' => 'palavra_passe.recuperar', 'uses' => 'PalavrarPasseController@recuperar']);
    route::post('redefinir', ['as' => 'palavra_passe.redefinir', 'uses' => 'PalavrarPasseController@redefinir']);
    route::post('codigo', ['as' => 'palavra_passe.codigo', 'uses' => 'PalavrarPasseController@codigo']);
    route::post('vrf_codigo_confirme', ['as' => 'palavra_passe.vrf_codigo_confirme', 'uses' => 'PalavrarPasseController@vrf_codigo_confirme']);
    // route::post('nova_pa',['as' => 'email.vrf_codigo_confirme', 'uses' => 'PalavrarPasseController@vrf_codigo_confirme']);
    route::get('nova_palavra_passe/', ['as' => 'palavra_passe.nova_palavra_passe', 'uses' => 'PalavrarPasseController@nova_palavra_passe']);
    route::post('registar_palavra_passe/', ['as' => 'palavra_passe.registar_palavra_passe', 'uses' => 'PalavrarPasseController@registar_palavra_passe']);

    route::get('confirmar_codigo', ['as' => 'palavra_passe.confirmar_codigo', 'uses' => 'PalavrarPasseController@confirmar_codigo']);
});

Route::group(['prefix' => 'vagas'], function () {
    route::get('', ['as' => 'site.vagas', 'uses' => 'Site\VagaController@vagas']);
    route::post('pesquisar', ['as' => 'site.vagas.pesquisar', 'uses' => 'Site\VagaController@pesquisar']);
    

});

Route::group(['prefix' => 'comentarios'], function () {
    route::post('cadastrar', ['as' => 'site.comentarios.cadastrar', 'uses' => 'Site\ComentarioController@cadastrar']);

});