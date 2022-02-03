<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Escola;
class AlunosPorProvincia extends BaseChart
{
    public ?string $name = 'Aluno';

public ?string $routeName = 'Aluno';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        
        
        //$escolas = DB::table('escolas')->select('escolas.it_id_provincia')->groupBy('it_id_provincia')->get();

        $escolas = DB::table('matriculas')
        ->join('users','matriculas.it_id_utilizador','users.id')
        ->join('escolas','matriculas.it_id_escola','escolas.id')
        ->select('escolas.it_id_provincia',DB::raw('count(matriculas.it_id_utilizador) as quantidade'))
        ->groupBy('it_id_provincia')
        ->get();

       // $escolas =Escola::query('select it_id_provincia from escolas group by it_id_provincia')->get();
        
        $labels = [];
        $count = [];
        foreach ($escolas as $sport){
            if($sport->it_id_provincia==1)
            $sport->it_id_provincia="Sem Escola";
            array_push($labels,$sport->it_id_provincia);
        }
        //$values = Escola::with('users' )->get();
        //$values = Escola::query('select it_id_provincia from escolas group by it_id_provincia')->with('users' )->get();
        foreach ($escolas as $item) {
            array_push($count,$item->quantidade);
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $count);
    }
}