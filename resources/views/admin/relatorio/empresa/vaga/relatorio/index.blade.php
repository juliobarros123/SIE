<div class="cabecalho">
    <img src="site/assets/images/SIE.png" alt="" id="logo">
    <h3 class="titulo">SISTEMA INCUBADOR DE EMPRESA</h3>
    <h2 class="titulo">RELATÓRIOS DE VAGA</h2>
</div>

<div id="section">
    <h3 class="titulo ">Relatório de vagas por empresa</h3>
    <table class="table">
        <tr>
            <th>Empresa</th>
            <th>Qt. vagas</th>
            {{-- <th>Pendentes</th>
            <th>Aceites</th>
            <th>Não eceites</th> --}}
        </tr>
        </tr>
        @foreach ($empresasVagas as $item)
            <tr>
                <td>
                    {{ $item->nome }}
                </td>
                <td>
                    {{ $item->vagas }}
                </td>
                {{-- <td>
                    {{ $candidatosVagas->where('funcao',$item->funcao)->where('estado',0)->count() }}
                </td>
                <td>
                    {{ $candidatosVagas->where('funcao',$item->funcao)->where('estado',2)->count() }}
                </td>
                <td>
                    {{ $candidatosVagas->where('funcao',$item->funcao)->where('estado',1)->count() }}
                </td> --}}

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
