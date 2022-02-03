<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Classe;
use Illuminate\Support\Facades\DB;

class AlunoClasseChart extends BaseChart
{   
    public ?string $name = 'my_chart';

    public ?string $routeName = 'my_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $classes = DB::table('classes')->get();
        $labels = [];
        $count = [];
        foreach ($classes as $sport){
            array_push($labels,$sport->vc_classe." ªclasse");
        }
        $values = Classe::with('users' )->get();
        foreach ($values as $item) {
            array_push($count,$item->users->count());
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $count);
    }
}