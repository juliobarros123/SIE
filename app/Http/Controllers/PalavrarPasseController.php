<?php




namespace App\Http\Controllers;

use Keygen\Keygen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\CodidoPalavraPasse;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Exception;
class PalavrarPasseController extends Controller
{
    //
public $codigo;
public $email;
    public function recuperar(){

        return view('auth.passwords.forgot-password');
    }
    public function redefinir(Request $dados){
    
try{
  
    $this->email=$dados->email;
  
    $user=$this->conta_existe($dados->get('email'));

    if($user){
        $this->codigo=$this->gerar_codigo();
  
        $this->cadastrar_codigo($dados->email,$this->codigo,$user);
  
      
       $estado =$this->enviar($dados->email,$this->codigo);
       
       if( $estado )
       return redirect()->route('palavra_passe.confirmar_codigo')->with('enviado',1);
    }else{
        
        return redirect()->back()
        ->with('email_nao_encontrado', 1);
    }
}catch (\Throwable $th) {

    return redirect()->back()
        ->with('error', 1);
}
      
      

    }
    public function confirmar_codigo(){
        return view('auth.passwords.codigo_verifique');
    }
    

    public function enviar($email,$codigo){
   try{
    $data=['codigo'=>$codigo];
    
    Mail::send('emails.corpo', $data, function ($message) {
        $message->from('xilonga@itel.gov.ao', 'S.I.E');
        $message->subject('Código de confimação');
        $message->to($this->email);
       
      });
      return true;
   }catch(Exception $ex){

   }
    }
    public function gerar_codigo(){
      return  Keygen::numeric(8)->generate();
    }
    public function conta_existe($email){

        $user=    User::where('email',$email)->first();
      if($user){
          return $user;
      }else{
          return false;
      }
    }
    public function cadastrar_codigo($email,$codigo,$user){
    //     $data = "2020-08-15";
    //     $timestamp1 = strtotime($date);
    //     $timestamp2 = strtotime('+1 day', $timestamp1);
    //     dd(  $timestamp2);
    // $tempo_criado=date("d/m/Y H:i:s");
 
    // $tempo_expiracao=date('d/m/Y H:i:s', strtotime("+1 days",strtotime( $tempo_criado)));

  $tempo=$this->tempo();


try{

    if($user){
        CodidoPalavraPasse::create([
              'id_user'=> $user->id,
              'codigo'=>$codigo,
              'hora'=>$tempo['hora'],
              'tempo_criado'=>$tempo['hoje'],
              'tempo_expiracao'=>$tempo['amanha']
          ]);
      }

  
}catch(\Throwable $th){

}
    
    }

    public function tempo(){
        $hora=date("H:i:s");
        $hoje=date("Y-m-d");
        $amanha=date('Y-m-d', strtotime("+1 day",strtotime( $hoje)));
     
        $tempo=[
            'hoje'=>$hoje,
            'amanha'=>$amanha,
            'hora'=>$hora
        ];
       
        return $tempo;
  
    }
    public function codigo(Request $dados){
     
       $result= CodidoPalavraPasse::where('codigo',$dados->codigo)->get();
       if($result){
        return view('auth.passwords.new_password');
       }{
           return "Código inválido";
       }
    }


    public function vrf_codigo_confirme(Request $dados){
         $datas=$this->tempo();
        //  dd( $datas);
  
        $user=$this->conta_existe($dados->get('email'));
        if( $user){
            try{
      $result_Set=  DB::table('codido_palavra_passes')
        ->join('users','codido_palavra_passes.id_user','users.id')
        ->where('users.email',$dados->email)
        ->whereDate('codido_palavra_passes.tempo_expiracao','>=', $datas['hoje'])
        // ->orWhereTime('codido_palavra_passes.hora','>=', $datas['hora'])
        ->orderBy('codido_palavra_passes.id', 'desc')
        ->limit(1)->get();
       

        $result_Set= collect($result_Set)->where('codigo',$dados->codigo);
    
        if($datas['hoje']==$result_Set['0']->tempo_expiracao){
        
            $result_Set= $result_Set->where('hora','>', $datas['hora']);
            // dd( $result_Set);
        }
       
        $result_Set=$result_Set->count();

        if($result_Set){
            session()->put('email',$dados->email);
            return redirect()->route('palavra_passe.nova_palavra_passe');

        }{
            return redirect()->back()
            ->with('codigo_invalido', 1);
        }
    }catch(\Throwable $th){
        return redirect()->back()
        ->with('codigo_invalido', 1);
    }
        
    }else{
        return redirect()->back()
        ->with('email_nao_encontrado', 1);
    }
}

     public function nova_palavra_passe(){
     return view('auth.passwords.new_password');
     }

     public function registar_palavra_passe(Request $request){
    try {
        if($request->password==$request->confirmed){
        
            $estado= User::where('email', session('email'))->update([
                 'password' => Hash::make($request->password)
                 
             ]);
          
             if( $estado){
                 $user=User::where('email', session('email'))->first();
                 session()->forget('email');
                 event(new Registered($user));
                
                 Auth::login($user);
                 return redirect()->intended(RouteServiceProvider::HOME);
             }else{
                return redirect()->back()
                ->with('senha_nao_confirmada', 1);
             }
          
           }else{
           
             return redirect()->back()
             ->with('senha_nao_confirmada', 1);
         }
           

    }catch(\Throwable $th){
        return redirect()->back()
        ->with('senha_nao_confirmada', 1);
    }
     
      
   
       
        }
}







