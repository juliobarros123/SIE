<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Escola;
use App\Models\Logger;
use App\Models\User;
use App\Models\AnoLectivo;
use Illuminate\Support\Facades\Hash;

class EscolaController extends Controller
{
    //
    private $Logger;

    public function __construct()
    {
        $this->Logger = new Logger();
    }

    public function  listar()
    {
        $escolas = Escola::where('it_estado', 1)->get();
        return view('admin.escola.index', compact('escolas'));
    }

    public function criar()
    {
        $anosLectivo = AnoLectivo::orderBy('id', 'desc')->get();

        return view('admin.escola.criar.index', compact('anosLectivo'));
    }

    public function cadastrar(Request $escola, $id_user)
    {
        // dd($id_user);
        if ($escola->vc_senha ==  $escola->vc_senha_confirmar) {
            if ($escola->hasFile('vc_logo') && $escola->file('vc_logo')->isValid()) {
                $name = uniqid(date('HisYmd'));

                $extension = $escola->vc_logo->extension();

                $nameFile = "{$name}.{$extension}";

                $upload = $escola->vc_logo->storeAs('public/logoEscola', $nameFile);
                $upload = substr( $upload ,7,strlen($upload));
                if (!$upload) {
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
                } else {
                    Escola::create(
                        [
                            'vc_escola' => $escola->vc_escola,
                            'vc_logo' => $upload,
                            'vc_num_ide' => $escola->vc_num_ide,
                            'vc_localizacao' => $escola->vc_localizacao,
                            'it_id_provincia' => $escola->it_id_provincia,
                            'it_id_minicipio' => $escola->it_id_minicipio,
                            'vc_director' => $escola->vc_director,
                            'vc_email' => $escola->vc_email,
                            'vc_senha' => 'sem senha',
                            'it_id_utilizador' => $id_user,
                            'dt_data_registro' => $escola->dt_data_registro,

                        ]
                    );
                    $this->Logger->Log('info', 'Adicionou escola '.$escola->vc_escola.' ao sistema');
                    return redirect()->back()->with('status', 1);
                }
            }else{

                Escola::create(
                    [
                        'vc_escola' => $escola->vc_escola,
                        'vc_logo' => '',
                        'vc_num_ide' => $escola->vc_num_ide,
                        'vc_localizacao' => $escola->vc_localizacao,
                        'it_id_provincia' => $escola->it_id_provincia,
                        'it_id_minicipio' => $escola->it_id_minicipio,
                        'vc_director' => $escola->vc_director,
                        'vc_email' => $escola->vc_email,
                        'vc_senha' =>  'sem senha',
                        'it_id_utilizador' => $id_user,
                        'dt_data_registro' => $escola->dt_data_registro,

                    ]
                );
                $this->Logger->Log('info', 'Adicionou escola '.$escola->vc_escola.' ao sistema');
                return redirect()->back()->with('status', 1);
            }
        } else {
            return redirect()->back()->with('aviso', 1);
        }
    }

    public function editar($id)
    {
        $escola =   Escola::find($id);
        $anosLectivo = AnoLectivo::orderBy('id', 'desc')->get();
        $anoLetivo =  AnoLectivo::find($escola->it_id_anoslectivos);

        return view('admin.escola.editar.index', compact('escola'), ['anosLectivo' => $anosLectivo, 'anoLetivo' => $anoLetivo]);
    }

    public function actualizar(Request $escola, $id, $id_user)
    {
        $escola_anterior=Escola::find($id);
        $complemento='';
        if ($escola->hasFile('vc_logo') && $escola->file('vc_logo')->isValid()) {
            $name = uniqid(date('HisYmd'));

            $extension = $escola->vc_logo->extension();

            $nameFile = "{$name}.{$extension}";

            $upload = $escola->vc_logo->storeAs('public/logoEscola', $nameFile);
            $upload = substr( $upload ,7,strlen($upload));
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                Escola::find($id)->update([
                    'vc_escola' => $escola->vc_escola,
                    'vc_logo' => $upload,
                    'vc_num_ide' => $escola->vc_num_ide,
                    'vc_localizacao' => $escola->vc_localizacao,
                    'it_id_provincia' => $escola->it_id_provincia,
                    'it_id_minicipio' => $escola->it_id_minicipio,
                    'vc_director' => $escola->vc_director,
                    'vc_email' => $escola->vc_email,
                    'vc_senha' =>  'sem senha',
                    'it_id_utilizador' => $id_user,
                    'dt_data_registro' => $escola->dt_data_registro,

                ]);
                $escola_actual=Escola::find($id);
                if($escola_anterior->vc_escola!=$escola_actual->vc_escola)
                    $complemento=$escola_anterior->vc_escola.' para '.$escola_actual->vc_escola;
                else
                    $complemento=$escola_anterior->vc_escola;

                $this->Logger->Log('info', 'Actualizou a escola '.$complemento);
                return redirect()->route('escolas')->with('status', 1);
            }
        }else{

            Escola::find($id)->update([
                'vc_escola' => $escola->vc_escola,
                'vc_num_ide' => $escola->vc_num_ide,
                'vc_localizacao' => $escola->vc_localizacao,
                'it_id_provincia' => $escola->it_id_provincia,
                'it_id_minicipio' => $escola->it_id_minicipio,
                'vc_director' => $escola->vc_director,
                'vc_email' => $escola->vc_email,
                'vc_senha' =>  'sem senha',
                'it_id_utilizador' => $id_user,
                'dt_data_registro' => $escola->dt_data_registro,

            ]);
            $escola_actual=Escola::find($id);
            if($escola_anterior->vc_escola!=$escola_actual->vc_escola)
                $complemento=$escola_anterior->vc_escola.' para '.$escola_actual->vc_escola;
            else
                $complemento=$escola_anterior->vc_escola;

            $this->Logger->Log('info', 'Actualizou a escola '.$complemento);
            return redirect()->route('escolas')->with('status', 1);
        }
    }

    public function eliminar($id)
    {
        Escola::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou a escola '.Escola::find($id)->vc_escola);
        return redirect()->back()->with('eliminar', 1);
        //return redirect()->route('escolas');
    }
}