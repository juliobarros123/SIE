<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Vaga;
use App\Models\Candidato;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Empresa;
use Exception;
class CandidatoController extends Controller
{
    //
 
    protected $candidato;
 
    public function __construct(CandidatoRepository $candidato)
    {
        $this->candidato = $candidato;
      
    }
    public function index($slug_vaga){
        $response['vaga'] =Vaga::where('slug',$slug_vaga)->first();
        $response['candidatos'] =$this->candidato->all()->where('vagas.slug',$slug_vaga)->get();
      return view('admin.candidatos.index',$response);
    }

    public function aprovar($slug_candidato){
      
        $estado=Candidato::where('slug',$slug_candidato)->update([
            'estado'=>2
        ]);
        if($estado){
            $candidato=Candidato::where('slug',$slug_candidato)->first();
            $dados['user']  =$user= User::find($candidato->id_canditado);
           $dados['vaga']=Vaga::find($candidato->id_vaga);
           $dados['empresa']=Empresa::find( $dados['vaga']->id_empresa);
        //    $dados['assunto']="Você foi aprovado";
        $this->enviarEmail($user->email,$dados,'emails.candidato.aprovado.index');
            return redirect()->back()->with('aprovado', 1);
        }

   

    }

    public function reprovar($slug_candidato){
        
        $estado=Candidato::where('slug',$slug_candidato)->update([
            'estado'=>1
        ]);
        $candidato=Candidato::where('slug',$slug_candidato)->first();
        $dados['user']  =$user= User::find($candidato->id_canditado);
       $dados['vaga']=Vaga::find($candidato->id_vaga);
       $dados['empresa']=Empresa::find( $dados['vaga']->id_empresa);
    //    $dados['assunto']="Você foi aprovado";
       $this->enviarEmail($user->email,$dados,'emails.candidato.reprovado.index');
        if($estado){
            return redirect()->back()->with('reprovado', 1);
        }
    }
public $email;
 public  function enviarEmail($distino,$dados,$view){
        try{
        
         $this->email=$distino;
         Mail::send($view,$dados, function ($message) {
             $message->from('vagas@itel.gov.ao', 'S.I.E');
             $message->subject('Intrevista de trabalho');
             $message->to($this->email);
            
           });
           return true;
        }catch(Exception $ex){
      
        }
         }
}
