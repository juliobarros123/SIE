<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HorarioDeEstudo;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\UtilizadorRepository;
use App\Models\Logger;


class HorarioDeEstudoController extends Controller
{
    protected $user;
    private $Logger;

    public function __construct(UtilizadorRepository $user)
    {

        $this->user = $user;
        $this->Logger = new Logger();
    }

    public function Cadastrar()
    {
        return view("admin.horario_de_estudo.cadastrar.index");
    }

    public function store(Request $request)
    {

        // dd($request);
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
            $upload = $request->vc_pdf->storeAs('public/pdfHorarioEstudo', $nameFile);
            $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {

                HorarioDeEstudo::create([
                    'vc_nivel' => $request->vc_nivel,
                    'vc_pdf' => $upload,
                ]);
            }
        }

        $this->Logger->Log('info', 'Adicionou Um horario');
        return redirect()->route('admin.HorarioDeEstudo.listar')->with('status', 1);
    }

    public function listar(){
        $data['horarios'] = HorarioDeEstudo::all();
        return view("admin.horario_de_estudo.index",$data);
    }
    public function delete($id)
    {
        HorarioDeEstudo::find($id)->delete();
        return redirect()->route('admin.HorarioDeEstudo.listar');

    }


    public function update(Request $request, $id){


        // dd($request);
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
            $upload = $request->vc_pdf->storeAs('public/pdfHorarioEstudo', $nameFile);
            $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {

                HorarioDeEstudo::find($id)->update([
                    'vc_nivel' => $request->vc_nivel,
                    'vc_pdf' => $upload,
                ]);
            }
        }

        $this->Logger->Log('info', 'Atualizou Um horario');
        return redirect()->route('admin.HorarioDeEstudo.listar')->with('status', 1);
    }

    public function editar($id)
    {

     $data['horario'] =  HorarioDeEstudo::find($id);
    //  dd($data['horario']);
     return view("admin.horario_de_estudo.editar.index",$data);
    }
}
