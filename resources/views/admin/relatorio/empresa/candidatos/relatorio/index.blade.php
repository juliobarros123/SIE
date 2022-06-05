<div class="cabecalho">
    <img src="site/assets/images/SIE.png" alt="" id="logo">
    <h3 class="titulo">SISTEMA INCUBADOR DE EMPRESA</h3>
    <h2 class="titulo">RELATÓRIOS DE VAGA</h2>
</div>

<div id="section">
    <h3 class="titulo ">Relatório de candidatos inscritos por vagas</h3>
       <h3 class="titulo ">Empresa: <strong>{{$nomeEmpresa}}</strong>  Vaga: <strong>{{$vaga}}</strong>  </h3>
    <table class="table">
        <tr>
            <th>Vaga</th>
            <th>Inscritos</th>
            <th>Masculino</th>
            <th>Feminino</th>
            {{-- <th>Pendentes</th>
            <th>Aceites</th>
            <th>Não eceites</th> --}}
        </tr>
        </tr>
      @php
          $ttlMasc=0;
          $ttlFem=0;
      @endphp
        @foreach ($candidatosVagas as $item)
            <tr>
                <td>
                    {{ $item->funcao }}
                </td>
                <td>
                    {{ $item->candidatos }}
                </td>
                <td>
                    @php
                        $ttlMasc+=ttlMascCandidatos( $item->id);
                    @endphp
                    {{ttlMascCandidatos( $item->id)}}
                </td>
                <td>
                    @php
                        $ttlFem+=ttlFemCandidatos( $item->id);
                    @endphp
                    {{ttlFemCandidatos( $item->id)}}
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

        <tr>
            <td>
              Total
            </td>
            <td>
                {{$candidatosVagas->sum('candidatos')}}
              </td>
              <td>
                {{$ttlMasc}}
              </td>
              <td>
                {{$ttlFem}}
              </td>
        </tr>
        </tbody>
    </table>
</div>
