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
 *///Tarefas_Submetidas/cadastrar

/*Route::get('/', ['as' => 'raiz', 'uses' => 'Admin\HomeController@raiz']);*/
//Route::get('/tt', ['as' => 't1', 'uses' => 'Admin\NotificacaoController@notificacarMateria']);

//

Route::get('{id_educando}/disciplinas', ['as' => 'encarregado.educando.disciplinas', 'uses' => 'Ajax\MateriaFilhoEducandoController@disciplinas']);
Route::get('getUnidades', ['as' => 'encarregado.educando.materia.getUnidades', 'uses' => 'Ajax\MateriaFilhoEducandoController@getUnidades']);

Route::group(['prefix' => 'quizz'], function () {
    Route::get('disciplinas', ['as' => 'quizz.disciplinas', 'uses' => 'Site\QuizController@listarDisciplnas']);
    Route::get('{id_disciplina}/tema', ['as' => 'quizz.tema', 'uses' => 'Site\QuizController@escolherTemaDeQuiz']);
    Route::get('{id_tema}/iniciarJogo', ['as' => 'quizz.iniciarJogo', 'uses' => 'Site\QuizController@iniciarJogo']);
    Route::get('{id_afirmacao}/{id_pergunta_quizzes}/verificarResposta', ['as' => 'quizz.verificarResposta', 'uses' => 'Site\QuizController@verificarResposta']);
    Route::get('{id_proximaPergunta}/proximaPergunta', ['as' => 'quizz.proximaPergunta', 'uses' => 'Site\QuizController@proximaPergunta']);
    Route::get('classificacao', ['as' => 'quizz.classificacao', 'uses' => 'Site\QuizController@classificacao']);
    Route::get('{id_pergunta}/proxima', ['as' => 'quizz.proxima', 'uses' => 'Site\QuizController@proxima']);
});

Route::group(['prefix' => 'quizz/jogadores'], function () {
    Route::get('', ['as' => 'jogadores', 'uses' => 'Site\JogadorController@criar']);
    Route::get('criar', ['as' => 'jogadores.criar', 'uses' => 'Site\JogadorController@criar']);
    Route::post('cadastrar', ['as' => 'jogadores.cadastrar', 'uses' => 'Site\JogadorController@cadastrar']);
    Route::get('{id}/eliminar', ['as' => 'jogadores.eliminar', 'uses' => 'Site\JogadorController@eliminar']);
    Route::get('{id}/editar', ['as' => 'jogadores.editar', 'uses' => 'Site\JogadorController@editar']);
    Route::put('{id}/actualizar', ['as' => 'jogadores.actualizar', 'uses' => 'Site\JogadorController@actualizar']);
});

Route::post('/correspondencia', ['as' => 'correspondencia', 'uses' => 'Email\CorrespondenciaXilongaController@enviar']);
Route::get('/enviar_email', ['as' => 'enviar_email', 'uses' => 'Email\CorrespondenciaXilongaController@trazerFormulario']);

//['as' => 'home', 'uses' => 'Admin\HomeController@raiz']

Route::get('/tt', ['as' => 'verNotificacao', 'uses' => 'Admin\NotificacaoController@verNotificacoes']);
//Route::get('/tt', ['as' => 'verNotificacao', 'uses' => 'Admin\NotificacaoController@tt']);
//User-Start SITE
Route::get('/painel', ['as' => 'home', 'uses' => 'Admin\HomeController@painel']);
Route::get('users/cadastrar', ['as' => 'encarregado', 'uses' => 'Site\UserController@create']);
Route::get('encarregado/{id}/verMateria/', ['as' => 'encarregado.verMateria', 'uses' => 'Admin\EncarregadoController@verMateria']);
Route::get('encarregado/{id}/verTarefa/', ['as' => 'encarregado.verTarefa', 'uses' => 'Admin\EncarregadoController@verTarefa']);
Route::get('encarregado/buscar-usuario/{usuario}', ['as' => 'encarregado.buscarUsuario', 'uses' => 'Site\UserController@buscaUsuario']);
Route::get('admin/buscar-usuario/{usuario}', ['as' => 'admin.buscarUsuario', 'uses' => 'Admin\UserController@buscaUsuario']);

Route::post('users/salvar', ['as' => 'encarregado.salvar', 'uses' => 'Site\UserController@salvar']);
// Route::get('admin/users/cadastrar', ['as' => 'admin.users.cadastrar', 'uses' => 'Admin\UserController@create']);
//User-End SITE

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'admin/'], function () {
        Route::group(['prefix' => 'utilizadores/'], function () {

            Route::get('', ['as' => 'admin.utilizadores', 'uses' => 'Admin\UserController@index'])->middleware('access.controll.administrador');
            Route::get('admin/users/listar/imprimir', ['as' => 'admin.users.listar.imprimir', 'uses' => 'Admin\UserController@imprimir_lista'])->middleware('access.controll.administrador');
            Route::post('salvar', ['as' => 'admin.utilizadores.salvar', 'uses' => 'Admin\UserController@salvar'])->middleware('access.controll.administrador');
            Route::get('cadastrar', ['as' => 'admin.utilizadores.cadastrar', 'uses' => 'Admin\UserController@create'])->middleware('access.controll.administrador');
            Route::get('excluir/{id}', ['as' => 'admin.utilizadores.excluir', 'uses' => 'Admin\UserController@excluir'])->middleware('access.controll.administrador');
            Route::put('atualizar/{slug}', ['as' => 'admin.utilizadores.atualizar', 'uses' => 'Admin\UserController@atualizar'])->middleware('access.controll.administrador');
            // Route::put('atualizar2/{id}/{campo}/{valor}', ['as' => 'admin.utilizadores.atualizar2', 'uses' => 'Admin\UserController@atualizar2'])->middleware('access.controll.administrador');
            Route::get('ver/{id}', ['as' => 'utilizadores', 'uses' => 'Admin\UserController@ver'])->middleware('access.controll.administrador');
            Route::get('editar/{slug}', ['as' => 'admin.utilizadores.editar', 'uses' => 'Admin\UserController@editar'])->middleware('access.controll.administrador');
            Route::get('eliminar/{slug}', ['as' => 'admin.utilizadores.eliminar', 'uses' => 'Admin\UserController@eliminar'])->middleware('access.controll.administrador');
        });

        Route::group(['prefix' => 'empresas/'], function () {

            Route::get('', ['as' => 'admin.empresas', 'uses' => 'Admin\EmpresaController@index'])->middleware('access.controll.administrador');
            Route::post('cadastrar', ['as' => 'admin.empresas.cadastrar', 'uses' => 'Admin\EmpresaController@cadastrar'])->middleware('access.controll.administrador');
            Route::get('admin/users/listar/imprimir', ['as' => 'admin.users.listar.imprimir', 'uses' => 'Admin\EmpresaController@imprimir_lista'])->middleware('access.controll.administrador');
            // Route::post('salvar', ['as' => 'admin.empresas.salvar', 'uses' => 'Admin\EmpresaController@salvar'])->middleware('access.controll.administrador');

            Route::get('excluir/{id}', ['as' => 'admin.empresas.excluir', 'uses' => 'Admin\EmpresaController@excluir'])->middleware('access.controll.administrador');
            Route::put('atualizar/{id}', ['as' => 'admin.empresas.atualizar', 'uses' => 'Admin\EmpresaController@atualizar'])->middleware('access.controll.administrador');
            Route::put('atualizar2/{id}/{campo}/{valor}', ['as' => 'admin.empresas.atualizar2', 'uses' => 'Admin\EmpresaController@atualizar2'])->middleware('access.controll.administrador');
            Route::get('ver/{id}', ['as' => 'empresas', 'uses' => 'Admin\EmpresaController@ver'])->middleware('access.controll.administrador');

            Route::get('eliminar/{slug}', ['as' => 'admin.empresas.eliminar', 'uses' => 'Admin\EmpresaController@eliminar'])->middleware('access.controll.administrador');
            Route::get('editar/{slug}', ['as' => 'admin.empresas.editar', 'uses' => 'Admin\EmpresaController@editar'])->middleware('access.controll.administrador');
            Route::put('atualizar/{slug}', ['as' => 'admin.empresas.atualizar', 'uses' => 'Admin\EmpresaController@atualizar'])->middleware('access.controll.administrador');

        });

        Route::group(['prefix' => 'vagas/'], function () {
            Route::get('/', ['as' => 'admin.vagas', 'uses' => 'Admin\VagaController@index']);
            Route::get('/criar', ['as' => 'admin.vagas.criar', 'uses' => 'Admin\VagaController@criar']);
            Route::post('/cadastrar', ['as' => 'admin.vagas.cadastrar', 'uses' => 'Admin\VagaController@cadastrar']);
            Route::put('/actualizar/{slug}', ['as' => 'admin.vagas.actualizar', 'uses' => 'Admin\VagaController@actualizar']);
            Route::get('/editar/{slug}', ['as' => 'admin.vagas.editar', 'uses' => 'Admin\VagaController@editar']);
            Route::get('/eliminar/{slug}', ['as' => 'admin.vagas.eliminar', 'uses' => 'Admin\VagaController@eliminar']);
            Route::get('/purgar/{slug}', ['as' => 'admin.vagas.purgar', 'uses' => 'Admin\VagaController@purgar']);

            Route::group(['prefix' => 'candidatos/'], function () {
                Route::get('/{slug_vaga}', ['as' => 'admin.vagas.candidatos', 'uses' => 'Admin\CandidatoController@index']);
                Route::get('/{slug_candidato}/aprovar', ['as' => 'admin.vagas.candidatos.aprovar', 'uses' => 'Admin\CandidatoController@aprovar']);
                Route::get('/{slug_candidato}/reprovar', ['as' => 'admin.vagas.candidatos.reprovar', 'uses' => 'Admin\CandidatoController@reprovar']);
                // Route::get('/criar', ['as' => 'admin.vagas.criar', 'uses' => 'admin\VagaController@criar']);
                // Route::post('/cadastrar', ['as' => 'admin.vagas.cadastrar', 'uses' => 'admin\VagaController@cadastrar']);
                // Route::put('/actualizar/{slug}', ['as' => 'admin.vagas.actualizar', 'uses' => 'admin\VagaController@actualizar']);
                // Route::get('/editar/{slug}', ['as' => 'admin.vagas.editar', 'uses' => 'admin\VagaController@editar']);
                // Route::get('/eliminar/{slug}', ['as' => 'admin.vagas.eliminar', 'uses' => 'admin\VagaController@eliminar']);
                // Route::get('/purgar/{slug}', ['as' => 'admin.vagas.purgar', 'uses' => 'admin\VagaController@purgar']);

            });
        });

        Route::group(['prefix' => 'retatorios'], function () {

            Route::group(['prefix' => 'empresas'], function () {
                Route::group(['prefix' => 'vagas'], function () {
                    Route::get('gerar/', ['as' => 'admin.retatorios.empresas.vagas.gerar', 'uses' => 'Admin\RelatorioEmpresaController@gerar'])->middleware('access.controll.administrador');
                    Route::post('relatorio', ['as' => 'admin.empresas.retatorios.vagas.relatorio', 'uses' => 'Admin\RelatorioEmpresaController@relatorio'])->middleware('access.controll.administrador');
                });
            });

            Route::group(['prefix' => 'candidatos'], function () {
                Route::group(['prefix' => 'vagas'], function () {
                    Route::get('gerar/', ['as' => 'admin.retatorios.candidatos.vagas.gerar', 'uses' => 'Admin\relatorios\RelatorioCandidatoVaga@gerar'])->middleware('access.controll.administrador');
                    Route::post('relatorio', ['as' => 'admin.retatorios.candidatos.vagas.relatorio', 'uses' => 'Admin\relatorios\RelatorioCandidatoVaga@relatorio'])->middleware('access.controll.administrador');
                });
            });
        });

    });

    // Horario de Estudo editar
    Route::get('admin/horario-de-estudo/cadastrar', ['as' => 'admin.HorarioDeEstudo.cadastrar', 'uses' => 'Admin\HorarioDeEstudoController@Cadastrar']);
    Route::post('admin/horario-de-estudo/store', ['as' => 'admin.HorarioDeEstudo.store', 'uses' => 'Admin\HorarioDeEstudoController@store']);
    Route::get('admin/horario-de-estudo/listar', ['as' => 'admin.HorarioDeEstudo.listar', 'uses' => 'Admin\HorarioDeEstudoController@listar']);
    Route::get('admin/horario-de-estudo/{id}/delete', ['as' => 'admin.HorarioDeEstudo.delete', 'uses' => 'Admin\HorarioDeEstudoController@delete']);
    Route::post('admin/horario-de-estudo/{id}/update', ['as' => 'admin.HorarioDeEstudo.update', 'uses' => 'Admin\HorarioDeEstudoController@update']);
    Route::get('admin/horario-de-estudo/{id}/editar', ['as' => 'admin.HorarioDeEstudo.editar', 'uses' => 'Admin\HorarioDeEstudoController@editar']);

    //

    //Garabrito
    Route::group(['prefix' => 'gabarito/'], function () {
        Route::get('{id_tarefa}', ['as' => 'gabarito', 'uses' => 'Admin\GabaritoController@show']);
        Route::get('{id_tarefa}/cadastrar', ['as' => 'gabarito.criar', 'uses' => 'Admin\GabaritoController@criar'])->middleware('access.controll.administrador');
        Route::post('{id}/store', ['as' => 'gabarito.store', 'uses' => 'Admin\GabaritoController@store'])->middleware('access.controll.administrador');
        Route::get('{id}/delete', ['as' => 'gabarito.delete', 'uses' => 'Admin\GabaritoController@delete'])->middleware('access.controll.administrador');
        Route::get('{id}/editar', ['as' => 'gabarito.editar', 'uses' => 'Admin\GabaritoController@editar'])->middleware('access.controll.administrador');
        Route::post('{id}/update', ['as' => 'gabarito.update', 'uses' => 'Admin\GabaritoController@update'])->middleware('access.controll.administrador');

    });

    //Início Escola
    Route::group(['prefix' => 'escolas/', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'escolas', 'uses' => 'Admin\EscolaController@listar']);
        Route::get('criar', ['as' => 'escolas.criar', 'uses' => 'Admin\EscolaController@criar']);
        Route::post('{id_user}/cadastrar', ['as' => 'escolas.cadastrar', 'uses' => 'Admin\EscolaController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'escolas.eliminar', 'uses' => 'Admin\EscolaController@eliminar']);
        Route::get('{id}/editar', ['as' => 'escolas.editar', 'uses' => 'Admin\EscolaController@editar']);
        Route::put('{id}/{id_user}/actualizar', ['as' => 'escolas.actualizar', 'uses' => 'Admin\EscolaController@actualizar']);
    });
    //Fim escola

    Route::get('/users/escrever', ['as' => 'user.escrever', 'uses' => 'Admin\UserController@escrever'])->middleware('access.controll.encarregado');
    Route::post('{id_user}/users/escreverFilho', ['as' => 'users.escreverFilho', 'uses' => 'Admin\UserController@escreverFilho'])->middleware('access.controll.encarregado');
    Route::get('admin/users/ver/{id}', ['as' => 'users', 'uses' => 'Admin\UserController@ver'])->middleware('access.controll.encarregado');

    Route::get('{id}/filhos/', ['as' => 'user.filhos', 'uses' => 'Admin\UserController@filhos'])->middleware('access.controll.encarregado');
    Route::get('filhos/{id}/editar/', ['as' => 'filhos.editar', 'uses' => 'Admin\FilhoController@editar']);
    Route::put('filhos/{id}/atualizar/', ['as' => 'filhos.atualizar', 'uses' => 'Admin\FilhoController@atualizar'])->middleware('access.controll.encarregado');
    Route::get('meus_filhos/', ['as' => 'user.meus_filhos', 'uses' => 'Admin\UserController@meus_filhos'])->middleware('access.controll.encarregado');
    Route::get('educandos/', ['as' => 'user.educandos', 'uses' => 'Admin\UserController@educandos'])->middleware('access.controll.encarregado');
    Route::group(['prefix' => 'classes', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'classes', 'uses' => 'Admin\ClasseController@listar']);
        Route::get('criar', ['as' => 'classes.criar', 'uses' => 'Admin\ClasseController@criar']);
        Route::post('cadastrar', ['as' => 'classes.cadastrar', 'uses' => 'Admin\ClasseController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'classes.eliminar', 'uses' => 'Admin\ClasseController@eliminar']);
        Route::get('{id}/editar', ['as' => 'classes.editar', 'uses' => 'Admin\ClasseController@editar']);
        Route::put('{id}/actualizar', ['as' => 'classes.actualizar', 'uses' => 'Admin\ClasseController@actualizar']);
    });

    Route::group(['prefix' => 'Relatórios', 'namespace' => 'Admin\relatorios'], function () {
        Route::post('ListaAlunosPorClasse', ['as' => 'listar_alunos_classe', 'uses' => 'RelatorioAlunoController@listarAlunoClasse']);
        Route::get('VerAlunosPorEscola', ['as' => 'ver_alunos_escola', 'uses' => 'RelatorioAlunoController@paginaRelatorioAlunoEscola']);
        Route::post('ListaAlunosPorEscola', ['as' => 'listar_alunos_escola', 'uses' => 'RelatorioAlunoController@listarAlunoEscola']);
        Route::get('ListaAlunosPorEscola2/{p1}/{p2}/{p3}/{p4}/{p5}', ['as' => 'listar_alunos_escola2', 'uses' => 'RelatorioAlunoController@listarAlunoEscola2']);
        Route::get('ListaAlunosPorClasse2/{p1}/{p2}/{p3}/{p4}/{p5}', ['as' => 'listar_alunos_classe2', 'uses' => 'RelatorioAlunoController@listarAlunoClasse2']);
        //Route::get('ListaAlunosPorClasse2/{p1}', ['as' => 'listar_alunos_classe2', 'uses' => 'RelatorioAlunoController@listarAlunoClasse2']);
        Route::get('ImpreençãoAlunosPorClasse/{it_id_ano}/{it_id_escola}/{texto_ano}/{texto_escola}', ['as' => 'imprimir_alunos_classe', 'uses' => 'RelatorioAlunoController@imprimirAlunoClasse']);
        Route::get('ImpreençãoAlunosPorEscola/{it_id_ano}/{it_id_escola}/{texto_ano}/{texto_escola}', ['as' => 'imprimir_alunos_escola', 'uses' => 'RelatorioAlunoController@imprimirAlunoEscola']);
        Route::get('VerAlunoPorClasse', ['as' => 'ver_quantidade_alunos_classe', 'uses' => 'RelatorioAlunoController@verAlunosClasse']);

        ////
        Route::get('VerAlunosPorProvincia', ['as' => 'ver_alunos_provincia', 'uses' => 'RelatorioAlunoController@paginaRelatorioAlunoProvincia']);
        Route::post('ListaAlunosPorProvincia', ['as' => 'listar_alunos_provincia', 'uses' => 'RelatorioAlunoController@listarAlunoProvincia']);
        Route::get('ListaAlunosPorProvincia2/{p1}/{p2}', ['as' => 'listar_alunos_provincia2', 'uses' => 'RelatorioAlunoController@listarAlunoProvincia2']);
        Route::get('ImpreençãoAlunosPorProvincia/{it_id_ano}/{it_id_provincia}', ['as' => 'imprimir_alunos_provincia', 'uses' => 'RelatorioAlunoController@imprimirAlunoProvincia']);

        ////

        Route::post('ListaTarefasSumbmetidas', ['as' => 'listar_tarefas_submetidas', 'uses' => 'TarefasSubmetidasController@listarTarefasSubmetidas']);
        Route::get('ListaTarefasSumbmetidas2/{p1}/{p2}/{p3}/{p4}', ['as' => 'listar_tarefas_submetidas2', 'uses' => 'TarefasSubmetidasController@listarTarefasSubmetidas2']);
        Route::get('ImpreençãoTarefasSumbmetidas/{it_id_ano}/{it_id_classeDisciplina}/{texto_ano}', ['as' => 'imprimir_tarefas_submetidas', 'uses' => 'TarefasSubmetidasController@imprimirTarefasSubmetidas']);
        Route::get('TarefasSumbmetidas', ['as' => 'ver_quantidade_tarefas_submetidas', 'uses' => 'TarefasSubmetidasController@quantidadeTarefasSubmetidas']);
    });

    Route::group(['prefix' => 'classes', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'classes', 'uses' => 'Admin\ClasseController@listar']);
        Route::get('criar', ['as' => 'classes.criar', 'uses' => 'Admin\ClasseController@criar']);
        Route::post('cadastrar', ['as' => 'classes.cadastrar', 'uses' => 'Admin\ClasseController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'classes.eliminar', 'uses' => 'Admin\ClasseController@eliminar']);
        Route::get('{id}/editar', ['as' => 'classes.editar', 'uses' => 'Admin\ClasseController@editar']);
        Route::put('{id}/actualizar', ['as' => 'classes.actualizar', 'uses' => 'Admin\ClasseController@actualizar']);
    });

    Route::group(['prefix' => 'tarefas'], function () {
        Route::get('', ['as' => 'tarefas', 'uses' => 'Admin\TarefaController@listar'])->middleware('access.controll.professor');
        Route::post('pesquisar', ['as' => 'tarefas.pesquisar', 'uses' => 'Admin\TarefaController@pesquisar']);
        Route::get('pesquisar2/{ano}/{classe}', ['as' => 'tarefas.pesquisar2', 'uses' => 'Admin\TarefaController@pesquisar2']);
        Route::get('criar', ['as' => 'tarefas.criar', 'uses' => 'Admin\TarefaController@criar'])->middleware('access.controll.administrador');
        Route::post('cadastrar', ['as' => 'tarefas.cadastrar', 'uses' => 'Admin\TarefaController@cadastrar'])->middleware('access.controll.administrador');
        Route::get('{id}/eliminar', ['as' => 'tarefas.eliminar', 'uses' => 'Admin\TarefaController@eliminar'])->middleware('access.controll.administrador');
        Route::get('{id}/editar', ['as' => 'tarefas.editar', 'uses' => 'Admin\TarefaController@editar'])->middleware('access.controll.administrador');
        Route::put('{id}/actualizar', ['as' => 'tarefas.actualizar', 'uses' => 'Admin\TarefaController@actualizar'])->middleware('access.controll.administrador');
        Route::get('{id}/respostas', ['as' => 'tarefas.respostas', 'uses' => 'Admin\TarefaController@respostas'])->middleware('access.controll.professor');
    });

    Route::group(['prefix' => 'alunos'], function () {
        Route::get('{id_classe_disciplina}/minhaTarefa', ['as' => 'alunos.minhaTarefa', 'uses' => 'Admin\TarefaController@minhaTarefa'])->middleware('access.controll.Aluno');
        Route::get('criar', ['as' => 'tarefas.criar', 'uses' => 'Admin\TarefaController@criar'])->middleware('access.controll.administrador');
        Route::post('cadastrar', ['as' => 'tarefas.cadastrar', 'uses' => 'Admin\TarefaController@cadastrar'])->middleware('access.controll.administrador');
        Route::get('{id}/eliminar', ['as' => 'tarefas.eliminar', 'uses' => 'Admin\TarefaController@eliminar'])->middleware('access.controll.administrador');
        Route::get('{id}/editar', ['as' => 'tarefas.editar', 'uses' => 'Admin\TarefaController@editar'])->middleware('access.controll.administrador');
        Route::put('{id}/actualizar', ['as' => 'tarefas.actualizar', 'uses' => 'Admin\TarefaController@actualizar'])->middleware('access.controll.administrador');
        Route::get('{id}/respostas', ['as' => 'tarefas.respostas', 'uses' => 'Admin\TarefaController@respostas']);
    });

    Route::group(['prefix' => 'classesDisciplinas', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'classesDisciplinas', 'uses' => 'Admin\ClasseDisciplinaController@listar']);
        Route::get('{id}/criar', ['as' => 'classesDisciplinas.criar', 'uses' => 'Admin\ClasseDisciplinaController@criar']);
        Route::post('cadastrar', ['as' => 'classesDisciplinas.cadastrar', 'uses' => 'Admin\ClasseDisciplinaController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'classesDisciplinas.eliminar', 'uses' => 'Admin\ClasseDisciplinaController@eliminar']);
        Route::get('{id}/editar', ['as' => 'classesDisciplinas.editar', 'uses' => 'Admin\ClasseDisciplinaController@editar']);
        Route::get('{id}/classeDisciplinas', ['as' => 'classesDisciplinas.classeDisciplinas', 'uses' => 'Admin\ClasseDisciplinaController@classeDisciplinas']);
        Route::put('{id}/actualizar', ['as' => 'classesDisciplinas.actualizar', 'uses' => 'Admin\ClasseDisciplinaController@actualizar']);
    });
    Route::group(['prefix' => 'disciplinas', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'disciplinas', 'uses' => 'Admin\DisciplinaController@listar']);
        Route::get('criar', ['as' => 'disciplinas.criar', 'uses' => 'Admin\DisciplinaController@criar']);
        Route::post('cadastrar', ['as' => 'disciplinas.cadastrar', 'uses' => 'Admin\DisciplinaController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'disciplinas.eliminar', 'uses' => 'Admin\DisciplinaController@eliminar']);
        Route::get('{id}/editar', ['as' => 'disciplinas.editar', 'uses' => 'Admin\DisciplinaController@editar']);
        Route::put('{id}/actualizar', ['as' => 'disciplinas.actualizar', 'uses' => 'Admin\DisciplinaController@actualizar']);
    });

    Route::group(['prefix' => 'unidades', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'unidades', 'uses' => 'Admin\UnidadeMateriaController@index']);
        Route::get('criar', ['as' => 'unidades.criar', 'uses' => 'Admin\UnidadeMateriaController@criar']);
        Route::post('cadastrar', ['as' => 'unidades.cadastrar', 'uses' => 'Admin\UnidadeMateriaController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'unidades.eliminar', 'uses' => 'Admin\UnidadeMateriaController@eliminar']);
        Route::get('{id}/editar', ['as' => 'unidades.editar', 'uses' => 'Admin\UnidadeMateriaController@editar']);
        Route::put('{id}/actualizar', ['as' => 'unidades.actualizar', 'uses' => 'Admin\UnidadeMateriaController@actualizar']);
    });

    Route::group(['prefix' => 'termos', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'termos', 'uses' => 'Admin\TermoController@index']);
        Route::get('criar', ['as' => 'termos.criar', 'uses' => 'Admin\TermoController@criar']);
        Route::post('cadastrar', ['as' => 'termos.cadastrar', 'uses' => 'Admin\TermoController@cadastrar']);
        Route::get('{id}/eliminar', ['as' => 'termos.eliminar', 'uses' => 'Admin\TermoController@eliminar']);
        Route::get('{id}/editar', ['as' => 'termos.editar', 'uses' => 'Admin\TermoController@editar']);
        Route::put('{id}/actualizar', ['as' => 'termos.actualizar', 'uses' => 'Admin\TermoController@actualizar']);
    });

    // Start Ano Lectivo
    Route::get('/admin/anolectivo', ['as' => 'admin/anolectivo', 'uses' => 'Admin\AnoLectivoController@index'])->middleware('access.controll.administrador');
    Route::get('/admin/anolectivo/cadastrar', ['as' => 'admin/anolectivo/cadastrar', 'uses' => 'Admin\AnoLectivoController@create'])->middleware('access.controll.administrador');
    Route::get('/admin/anolectivo/corrente/{id}', ['as' => 'admin/anolectivo/corrente', 'uses' => 'Admin\AnoLectivoController@definirAnoCorrente'])->middleware('access.controll.administrador');
    Route::post('/admin/anolectivo/cadastrar', ['as' => 'admin/anolectivo/cadastrar', 'uses' => 'Admin\AnoLectivoController@store'])->middleware('access.controll.administrador');
    Route::get('/admin/anolectivo/visualizar/{id}', ['as' => 'admin/anolectivo/visualizar', 'uses' => 'Admin\AnoLectivoController@show'])->middleware('access.controll.administrador');
    Route::get('/admin/anolectivo/aditar/{id}', ['as' => 'admin/anolectivo/editar', 'uses' => 'Admin\AnoLectivoController@edit'])->middleware('access.controll.administrador');
    Route::put('/admin/anolectivo/editar/{id}', ['as' => 'admin/anolectivo/atualizar', 'uses' => 'Admin\AnoLectivoController@update'])->middleware('access.controll.administrador');
    Route::get('/admin/anolectivo/eliminar/{id}', ['as' => 'admin/anolectivo/eliminar', 'uses' => 'Admin\AnoLectivoController@destroy'])->middleware('access.controll.administrador');
    // End Ano Lectivo

    //Matrícula start
    //Início search Escola
    Route::get('buscar/escolas', ['as' => 'buscar.escolas.searchSchool', 'uses' => 'Admin\DynamicSearchController@searchSchool']);
    //FIM search Escola

    //Início search Classe
    Route::get('buscar/classes', ['as' => 'buscar.classes.searchGrade', 'uses' => 'Admin\DynamicSearchController@searchGrade']);
    //FIM search Classe

    //Início search Classe
    Route::get('buscar/anoletivo', ['as' => 'buscar.classes.searchYear', 'uses' => 'Admin\DynamicSearchController@searchYear']);
    //FIM search Classe

    //Início search Classe
    Route::get('/buscar/diasSemana', ['as' => 'buscar.diasSemana.searchDaysOfTheWeek', 'uses' => 'Admin\DynamicSearchController@searchDaysOfTheWeek']);
    //FIM search Classe

    route::get('matricula', ['as' => 'matricula.index', 'uses' => 'Admin\MatriculaController@index'])->middleware('access.controll.encarregado');
    route::get('{id_user}/matricula/criar', ['as' => 'matricula.create', 'uses' => 'Admin\MatriculaController@create'])->middleware('access.controll.encarregado');
    route::post('/matricula/cadastrar', ['as' => 'matricula.store', 'uses' => 'Admin\MatriculaController@store'])->middleware('access.controll.encarregado');
    route::post('/matricula/cadastrar_demo', ['as' => 'matricula.store_demo', 'uses' => 'Admin\MatriculaController@store_demo'])->middleware('access.controll.encarregado');
    route::post('/matricula/listar', ['as' => 'matricula.listar', 'uses' => 'Admin\MatriculaController@listar'])->middleware('access.controll.encarregado');
    route::get('/matricula/listar3/{p1}/{p2}', ['as' => 'matricula.listar3', 'uses' => 'Admin\MatriculaController@listar2'])->middleware('access.controll.encarregado');
    route::get('/matricula/listar2/{ano}/{class2}', ['as' => 'matricula.listar2', 'uses' => 'Admin\MatriculaController@listar2'])->middleware('access.controll.encarregado');
    route::get('/matricula/editar/{id}', ['as' => 'matricula.edit', 'uses' => 'Admin\MatriculaController@Edit'])->middleware('access.controll.encarregado');
    route::put('/matricula/actualizar/{id}', ['as' => 'matricula.update', 'uses' => 'Admin\MatriculaController@update'])->middleware('access.controll.encarregado');
    route::get('/matricula/eliminar/{id}', ['as' => 'matricula.delete', 'uses' => 'Admin\MatriculaController@delete'])->middleware('access.controll.encarregado');
    Route::get('/matricula/{id}/verClasse', ['as' => 'matricula.verClasse', 'uses' => 'Admin\MatriculaController@verClasse']);
    Route::post('/matricula/mudarClasse/classe/{id}/{classe}/', ['as' => 'matricula.mudarClasse', 'uses' => 'Admin\MatriculaController@mudarClasse']);
    //Matrícula end

    // //Tarefas Submetidas start
    // route::get('/Tarefas_Submetidas/{id_user}', ['as' => 'Tarefas_Submetidas.index', 'uses' => 'Admin\TarefasSubmetidasController@index'])->middleware('access.controll.administrador');
    // route::get('{id}/Tarefas_Submetidas/submeter', ['as' => 'Tarefas_Submetidas.submeter', 'uses' => 'Admin\TarefasSubmetidasController@submeter'])->middleware('access.controll.Aluno');
    // route::post('{id}/{id_user}/Tarefas_Submetidas/cadastrar', ['as' => 'Tarefas_Submetidas.cadastrar', 'uses' => 'Admin\TarefasSubmetidasController@cadastrar'])->middleware('access.controll.Aluno');
    // route::get('/Tarefas_Submetidas/editar/{id}', ['as' => 'Tarefas_Submetidas.edit', 'uses' => 'Admin\TarefasSubmetidasController@Edit'])->middleware('access.controll.Aluno');
    // route::put('/Tarefas_Submetidas/actualizar/{id}', ['as' => 'Tarefas_Submetidas.update', 'uses' => 'Admin\TarefasSubmetidasController@update'])->middleware('access.controll.Aluno');
    // route::get('/Tarefas_Submetidas/eliminar/{id}', ['as' => 'Tarefas_Submetidas.delete', 'uses' => 'Admin\TarefasSubmetidasController@delete'])->middleware('access.controll.Aluno');
    // //Tarefas Submetidas end
    //Tarefas Submetidas start
    route::get('/Tarefas_Submetidas', ['as' => 'Tarefas_Submetidas.index', 'uses' => 'Admin\TarefasSubmetidasController@index']);
    route::get('{id}/Tarefas_Submetidas/submeter', ['as' => 'Tarefas_Submetidas.submeter', 'uses' => 'Admin\TarefasSubmetidasController@submeter']);
    route::post('{id}/{id_user}/Tarefas_Submetidas/cadastrar', ['as' => 'Tarefas_Submetidas.cadastrar', 'uses' => 'Admin\TarefasSubmetidasController@cadastrar']);
    route::get('/Tarefas_Submetidas/editar/{id}', ['as' => 'Tarefas_Submetidas.edit', 'uses' => 'Admin\TarefasSubmetidasController@Edit']);
    route::put('/Tarefas_Submetidas/actualizar/{id}', ['as' => 'Tarefas_Submetidas.update', 'uses' => 'Admin\TarefasSubmetidasController@update']);
    route::get('/Tarefas_Submetidas/eliminar/{id}', ['as' => 'Tarefas_Submetidas.delete', 'uses' => 'Admin\TarefasSubmetidasController@delete']);
    //Tarefas Submetidas end
    //logs
    Route::get('admin/logs/pesquisar', ['as' => 'admin.logs.pesquisar.index', 'uses' => 'Admin\LogUserController@pesquisar'])->middleware('access.controll.administrador');
    Route::post('admin/logs/recebelogs', ['as' => 'admin.logs.recebelogs', 'uses' => 'Admin\LogUserController@recebelogs'])->middleware('access.controll.administrador');
    Route::get('admin/logs/visualizar/index/{anoLectivo}/{utilizador}', ['as' => 'admin.logs.listar', 'uses' => 'Admin\LogUserController@index'])->middleware('access.controll.administrador');
    //

    //materia
    Route::get('/materia', ['a+7,s' => 'materia', 'uses' => 'Admin\MateriaController@create'])->middleware('access.controll.administrador');
    Route::post('/materia/cadastrar', ['as' => 'materia.cadastrar', 'uses' => 'Admin\MateriaController@store'])->name('cadastrar_Materia')->middleware('access.controll.administrador');
    Route::get('/materia/ver', ['as' => 'materia.ver', 'uses' => 'Admin\MateriaController@show']);
    Route::get('/materia/editar/{id}', ['as' => 'materia.editar', 'uses' => 'Admin\MateriaController@edit'])->middleware('access.controll.administrador');
    Route::put('/materia/editar/{id}', ['as' => 'materia.actualizar', 'uses' => 'Admin\MateriaController@update'])->middleware('access.controll.administrador');
    Route::get('/materia/excluir/{id}', ['as' => 'materia.excluir', 'uses' => 'Admin\MateriaController@delete'])->middleware('access.controll.administrador');
    Route::get('/materia/addvideo/{id}', ['as' => 'materia.addvideo', 'uses' => 'Admin\MateriaController@addvideo'])->middleware('access.controll.administrador');
    Route::get('/materia/addPDF/{id}', ['as' => 'materia.addPDF', 'uses' => 'Admin\MateriaController@addPDF'])->middleware('access.controll.administrador');
    Route::get('/materia/supervisionar/{id}', ['as' => 'materia.supervisionar', 'uses' => 'Admin\MateriaController@supervisionar']);
    Route::get('/materia/pdfJson/{id}', ['as' => 'materia.pdfJson', 'uses' => 'Admin\MateriaController@pdfJson']);
    Route::post('/materia/uploadvideo/{id}', ['as' => 'materia.uploadvideo', 'uses' => 'Admin\MateriaController@uploadvideo'])->middleware('access.controll.administrador');
    Route::post('/materia/uploadPDF/{id}', ['as' => 'materia.uploadPDF', 'uses' => 'Admin\MateriaController@uploadPDF'])->middleware('access.controll.administrador');
    Route::get('/materia/minhasMateria/{id}', ['as' => 'materia.minhasMateria', 'uses' => 'Admin\MateriaController@minhasMateria'])->middleware('access.controll.administrador');

    Route::get('/materia/buscasDiscicplina/', ['as' => 'materia.buscasDiscicplina', 'uses' => 'Admin\MateriaController@buscasDiscicplina'])->middleware('access.controll.professor');
    Route::post('/materia/listarMateria/', ['as' => 'materia.listarMateria', 'uses' => 'Admin\MateriaController@listarMateria'])->middleware('access.controll.professor');
    Route::get('/materia/listarMateria2/{classe}/{anoLectivo}', ['as' => 'materia.listarMateria2', 'uses' => 'Admin\MateriaController@listarMateria2'])->middleware('access.controll.professor');

    Route::get('/materia/editarVideo/{id_video}', ['as' => 'materia.editarVideo', 'uses' => 'Admin\MateriaController@editarVideo'])->middleware('access.controll.administrador');
    Route::put('/materia/uploadvideoEditar/{id}', ['as' => 'materia.uploadvideoEditar', 'uses' => 'Admin\MateriaController@uploadvideoEditar'])->middleware('access.controll.administrador');
    Route::get('/materia/excluirVideo/{id}', ['as' => 'materia.excluirVideo', 'uses' => 'Admin\MateriaController@excluirVideo'])->middleware('access.controll.administrador');
    Route::put('/materia/uploadPDFEditar/{id}', ['as' => 'materia.uploadPDFEditar', 'uses' => 'Admin\MateriaController@uploadPDFEditar'])->middleware('access.controll.administrador');
    Route::get('/materia/editarPDF/{id_PDF}', ['as' => 'materia.editarPDF', 'uses' => 'Admin\MateriaController@editarPDF'])->middleware('access.controll.administrador');
    Route::get('/materia/excluirPDF/{id}', ['as' => 'materia.excluirPDF', 'uses' => 'Admin\MateriaController@excluirPDF'])->middleware('access.controll.administrador');
    Route::get('/materia/aluno/ver/{id}/{id_unidade}', ['as' => 'materia.aluno', 'uses' => 'Admin\MateriaController@materiaAluno']);
    Route::get('/materia/{id}/adicionar/video_youtube/', ['as' => 'materia.adicionar_video_youtube', 'uses' => 'Admin\VideoYoutubeController@adicionar'])->middleware('access.controll.Aluno');
    Route::post('/materia/{id}/video_youtube/cadastrar/', ['as' => 'materia.adicionar_video_youtube_cadastrar', 'uses' => 'Admin\VideoYoutubeController@cadastrar'])->middleware('access.controll.Aluno');
    Route::get('/materia/{id}/video_youtube/listar/', ['as' => 'materia.adicionar_video_youtube_listar', 'uses' => 'Admin\VideoYoutubeController@listar'])->middleware('access.controll.Aluno');
    Route::get('/materia/video_youtube/{id}/editar/', ['as' => 'materia.adicionar_video_youtube_editar', 'uses' => 'Admin\VideoYoutubeController@editar'])->middleware('access.controll.Aluno');
    Route::get('/materia/video_youtube/{id}eliminar/', ['as' => 'materia.adicionar_video_youtube_eliminar', 'uses' => 'Admin\VideoYoutubeController@eliminar'])->middleware('access.controll.Aluno');
    Route::put('/materia/video_youtube/{id}/actualizar/', ['as' => 'materia.adicionar_video_youtube_actualizar', 'uses' => 'Admin\VideoYoutubeController@actualizar'])->middleware('access.controll.Aluno');
    //end Materia

    Route::get('/video', ['as' => 'video', 'uses' => 'Admin\VideoController@create'])->middleware('access.controll.administrador');
    Route::post('/video/cadastrar', ['as' => 'video', 'uses' => 'Admin\VideoController@uploadVideo'])->middleware('access.controll.administrador');

    //Tarefas Submetidas start
    route::get('/horas', ['as' => 'horas.index', 'uses' => 'Admin\HorasController@index'])->middleware('access.controll.administrador');
    route::get('/horas/criar', ['as' => 'horas.create', 'uses' => 'Admin\HorasController@create'])->middleware('access.controll.administrador');
    route::post('/horas/cadastrar', ['as' => 'horas.store', 'uses' => 'Admin\HorasController@store'])->middleware('access.controll.administrador');
    route::get('/horas/editar/{id}', ['as' => 'horas.edit', 'uses' => 'Admin\HorasController@Edit'])->middleware('access.controll.administrador');
    route::put('/horas/actualizar/{id}', ['as' => 'horas.update', 'uses' => 'Admin\HorasController@update'])->middleware('access.controll.administrador');
    route::get('/horas/eliminar/{id}', ['as' => 'horas.delete', 'uses' => 'Admin\HorasController@delete'])->middleware('access.controll.administrador');
    //Tarefas Submetidas end

    //dias_semanas start
    route::get('/dias_semanas', ['as' => 'dias_semanas.index', 'uses' => 'Admin\DiasSemanasController@index'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/criar', ['as' => 'dias_semanas.create', 'uses' => 'Admin\DiasSemanasController@create'])->middleware('access.controll.administrador');
    route::post('/dias_semanas/cadastrar', ['as' => 'dias_semanas.store', 'uses' => 'Admin\DiasSemanasController@store'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/editar/{id}', ['as' => 'dias_semanas.edit', 'uses' => 'Admin\DiasSemanasController@Edit'])->middleware('access.controll.administrador');
    route::put('/dias_semanas/actualizar/{id}', ['as' => 'dias_semanas.update', 'uses' => 'Admin\DiasSemanasController@update'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/eliminar/{id}', ['as' => 'dias_semanas.delete', 'uses' => 'Admin\DiasSemanasController@delete'])->middleware('access.controll.administrador');
    //dias_semanas end

    //horarios start
    route::get('/horarios', ['as' => 'horarios.index', 'uses' => 'Admin\HorarioController@index']);
    route::get('/horarios/criar', ['as' => 'horarios.create', 'uses' => 'Admin\HorarioController@create'])->middleware('access.controll.administrador');
    route::post('/horarios/cadastrar', ['as' => 'horarios.store', 'uses' => 'Admin\HorarioController@store'])->middleware('access.controll.administrador');
    route::get('/horarios/editar/{id}', ['as' => 'horarios.edit', 'uses' => 'Admin\HorarioController@Edit'])->middleware('access.controll.administrador');
    route::put('/horarios/actualizar/{id}', ['as' => 'horarios.update', 'uses' => 'Admin\HorarioController@update'])->middleware('access.controll.administrador');
    route::get('/horarios/eliminar/{id}', ['as' => 'horarios.delete', 'uses' => 'Admin\HorarioController@delete'])->middleware('access.controll.administrador');
    //horarios end

    Route::group(['prefix' => 'professores', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'professores', 'uses' => 'Admin\FuncionarioEscolaController@listar']);
        Route::get('{id}/vincularEscola', ['as' => 'professores.vincularEscola', 'uses' => 'Admin\FuncionarioEscolaController@vincularEscola']);
        Route::post('{id}/vincular', ['as' => 'professores.vincular', 'uses' => 'Admin\FuncionarioEscolaController@vincular']);
        Route::get('professorEscola', ['as' => 'professores.professorEscola', 'uses' => 'Admin\FuncionarioEscolaController@professorEscola']);
        Route::get('{id}/excluir', ['as' => 'professores.excluir', 'uses' => 'Admin\FuncionarioEscolaController@excluir']);
        Route::get('{id}/editar', ['as' => 'professores.editar', 'uses' => 'Admin\FuncionarioEscolaController@editar']);
        Route::put('{id}/atualizar', ['as' => 'professor.atualizar', 'uses' => 'Admin\FuncionarioEscolaController@atualizar']);
    });

    Route::post('/materia/uploadvideo/{id}', ['as' => 'materia.uploadvideo', 'uses' => 'Admin\MateriaController@uploadvideo'])->middleware('access.controll.administrador');
    Route::post('/materia/uploadPDF/{id}', ['as' => 'materia.uploadPDF', 'uses' => 'Admin\MateriaController@uploadPDF'])->middleware('access.controll.administrador');
    //end Materia

    Route::get('/video', ['as' => 'video', 'uses' => 'Admin\VideoController@create'])->middleware('access.controll.administrador');
    Route::post('/video/cadastrar', ['as' => 'video', 'uses' => 'Admin\VideoController@uploadVideo'])->middleware('access.controll.administrador');

    //Tarefas Submetidas start
    route::get('/horas', ['as' => 'horas.index', 'uses' => 'Admin\HorasController@index'])->middleware('access.controll.administrador');
    route::get('/horas/criar', ['as' => 'horas.create', 'uses' => 'Admin\HorasController@create'])->middleware('access.controll.administrador');
    route::post('/horas/cadastrar', ['as' => 'horas.store', 'uses' => 'Admin\HorasController@store'])->middleware('access.controll.administrador');
    route::get('/horas/editar/{id}', ['as' => 'horas.edit', 'uses' => 'Admin\HorasController@Edit'])->middleware('access.controll.administrador');
    route::put('/horas/actualizar/{id}', ['as' => 'horas.update', 'uses' => 'Admin\HorasController@update'])->middleware('access.controll.administrador');
    route::get('/horas/eliminar/{id}', ['as' => 'horas.delete', 'uses' => 'Admin\HorasController@delete'])->middleware('access.controll.administrador');
    //Tarefas Submetidas end

    //dias_semanas start
    route::get('/dias_semanas', ['as' => 'dias_semanas.index', 'uses' => 'Admin\DiasSemanasController@index'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/criar', ['as' => 'dias_semanas.create', 'uses' => 'Admin\DiasSemanasController@create'])->middleware('access.controll.administrador');
    route::post('/dias_semanas/cadastrar', ['as' => 'dias_semanas.store', 'uses' => 'Admin\DiasSemanasController@store'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/editar/{id}', ['as' => 'dias_semanas.edit', 'uses' => 'Admin\DiasSemanasController@Edit'])->middleware('access.controll.administrador');
    route::put('/dias_semanas/actualizar/{id}', ['as' => 'dias_semanas.update', 'uses' => 'Admin\DiasSemanasController@update'])->middleware('access.controll.administrador');
    route::get('/dias_semanas/eliminar/{id}', ['as' => 'dias_semanas.delete', 'uses' => 'Admin\DiasSemanasController@delete'])->middleware('access.controll.administrador');
    //dias_semanas end

    //horarios start
    route::get('/horarios', ['as' => 'horarios.index', 'uses' => 'Admin\HorarioController@index']);
    route::get('/horarios/criar', ['as' => 'horarios.create', 'uses' => 'Admin\HorarioController@create'])->middleware('access.controll.administrador');
    route::post('/horarios/cadastrar', ['as' => 'horarios.store', 'uses' => 'Admin\HorarioController@store'])->middleware('access.controll.administrador');
    route::get('/horarios/editar/{id}', ['as' => 'horarios.edit', 'uses' => 'Admin\HorarioController@Edit'])->middleware('access.controll.administrador');
    route::put('/horarios/actualizar/{id}', ['as' => 'horarios.update', 'uses' => 'Admin\HorarioController@update'])->middleware('access.controll.administrador');
    route::get('/horarios/eliminar/{id}', ['as' => 'horarios.delete', 'uses' => 'Admin\HorarioController@delete'])->middleware('access.controll.administrador');
    //horarios end

    //aluno por municipio
    Route::get('admin/alunos/pesquisar', ['as' => 'admin.alunos.pesquisar.index', 'uses' => 'Admin\relatorios\Aluno_municipioController@pesquisar'])->middleware('access.controll.administrador');
    Route::post('admin/alunos/receberecebeMunicipio', ['as' => 'admin.alunos.receberecebeMunicipio', 'uses' => 'Admin\relatorios\Aluno_municipioController@recebeMunicipio'])->middleware('access.controll.administrador');
    Route::get('admin/alunos/visualizar/index/{anoLectivo}/{municipio}', ['as' => 'admin.visualizar', 'uses' => 'Admin\relatorios\Aluno_municipioController@visualizar'])->middleware('access.controll.administrador');
    Route::get('admin/alunos/pdf/index/{anoLectivo}/{municipio}', ['as' => 'admin.visualizar.pdf', 'uses' => 'Admin\relatorios\Aluno_municipioController@pdfAlunos'])->middleware('access.controll.administrador');

    Route::group(['prefix' => 'pais', 'middleware' => 'access.controll.administrador'], function () {
        Route::get('', ['as' => 'pais', 'uses' => 'Admin\PaisController@listar']);
        Route::get('{id}/excluir', ['as' => 'pais.excluir', 'uses' => 'Admin\PaisController@excluir']);
    });

    // Route::group(['prefix' => 'quizzes','middleware' => 'auth'], function () {
    //     Route::get('criar', ['as' => 'quizzes.criar', 'uses' => 'Admin\QuestaoController@criar']);
    //     Route::get('{id_disciplina}/materias', ['as' => 'quizzes.materias', 'uses' => 'Admin\PerguntaQuizController@verTemas']);
    //     Route::get('{id_tema}/pergunta/criar', ['as' => 'quizzes.criarPeguntas', 'uses' => 'Admin\PerguntaQuizController@criarPeguntas']);
    //     Route::post('{id_tema}/cadastrar', ['as' => 'quizzes.cadastrar', 'uses' => 'Admin\PerguntaQuizController@cadastrar']);
    //     Route::get('listarDisciplnas', ['as' => 'quizzes.listarDisciplnas', 'uses' => 'Admin\QuizController@listarDisciplnas']);
    //     Route::get('{id_disciplina}/escolherTemaDeQuiz', ['as' => 'quizzes.escolherTemaDeQuiz', 'uses' => 'Admin\QuizController@escolherTemaDeQuiz']);
    //     Route::get('{id_tema}/iniciarJogo', ['as' => 'quizzes.iniciarJogo', 'uses' => 'Admin\QuizController@iniciarJogo']);
    //     Route::get('{id_afirmacao}/{id_pergunta_quizzes}/verificarResposta', ['as' => 'quizzes.verificarResposta', 'uses' => 'Admin\QuizController@verificarResposta']);

    //     Route::get('listar', ['as' => 'quizzes.listar', 'uses' => 'Admin\QuizController@listar']);
    //     Route::get('{id_tema}/perguntas_listar', ['as' => 'quizzes.perguntas_listar', 'uses' => 'Admin\QuizController@perguntas_listar']);
    //     Route::get('{id_pergunta}/perguntas_editar', ['as' => 'quizzes.perguntas_editar', 'uses' => 'Admin\QuizController@perguntas_editar']);
    //     Route::put('{id_pergunta}/actualizar_pergunta', ['as' => 'quizzes.actualizar_pergunta', 'uses' => 'Admin\PerguntaQuizController@actualizar_pergunta']);
    //     Route::get('{id_pergunta}/perguntas_eliminar', ['as' => 'quizzes.perguntas_eliminar', 'uses' => 'Admin\PerguntaQuizController@perguntas_eliminar']);

    // });

    Route::group(['prefix' => 'quizzes', 'middleware' => 'auth'], function () {
        Route::get('criar', ['as' => 'quizzes.criar', 'uses' => 'Admin\QuestaoController@criar']);
        // Route::get('{id_disciplina}/materias', ['as' => 'quizzes.materias', 'uses' => 'Admin\QuestaoController@verTemas']);
        // Route::get('{id_tema}/pergunta/criar', ['as' => 'quizzes.criarPeguntas', 'uses' => 'Admin\QuestaoController@criarPeguntas']);
        // Route::post('{id_tema}/cadastrar', ['as' => 'quizzes.cadastrar', 'uses' => 'Admin\QuestaoController@cadastrar']);
        // Route::get('listarDisciplnas', ['as' => 'quizzes.listarDisciplnas', 'uses' => 'Admin\QuizController@listarDisciplnas']);
        // Route::get('{id_disciplina}/escolherTemaDeQuiz', ['as' => 'quizzes.escolherTemaDeQuiz', 'uses' => 'Admin\QuizController@escolherTemaDeQuiz']);
        // Route::get('{id_tema}/iniciarJogo', ['as' => 'quizzes.iniciarJogo', 'uses' => 'Admin\QuizController@iniciarJogo']);
        // Route::get('{id_afirmacao}/{id_pergunta_quizzes}/verificarResposta', ['as' => 'quizzes.verificarResposta', 'uses' => 'Admin\QuizController@verificarResposta']);

        Route::get('listar', ['as' => 'quizzes.listar', 'uses' => 'Admin\QuizController@listar']);
        // Route::get('{id_tema}/perguntas_listar', ['as' => 'quizzes.perguntas_listar', 'uses' => 'Admin\QuizController@perguntas_listar']);
        // Route::get('{id_pergunta}/perguntas_editar', ['as' => 'quizzes.perguntas_editar', 'uses' => 'Admin\QuizController@perguntas_editar']);
        // Route::put('{id_pergunta}/actualizar_pergunta', ['as' => 'quizzes.actualizar_pergunta', 'uses' => 'Admin\QuestaoController@actualizar_pergunta']);
        // Route::get('{id_pergunta}/perguntas_eliminar', ['as' => 'quizzes.perguntas_eliminar', 'uses' => 'Admin\QuestaoController@perguntas_eliminar']);

        Route::group(['prefix' => '/niveis'], function () {
            Route::get('criar', ['as' => 'quizzes.niveis.criar', 'uses' => 'Admin\NivelQuestaoController@criar']);
            Route::post('cadastrar', ['as' => 'quizzes.niveis.cadastrar', 'uses' => 'Admin\NivelQuestaoController@cadastrar']);
            Route::get('', ['as' => 'quizzes.niveis', 'uses' => 'Admin\NivelQuestaoController@index']);
            Route::post('{id_video}/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
            Route::get('{slug}/editar', ['as' => 'quizzes.niveis.editar', 'uses' => 'Admin\NivelQuestaoController@editar']);
            Route::put('{slug}/actualizar', ['as' => 'quizzes.niveis.actualizar', 'uses' => 'Admin\NivelQuestaoController@actualizar']);
            Route::get('{slug}/eliminar', ['as' => 'quizzes.niveis.eliminar', 'uses' => 'Admin\NivelQuestaoController@eliminar']);
            // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
            // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
        });

        Route::group(['prefix' => '/categorias'], function () {
            Route::get('criar', ['as' => 'quizzes.categorias.criar', 'uses' => 'Admin\CategoriaQuizController@criar']);
            Route::post('cadastrar', ['as' => 'quizzes.categorias.cadastrar', 'uses' => 'Admin\CategoriaQuizController@cadastrar']);
            Route::get('', ['as' => 'quizzes.categorias', 'uses' => 'Admin\CategoriaQuizController@index']);
            Route::get('{slug}/editar', ['as' => 'quizzes.categorias.editar', 'uses' => 'Admin\CategoriaQuizController@editar']);
            Route::put('{slug}/actualizar', ['as' => 'quizzes.categorias.actualizar', 'uses' => 'Admin\CategoriaQuizController@actualizar']);
            Route::get('{slug}/eliminar', ['as' => 'quizzes.categorias.eliminar', 'uses' => 'Admin\CategoriaQuizController@eliminar']);

            // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
            // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
        });

        Route::group(['prefix' => '/questoes'], function () {
            Route::get('criar', ['as' => 'quizzes.questoes.criar', 'uses' => 'Admin\QuestaoController@criar']);
            Route::post('cadastrar', ['as' => 'quizzes.questoes.cadastrar', 'uses' => 'Admin\QuestaoController@cadastrar']);
            Route::get('', ['as' => 'quizzes.questoes', 'uses' => 'Admin\QuestaoController@index']);
            Route::get('{slug}/editar', ['as' => 'quizzes.questoes.editar', 'uses' => 'Admin\QuestaoController@editar']);
            Route::put('{slug}/actualizar', ['as' => 'quizzes.questoes.actualizar', 'uses' => 'Admin\QuestaoController@actualizar']);
            Route::get('{slug}/eliminar', ['as' => 'quizzes.questoes.eliminar', 'uses' => 'Admin\QuestaoController@eliminar']);
            // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
            // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);

            Route::group(['prefix' => 'respostas'], function () {
                Route::get('{slug}/', ['as' => 'quizzes.questoes.respostas', 'uses' => 'Admin\RespostaQuestaoQuiz@respostas']);
                Route::get('{slug}/editar', ['as' => 'quizzes.questoes.respostas.editar', 'uses' => 'Admin\RespostaQuestaoQuiz@editar']);
                Route::put('{slug}/actualizar', ['as' => 'quizzes.questoes.respostas.actualizar', 'uses' => 'Admin\RespostaQuestaoQuiz@actualizar']);

                Route::get('{slug}/editar_file', ['as' => 'quizzes.questoes.respostas.editar_file', 'uses' => 'Admin\RespostaQuestaoQuiz@editar_file']);
                // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
                // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);

                Route::put('{slug}/editar_actualizar', ['as' => 'quizzes.questoes.respostas.actualizar_file', 'uses' => 'Admin\RespostaQuestaoQuiz@actualizar_file']);
            });

        });

    });

    Route::group(['prefix' => 'materia/supervisionar/reacoes_video'], function () {
        Route::post('{id_video}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        Route::post('{id_video}/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
        // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);

    });

    Route::group(['prefix' => 'materia/supervisionar/reacoes_video'], function () {
        Route::post('{id_video}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        Route::post('{id_video}/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
        // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);

    });

    Route::group(['prefix' => '/materia/aluno/ver/reacoes_video/'], function () {
        Route::post('{id_video}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        Route::post('{id_video}/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);
        // Route::post('{id_vido}/gostei', ['as' => 'reacoes_video.gostei', 'uses' => 'Admin\ReacaoVideoController@gostei']);
        // Route::post('/nao_gostei', ['as' => 'reacoes_video.nao_gostei', 'uses' => 'Admin\ReacaoVideoController@nao_gostei']);

    });
    Route::group(['prefix' => 'tempo_sessao', 'middleware' => 'auth'], function () {
        Route::get('/', ['as' => 'tempo_sessao', 'uses' => 'Admin\TempoSessaoController@listar']);
        Route::get('/criar', ['as' => 'tempo_sessao.criar', 'uses' => 'Admin\TempoSessaoController@criar']);
        Route::post('/cadastrar', ['as' => 'tempo_sessao.cadastrar', 'uses' => 'Admin\TempoSessaoController@cadastrar']);
        Route::get('{id}/editar', ['as' => 'tempo_sessao.editar', 'uses' => 'Admin\TempoSessaoController@editar']);
        Route::put('{id}/actualizar', ['as' => 'tempo_sessao.actualizar', 'uses' => 'Admin\TempoSessaoController@actualizar']);
        Route::get('{id}/eliminar', ['as' => 'tempo_sessao.eliminar', 'uses' => 'Admin\TempoSessaoController@eliminar']);
    });

});
