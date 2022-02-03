<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClasseDisciplina;
use App\Models\Classe;
use App\Models\Disciplina;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\PDF;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use App\Models\Logger;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Models\AnoLectivo;
use App\Models\UnidadeMateria;

use App\Models\DetalheArquivoVideo;
use App\Http\Controllers\Admin\NotificacaoController;
use Illuminate\Http\Exceptions\PostTooLargeException;
use App\Http\Controllers\Admin\DireitoConteudoController;
use Exception;

class MateriaController extends Controller
{
    private $Logger;
    private $notificacao;
    private $menuDisciplina;
    private $direito_conteudo;
    public function __construct(NotificacaoController $notificacao,DireitoConteudoController $direito_conteudo)
    {
        $this->notificacao = $notificacao;
        $this->menuDisciplina = new MenuController();
        $this->Logger = new Logger();
        $this->direito_conteudo=$direito_conteudo;
    }
    public function create()
    {

        $response['unidadesMateria']=UnidadeMateria::all();
        $horarios = DB::table('horarios')
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*')
            ->where('horarios.it_estado', 1)->get();

        $classeDisciplinas = DB::table('classe_disciplinas')
            ->join('classes', 'classe_disciplinas.classe_id', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id')

            ->select('disciplinas.vc_disciplina', 'classes.vc_classe', 'classe_disciplinas.id')
            ->where('classe_disciplinas.it_estado', 1)->get();
        $quantidade_horario=Horario::all()->count();
        $quantidade_classeDisciplina=ClasseDisciplina::all()->count();
        $response['sim']=$quantidade_horario*$quantidade_classeDisciplina;
        $response['horarios']=$horarios;
        $response['classeDisciplinas']=$classeDisciplinas;

        return view('admin.materia.criar.index', $response);
    }

    public function store(Request $request)
    {

        $horario = Horario::find($request->id_horarios);
        $classeDisciplina = ClasseDisciplina::find($horario->it_id_classedisciplina);
        $classe=Classe::find($classeDisciplina->classe_id);
        $disciplina=Disciplina::find($classeDisciplina->disciplina_id);

        if ($request->it_id_classeDisciplina != $horario->it_id_classedisciplina) {
            return redirect()->back()->with('aviso', 1);
        }
        //dd($request->it_id_classeDisciplina);
        $materia = Materia::create($request->all());
        /* $materia = Materia::create([
               'vc_materia'=>$request->vc_materia,
               'id_horarios'=>$request->id_horarios,
               'it_id_classeDisciplina'=>$request->it_id_classeDisciplina,
               'dt_data_vizualizar'=>$request->dt_data_vizualizar]);
*/
        $this->Logger->Log('info', 'Adicionou uma nova matéria da '.$classe->vc_classe.'ª classe da disciplina de '.$disciplina->vc_disciplina.' ao sistema ');
        $this->notificacao->criarNotificacao("Materia", 'Foi adicionada uma nova materia de '.$disciplina->vc_disciplina);
        //return redirect()->route('materia.ver')->with('status', 1);
        return redirect()->back()->with('status', 1);
    }

    public function show()
    {
        $materias = DB::table('materias')
            ->join('horarios', function ($join) {
                $join->on('horarios.id', '=', 'materias.id_horarios');
            })
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })
            
            ->join('unidade_materias', 'unidade_materias.id','materias.it_id_unidadeMateria')
            ->select('horarios.id as id_horarios','unidade_materias.*', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*', 'materias.*', 'materias.id as id_m')
            ->where('materias.it_estado', 1)->get();

        return view('admin.materia.index', compact('materias'));
    }

    public function minhasMateria($id_user)
    {
      
        $materias = DB::table('materias')
            ->join('horarios', function ($join) {
                $join->on('horarios.id', '=', 'materias.id_horarios');
            })
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })
            ->join('matriculas', function ($join) {
                $join->on('matriculas.it_id_classe', '=', 'classes.id');
            })->join('users', function ($join) {
                $join->on('matriculas.it_id_utilizador', '=', 'users.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*', 'materias.*', 'materias.id as id_m')
            ->where('materias.it_estado', 1)
            ->where('matriculas.it_id_utilizador', $id_user)
            ->get();

        return view('admin.materia.index', compact('materias'));
    }

    public function buscasDiscicplina()
    {
        $anoslectivos = AnoLectivo::all();
        $user = User::find(Auth::id());
        if ($user->tipoUtilizador == 'Administrador') {
            $classesDisciplinas = DB::table('classe_disciplinas')
                ->join('classes', function ($join) {
                    $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
                })
                ->join('disciplinas', function ($join) {
                    $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
                })
                ->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
                ->where('classe_disciplinas.it_estado', '=', 1)
                ->get();
        } elseif ($user->tipoUtilizador == 'Professor') {
            $classesDisciplinas = DB::table('classe_disciplinas')
                ->join('classes', function ($join) {
                    $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
                })
                ->join('disciplinas', function ($join) {
                    $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
                })->join('funcionario_escolas', function ($join) {
                    $join->on('funcionario_escolas.it_id_classedisciplina', '=', 'classe_disciplinas.id');
                })
                ->where('classe_disciplinas.it_estado', '=', 1)
                ->where('funcionario_escolas.it_id_utilizador', '=', Auth::id())
                ->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
                ->get();
        }

        return view('admin.materia.pesquisar.index', compact('classesDisciplinas'), compact('anoslectivos'));
    }


    public function listarMateria(Request $dados)
    {
        /*$materias=collect();
        $merge=collect();
        $user=User::find(Auth::id());*/
        /*if (  $user->tipoUtilizador == 'Administrador' ) {
            $materias=$this->buscasMateria( $dados,$dados->id_anoLectivo );
        }else if($user->tipoUtilizador == 'Professor'){
            $materias= $this->buscasMatProfessor( $dados,$dados->id_anoLectivo );
        }*/
        return redirect()->route('materia.listarMateria2', [$dados->it_id_classeDisciplina, $dados->id_anoLectivo]);

        //return view('admin.materia.index', compact('materias'));
    }

    public function listarMateria2($it_id_classeDisciplina, $id_anoLectivo)
    {
        $materias = collect();
        $merge = collect();
        $user = User::find(Auth::id());
        if ($user->tipoUtilizador == 'Administrador') {
            $materias = $this->buscasMateria($it_id_classeDisciplina, $id_anoLectivo);
        } elseif ($user->tipoUtilizador == 'Professor') {
            $materias = $this->buscasMatProfessor($it_id_classeDisciplina, $id_anoLectivo);
        }

        return view('admin.materia.index', compact('materias'));
    }



    public function buscasMateria($it_id_classeDisciplina, $id_anoLetivo)
    {
        return DB::table('materias')
            ->join('horarios', function ($join) {
                $join->on('horarios.id', '=', 'materias.id_horarios');
            })
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })
            ->join('unidade_materias','unidade_materias.id','materias.it_id_unidadeMateria')
            ->select('unidade_materias.*','horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*', 'materias.*', 'materias.id as id_m')
            ->where('materias.it_id_classedisciplina', '=', $it_id_classeDisciplina)
            ->where('horarios.it_id_anoslectivos', $id_anoLetivo)
            ->where('materias.it_estado', 1)

            ->get();
    }


    public function buscasMatProfessor($it_id_classeDisciplina, $id_anoLetivo)
    {
        return   DB::table('materias')
            ->join('horarios', function ($join) {
                $join->on('horarios.id', '=', 'materias.id_horarios');
            })
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })
            ->join('funcionario_escolas', function ($join) {
                $join->on('funcionario_escolas.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('users', function ($join) {
                $join->on('funcionario_escolas.it_id_utilizador', '=', 'users.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*', 'materias.*', 'materias.id as id_m')
            ->where('materias.it_id_classedisciplina', '=', $it_id_classeDisciplina)
            ->where('horarios.it_id_anoslectivos', $id_anoLetivo)
            ->where('materias.it_estado', 1)
            ->where('funcionario_escolas.it_id_utilizador', Auth::id())
            ->get();
    }





    public function edit($id)
    {
        $materia = Materia::find($id);
        $unidadeMateria=UnidadeMateria::find($materia->it_id_unidadeMateria);
        $unidadesMateria=UnidadeMateria::all();
        
        $horario = DB::table('horarios')
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*')
            ->where('horarios.it_estado', 1)->where('horarios.id', $materia->id_horarios)->get();
        $horarios = DB::table('horarios')
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*')
            ->where('horarios.it_estado', 1)->get();

        $classeDisciplina = DB::table('classe_disciplinas')
            ->join('classes', 'classe_disciplinas.classe_id', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id')

            ->select('disciplinas.vc_disciplina', 'classes.vc_classe', 'classe_disciplinas.id')
            ->where('classe_disciplinas.id', $materia->it_id_classeDisciplina)->get();

        $classeDisciplinas = DB::table('classe_disciplinas')
            ->join('classes', 'classe_disciplinas.classe_id', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id')

            ->select('disciplinas.vc_disciplina', 'classes.vc_classe', 'classe_disciplinas.id')
            ->where('classe_disciplinas.it_estado', 1)->get();

        return view('admin.materia.editar.index', compact('materia', 'classeDisciplina','unidadesMateria','unidadeMateria'), ['horario' => $horario, 'horarios' => $horarios, 'classeDisciplinas' => $classeDisciplinas]);
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::find($request->id_horarios);
        $classeDisciplina = ClasseDisciplina::find($horario->id);

        if ($request->it_id_classeDisciplina != $horario->it_id_classedisciplina) {
            return redirect()->back()->with('aviso', 1);
        }
        Materia::find($id)->update($request->all());
        $this->Logger->Log('info', 'Actualizou a matéria de id '.$id);
        return redirect()->route('materia.ver')->with('status', 1);
    }

    public function delete($id)
    {
        $materia = Materia::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou a matéria de id '.$id);
        //return redirect()->route('materia.ver');
        return redirect()->back()->with('eliminar', 1);
    }

    public function addvideo($id_materia)
    {
        return view('admin.materia.video.criar.index', compact('id_materia'));
    }

    public function addPDF($id_materia)
    {
        return view('admin.materia.PDF.criar.index', compact('id_materia'));
    }

    public function uploadvideo(Request $request, $id_materia)
    {
        // Verifica se informou o arquivo e se é válido

        try {
            if ($request->hasFile('vc_video') && $request->file('vc_video')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));

                // Recupera a extensão do arquivo
                $extension = $request->vc_video->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $upload = $request->vc_video->storeAs('videoMateria', $nameFile);
                // $upload = substr( $upload ,7,strlen($upload));
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

                // Verifica se NÃO deu certo o upload ( Redireciona de volta )
                if (!$upload) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
                } else {
                    $size = $request->vc_video->getSize();
                    $result_size = $size * (1.0 * pow(10, -6));
                    $true_size = number_format($result_size, 2, '.', '');

                    $video= Video::create([
                    'vc_descricao' => $request->vc_descricao,
                    'vc_video' => $upload,
                    'id_materia' => $id_materia
                ]);

                    DetalheArquivoVideo::create([
                'vc_tipo_de_aquirvo'=>$extension,
                'vc_tamanho'=>$true_size,
                'id_video'=>$video->id
                ]);
                }
                $this->Logger->Log('info', 'Adicionou um vídeo que tem como descrição '.$request->vc_descricao.' a matéria que tem como id '.$id_materia);
                return redirect()->route('materia.ver')->with('status', 1);
                ;
            }
        } catch (PostTooLargeException $ex) {
            return redirect()->route('materia.ver')->with('status', 1);
            ;
        }
    }


    public function uploadPDF(Request $request, $id_materia)
    {
        if ($request->hasFile('vc_pdf') && $request->file('vc_pdf')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->vc_pdf->extension();

            // Tamanho do arquivo

            $size = $request->vc_pdf->getSize();
            $result_size = $size * (1.0 * pow(10, -6));
            $true_size = number_format($result_size, 2, '.', '');
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_pdf->storeAs('pdfMateria', $nameFile);
            // $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                PDF::create([
                    'vc_descricao_pdf' => $request->vc_descricao_pdf,
                    'id_materia' => $id_materia,
                    'vc_pdf' => $upload,
                    'it_size_pdf' => $true_size,
                ]);
            }
        }
        $this->Logger->Log('info', 'Adicionou um pdf que tem como descrição '.$request->vc_descricao_pdf.' a matéria de id '.$id_materia);
        return redirect()->route('materia.ver')->with('status', 1);
    }

    public function supervisionar($id)
    {
       
        $materia = Materia::find($id);
        $unidade=UnidadeMateria::find($materia->it_id_unidadeMateria);
       
        $materiaPDF = DB::table('materias')
            ->join('p_d_f_s', function ($join) {
                $join->on('materias.id', '=', 'p_d_f_s.id_materia');
            })
            ->where('p_d_f_s.it_estado', 1)
            ->where('materias.id', '=', $id)->get();


        $materiaVideo = DB::table('materias')
            ->join(
                'videos',
                function ($join) {
                $join->on('materias.id', '=', 'videos.id_materia');
            }
            )->join(
                'detalhe_arquivo_videos',
                function ($join) {
                $join->on('detalhe_arquivo_videos.id_video', '=', 'videos.id');
            }
            )->where('materias.id', '=', $id)
            ->where('videos.it_estado', 1)
            ->select('materias.*', 'materias.id as id_materia', 'videos.*', 'detalhe_arquivo_videos.*')
            ->get();


        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $reacoes=$this->burcar_reacoes($id);
         $videos_youtube=$this->videos_youtube($id);
        return view('admin.materia.supervisionar.index', ['unidade'=>$unidade,'materiaPDF' => $materiaPDF, 'materiaVideo' => $materiaVideo, 'materia' => $materia, 'disciplinas2' => $disciplinas2,'reacoes'=>$reacoes,'videos_youtube'=>$videos_youtube]);
    }


    public function videos_youtube($id_materia)
    {
       return DB::table('video_youtubes')
            ->join('materias', 'video_youtubes.id_materia', '=', 'materias.id')
            ->where('video_youtubes.it_estado',1)
                  ->where('materias.id',$id_materia)
            ->select('video_youtubes.id as id_video','video_youtubes.*','materias.*','materias.id as id_materia')
            ->get();
     
        // return view('admin.materia.video_youtube.index',compact('videos_youtube'));
    }
    public function burcar_reacoes($id_materia)
    {
        return DB::table('materias')
        ->join(
            'videos',
            function ($join) {
            $join->on('materias.id', '=', 'videos.id_materia');
        }
        )->join(
            'reacao_videos',
            function ($join) {
            $join->on('reacao_videos.id_video', '=', 'videos.id');
        }
        )->where('materias.id', '=', $id_materia)
        ->where('videos.it_estado', 1)
        ->select('reacao_videos.*')
        ->get();
    }
    public function pdfJson($id)
    {
        $materiaPDF = DB::table('materias')
            ->join('p_d_f_s', function ($join) {
                $join->on('materias.id', '=', 'p_d_f_s.id_materia');
            })
            ->where('p_d_f_s.it_estado', 1)
            ->where('p_d_f_s.id', '=', $id)->get();


        return  $materiaPDF;
    }

    public function detalhar($id)
    {
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $response['disciplinas2'] = $disciplinas2;
        // $id = 1;
        $materia = Materia::find($id);
        $materiaPDF = DB::table('materias')
            ->join('p_d_f_s', function ($join) {
                $join->on('materias.id', '=', 'p_d_f_s.id_materia');
            })
            ->where('p_d_f_s.it_estado', 1)
            ->where('materias.id', '=', $id)->get();


        $materiaVideo = DB::table('materias')
            ->join(
                'videos',
                function ($join) {
                    $join->on('materias.id', '=', 'videos.id_materia');
                }
            )->where('materias.id', '=', $id)
            ->where('videos.it_estado', 1)
            ->get();
        $response['disciplinas2'] = $disciplinas2;
        $response['materiaPDF'] = $materiaPDF;
        $response['materiaVideo'] = $materiaVideo;
        $response['materia'] = $materia;
        return view('admin.materia.detalhes.index', $response);
    }

    public function editarVideo($id_video)
    {
        $video =   Video::find($id_video);

        return view('admin.materia.video.editar.index', compact('video'));
    }


    public function uploadvideoEditar(Request $request, $id)
    {
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('vc_video') && $request->file('vc_video')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->vc_video->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_video->storeAs('videoMateria', $nameFile);
            // $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                Video::find($id)->update([
                    'vc_descricao' => $request->vc_descricao,
                    'vc_video' => $upload,

                ]);
            }
            $this->Logger->Log('info', 'Actualizou o vídeo da matéria que tem como id '. Video::find($id)->id_materia);
            return redirect()->route('materia.ver')->with('upload', 1);
            ;
        }else{
            Video::find($id)->update([
                'vc_descricao' => $request->vc_descricao

            ]);
            $this->Logger->Log('info', 'Actualizou o vídeo da matéria que tem como id '. Video::find($id)->id_materia);
            return redirect()->route('materia.ver')->with('upload', 1);
        }
    }
    public function excluirVideo($id_video)
    {
        Video::find($id_video)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou um vídeo que pertence a matéria de id '.Video::find($id_video)->id_materia);
        return redirect()->back()->with('delete', 1);
    }





    public function editarPDF($id_PDF)
    {
        $PDF =   PDF::find($id_PDF);

        return view('admin.materia.PDF.editar.index', compact('PDF'));
    }


    public function uploadPDFEditar(Request $request, $id)
    {
        $pdf=PDF::find($id);
        if ($request->hasFile('vc_pdf') && $request->file('vc_pdf')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->vc_pdf->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_pdf->storeAs('pdfMateria', $nameFile);
            // $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            //$this->Logger->Log('info', 'Actualizou Escola');

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                PDF::find($id)->update([
                    'vc_descricao_pdf' => $request->vc_descricao_pdf,
                    'vc_pdf' => $upload,

                ]);
                $this->Logger->Log('info', 'Actualizou o pdf de id '. $pdf->id.' da matéria que tem como id '. $pdf->id_materia);
                return redirect()->back()->with('up', 1);
            }
        }else{
            PDF::find($id)->update([
                'vc_descricao_pdf' => $request->vc_descricao_pdf,

            ]);
            $this->Logger->Log('info', 'Actualizou o pdf de id '. $pdf->id.' da matéria que tem como id '. $pdf->id_materia);
            return redirect()->back()->with('up', 1);
        }
    }



    public function excluirPDF($id_pdf)
    {
        PDF::find($id_pdf)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou o pdf de id '.$id_pdf.' que pertence a matéria de id '. PDF::find($id_pdf)->id_materia);
        return redirect()->back()->with('delete', 1);
    }


    public function materiaAluno($id_classe_disciplina,$id_unidade)
    {

       
// dd($id_classe_disciplina);
        if(!$this->direito_conteudo->minha_classe_disciplina($id_classe_disciplina)){
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }
           
        $notificacao = $this->notificacao->notificacarMateria();
         $unidade=UnidadeMateria::find($id_unidade);
         $response['unidade']=$unidade;
        $materias = Materia::where('it_id_classeDisciplina', $id_classe_disciplina)->where('it_id_unidadeMateria',$id_unidade)->where('it_estado',1)->get();

        $classeDisciplina = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })
            ->where('classe_disciplinas.it_estado', '=', 1)
            ->where('classe_disciplinas.id', '=', $id_classe_disciplina)->get();

        $materiaPDF = collect();
        $materiaVideo = collect();
        $reacoes = collect();
        $videos_youtube=collect();
        $materias1 = $materias;
        foreach ($materias1 as $materia) {
            $materiaPDF =  $materiaPDF->merge($this->buscar_pdf($materia->id));
            $materiaPDF->all();
            $reacoes= $reacoes->merge($this->burcar_reacoes($materia->id));
            $reacoes->all();
            $videos_youtube=$videos_youtube->merge($this->videos_youtube($materia->id));
            $videos_youtube->all();
            // $materiaVideo =   $materiaVideo->merge(Video::where('id_materia', $materia->id)->get());

            $materiaVideo =   $materiaVideo->merge($this->buscar_video($materia->id));
            $materiaVideo->all();
        }
        // $reacoes=$this->burcar_reacoes($id);
        // $videos_youtube=$this->videos_youtube($id);
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        return view('admin.supervisionar.aluno.index', ['notificacao' => $notificacao, 'materiaPDF' => $materiaPDF, 'materiaVideo' => $materiaVideo, 'materias' => $materias, 'classeDisciplina' => $classeDisciplina, 'disciplinas2' => $disciplinas2,'reacoes'=>$reacoes,'videos_youtube'=>$videos_youtube],$response);
    }

    public function buscar_video($id_materia)
    {
        return    DB::table('materias')
          ->join(
              'videos',
              function ($join) {
              $join->on('materias.id', '=', 'videos.id_materia');
          }
          )->join(
            'detalhe_arquivo_videos',
            function ($join) {
            $join->on('detalhe_arquivo_videos.id_video', '=', 'videos.id');
        }
        )->where('materias.id', '=', $id_materia)
        ->where('videos.it_estado', 1)
        ->select('materias.*', 'materias.id as id_materia', 'videos.*', 'detalhe_arquivo_videos.*')
        ->get();
    }



    public function buscar_pdf($id_materia)
    {
        return     DB::table('materias')
        ->join('p_d_f_s', function ($join) {
            $join->on('materias.id', '=', 'p_d_f_s.id_materia');
        })
        ->where('p_d_f_s.it_estado', 1)
        ->where('materias.id', '=', $id_materia)->get();
    }

    
}
