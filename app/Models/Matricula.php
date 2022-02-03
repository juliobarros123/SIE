<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class Matricula extends Model
{
    use HasFactory;
    protected $fillable = [
        'it_id_escola',
        'it_id_classe',
        'it_id_anolectivo',
        'it_id_utilizador',
        'it_estado'

    ];

    public function alunosClasse($it_id_anoLectivo, $it_id_escola)
    {
        if ($it_id_anoLectivo > 0 && $it_id_escola > 0) {
            $alunoClasse = DB::table('matriculas')
                ->where([['matriculas.it_estado', 1], ['matriculas.it_id_anolectivo', $it_id_anoLectivo], ['matriculas.it_id_escola', $it_id_escola]])
                ->join('classes', 'matriculas.it_id_classe', 'classes.id')
                ->select('classes.vc_classe', DB::raw('count(*) as quantidade'))
                ->groupBy('classes.vc_classe')
                ->get();
        } else if ($it_id_anoLectivo > 0 && $it_id_escola == 0) {
            $alunoClasse = DB::table('matriculas')
                ->where([['matriculas.it_estado', 1], ['matriculas.it_id_anolectivo', $it_id_anoLectivo]])
                ->join('classes', 'matriculas.it_id_classe', 'classes.id')
                ->select('classes.vc_classe', DB::raw('count(*) as quantidade'))
                ->groupBy('classes.vc_classe')
                ->get();
        } else if ($it_id_anoLectivo == 0 && $it_id_escola > 0) {
            $alunoClasse = DB::table('matriculas')
                ->where([['matriculas.it_estado', 1], ['matriculas.it_id_escola', $it_id_escola]])
                ->join('classes', 'matriculas.it_id_classe', 'classes.id')
                ->select('classes.vc_classe', DB::raw('count(*) as quantidade'))
                ->groupBy('classes.vc_classe')
                ->get();
        } else if ($it_id_anoLectivo == 0 && $it_id_escola == 0) {
            $alunoClasse = DB::table('matriculas')
                ->where('matriculas.it_estado', 1)
                ->join('classes', 'matriculas.it_id_classe', 'classes.id')
                ->select('classes.vc_classe', DB::raw('count(*) as quantidade'))
                ->groupBy('classes.vc_classe')
                ->get();
        }


        return $alunoClasse;
    }


    public function temFilhoNaoMatriculado($id_user){
      
        $users=User::where('current_team_id', '=',$id_user)
         ->get();
     foreach($users as $user){
         $matriculados=DB::table('matriculas')
         ->where('matriculas.it_id_utilizador',$user->id)
         ->count();
         if(!$matriculados){
           return ['estado'=>true,'educando'=>$user];  
         }
  
 
      }
       
     }

     public function matriculasDependencias($id_user)
     {
         // $Response['users'] = User::where('current_team_id', auth::id())->get();
         $Response['user'] =$this->temFilhoNaoMatriculado(Auth::id())['educando'];
   
         $Response['escolas'] = Escola::all();
         $Response['classes'] = Classe::all();
         $Response['anosLectivo'] = AnoLectivo::all();
         $quantidade_filhos = User::where('current_team_id', auth::id())->count();
         $quantidade_escolas = Escola::all()->count();
         $quantidade_classe = Classe::all()->count();
         $quantidade_anoLectivo = AnoLectivo::all()->count();
         $Response['sim'] = $quantidade_filhos * $quantidade_escolas * $quantidade_classe * $quantidade_anoLectivo;
         return $Response;
 
     }
    public function relacaoMatricula($id_classe, $it_id_anolectivo)
    {
        $result =  DB::table('matriculas')

            ->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
            ->join('users', 'users.id', 'matriculas.it_id_utilizador')
            ->join('classes', 'classes.id', 'matriculas.it_id_classe')
            ->join('escolas', 'escolas.id', 'matriculas.it_id_escola')
            ->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola');
        if ($id_classe) {
            $result->where('classes.id', $id_classe);
        }
        if ($it_id_anolectivo) {
            $result->where('matriculas.it_id_anolectivo', $it_id_anolectivo);
        }

        return $result->where('matriculas.it_estado', 1)->get();
    }

    public function relacaoMatriculaFilho($id_classe, $it_id_anolectivo,$it_id_pai)
    {
        $result =  DB::table('matriculas')->where('users.current_team_id',$it_id_pai)

            ->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
            ->join('users', 'users.id', 'matriculas.it_id_utilizador')
            ->join('classes', 'classes.id', 'matriculas.it_id_classe')
            ->join('escolas', 'escolas.id', 'matriculas.it_id_escola')
            ->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola');
        if ($id_classe) {
            $result->where('classes.id', $id_classe);
        }
        if ($it_id_anolectivo) {
            $result->where('matriculas.it_id_anolectivo', $it_id_anolectivo);
        }

        return $result->where('matriculas.it_estado', 1)->get();
    }

    public function alunoPorEscola($it_id_anolectivo,$it_id_escola){
        
        if($it_id_anolectivo==0 && $it_id_escola==0 )
        {
            $alunoEscola = DB::table( 'matriculas')
            ->where('matriculas.it_estado', 1)
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.vc_escola',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.vc_escola')
            ->get();
          
        }

        else if($it_id_anolectivo>0 && $it_id_escola==0)
        {
            $alunoEscola = DB::table( 'matriculas')
            ->where([['matriculas.it_estado', 1],['matriculas.it_id_anolectivo',$it_id_anolectivo]])
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.vc_escola',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.vc_escola')
            ->get();
                
            
        }

        else if($it_id_anolectivo==0 && $it_id_escola>0 )
        {
            $alunoEscola = DB::table( 'matriculas')
            ->where([['matriculas.it_estado', 1],['matriculas.it_id_escola',$it_id_escola]])
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.vc_escola',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.vc_escola')
            ->get();
                    
        }

        else
        {
            $alunoEscola = DB::table( 'matriculas')
            ->where([['matriculas.it_estado', 1],['matriculas.it_id_anolectivo',$it_id_anolectivo],['matriculas.it_id_escola',$it_id_escola]])
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.vc_escola',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.vc_escola')
            ->get();

        }
        
        return $alunoEscola;
         
        

    }

    public function alunosPorProvincia($it_id_anolectivo)
    {
        if($it_id_anolectivo>1){
            $alunoProvincia= DB::table( 'matriculas')
            ->where([['matriculas.it_estado', 1],['matriculas.it_id_anolectivo',$it_id_anolectivo],['escolas.it_estado',1]])
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.it_id_provincia',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.it_id_provincia')
            ->get();

        }

        else
        {
            $alunoProvincia= DB::table( 'matriculas')
            ->where([['matriculas.it_estado', 1],['escolas.it_estado',1]])
            ->join( 'escolas', 'matriculas.it_id_escola', 'escolas.id' )
            ->join( 'anoslectivos', 'matriculas.it_id_anolectivo', 'anoslectivos.id' )
            ->select('escolas.it_id_provincia',DB::raw('count(matriculas.id) as quantidade'))
            ->groupBy('escolas.it_id_provincia')
            ->get();

        }

            return $alunoProvincia;
       
    }

   
}