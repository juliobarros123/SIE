<div class="cabecalho">
    <img src="site/assets/images/SIE.png" alt="" id="logo">
    <h3 class="titulo">SISTEMA INCUBADOR DE EMPRESA</h3>
    <h2 class="titulo">RELATÓRIO DE VAGA</h2>
</div>

<div id="section">
    <h3 class="titulo ">Lista de candidatos {{ $estado }} por vagas</h3>
    <p style="">Vaga: <strong>{{ $vaga->funcao }}</strong> </p>
    <table class="table" style="margin-top: -10px">
        <tr>
            <th>Candidato</th>
            <th>E-mail</th>
            <th>Número</th>
            {{-- <th>Pendentes</th>
            <th>Aceites</th>
            <th>Não eceites</th> --}}
        </tr>
        </tr>
        @foreach ($candidatos as $item)
            <tr>
                <td>
                    {{$item->primeiro_nome}} {{$item->ultimo_nome}}
                </td>
                
                <td>
                    {{ $item->email }}
                </td>


                <td>
                    {{ $item->telefone }}
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
