<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gabarito;
use App\Repositories\Eloquent\UtilizadorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Logger;
use App\Http\Controllers\Admin\DireitoConteudoController;
class GabaritoController extends Controller
 {

    private $Logger, $notificacao;
    private $menuDisciplina;

    public function __construct( NotificacaoController $notificacao,DireitoConteudoController $direito_conteudo )
 {
        $this->menuDisciplina = new MenuController();
        $this->Logger = new Logger();
        $this->notificacao = $notificacao;
        $this->direito_conteudo=$direito_conteudo;
    }

    public function store( Request $request, $id_tarefa )
 {

        if ( $request->hasFile( 'vc_gabarito' ) && $request->file( 'vc_gabarito' )->isValid() ) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid( date( 'HisYmd' ) );

            // Recupera a extensão do arquivo
            $extension = $request->vc_gabarito->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_gabarito->storeAs( 'public/Gabarito', $nameFile );
            $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if ( !$upload ) {
                return redirect()
                ->back()
                ->with( 'error', 'Falha ao fazer upload' )
                ->withInput();
            } else {
                Gabarito::create( [
                    'vc_descricao_gabarito' => $request->vc_descricao_gabarito,
                    'vc_gabarito' => $upload,
                    'it_id_tarefas' =>$id_tarefa
                ] );

                $this->Logger->Log('info', 'Adicionou  um gabarito ao sistema com a seguinte descrição '.$request->vc_descricao_gabarito);
            }
        }

        return redirect()->back()->with( 'status', 1 );
    }

    public function show( $id_tarefa ) {

        $id_classe_disciplina=$this->id_classe_disciplina($id_tarefa);
       if(!$this->direito_conteudo->minha_classe_disciplina($id_classe_disciplina)){
        return redirect()->back()->with('acao_nao_autorizado', 1);
       }
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $gabaritos =  Gabarito::where( 'it_id_tarefas', $id_tarefa ) ->where( 'it_estado', 1 )->get();
        return view( 'admin.gabarito.index', compact( 'gabaritos' ), compact( 'disciplinas2' ) );

    }
    public function id_classe_disciplina($id_tarefa){
        $result_set= DB::table('tarefas')
        ->join('classe_disciplinas','tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id')
        ->where('tarefas.it_estado', '=', 1)
        ->where('tarefas.id', '=', $id_tarefa)
        ->first();
        return isset($result_set->id_classe_disciplinas)?$result_set->id_classe_disciplinas:0;
}
    public function criar( $id_tarefa ) {
        return view( 'admin.gabarito.criar.index', compact( 'id_tarefa' ) );
    }

    public function update(Request $request,$id){
        $complemento='';
        if ( $request->hasFile( 'vc_gabarito' ) && $request->file( 'vc_gabarito' )->isValid() ) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid( date( 'HisYmd' ) );

            // Recupera a extensão do arquivo
            $extension = $request->vc_gabarito->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_gabarito->storeAs( 'public/Gabarito', $nameFile );
            $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if ( !$upload ) {
                return redirect()
                ->back()
                ->with( 'error', 'Falha ao fazer upload' )
                ->withInput();
            } else {
                $gabarito_anterior=Gabarito::find($id);
                Gabarito::where('id',$id)->update( [
                    'vc_descricao_gabarito' => $request->vc_descricao_gabarito,
                    'vc_gabarito' => $upload,
                ] );
                $gabarito=Gabarito::find($id);
                if( $gabarito_anterior->vc_descricao_gabarito!=$gabarito->vc_descricao_gabarito)
                $complemento=', mudando a sua descrição de '.$gabarito_anterior->vc_descricao_gabarito.' para '.$gabarito->vc_descricao_gabarito;
                $this->Logger->Log('info', 'Actualizou  o gambarito no sistema que tem como id '.$gabarito->id.$complemento);
            }
        }

        return redirect()->back()->with( 'status', 1 );

    }

    public function editar($id){
        $data['gabarito'] = Gabarito::find($id);
        // dd($data);
        return view("admin.gabarito.editar.index",$data);

    }
    public function delete($id){
        $data['it_estado'] = 0;
        Gabarito::where('id',$id)->update($data);
        $gabarito=Gabarito::find($id);
        $this->Logger->Log('info', 'Eliminou o gabarito no sistema que tinha como id '.$gabarito->id.' e descrição '.$gabarito->vc_descricao_gabarito);
        return redirect()->back()->with('status','1');
    }

    // public function stsore( Request $request ) {
    //     $nameFile = null;

    //     // Verifica se informou o arquivo e se é válido
    //     if ( $request->hasFile( 'chave' ) && $request->file( 'chave' )->isValid() ) {

    //         // Recupera a extensão do arquivo
    //         $extension = $request->image->extension();

    //         // Define finalmente o nome

    //         // Faz o upload:
    //         $upload = $request->image->storeAs( 'gabarito', $nameFile );
    //         // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

    //         // Verifica se NÃO deu certo o upload ( Redireciona de volta )
    //         if ( !$upload )
    //         return redirect()
    //         ->back()
    //         ->with( 'error', 'Falha ao fazer upload' )
    //         ->withInput();
    //     }
    // }
}

