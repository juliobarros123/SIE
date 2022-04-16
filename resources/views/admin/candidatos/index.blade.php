@extends('layouts._includes.Header')
@section('titulo', 'Empresas')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">




                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Candidatos  <strong>
                                {{-- {{ $vaga->funcao }} --}}
                            </strong> </h4>
                            {{-- <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div> --}}

                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                Fotografia
                                            </th>
                                            <th>
                                                Nome
                                            </th>
                                            <th>
                                                E-mail
                                            </th>
                                            <th>
                                              Telefone
                                            </th>
                                        
                                            <th>
                                              {{$vaga->requisito1=="0"?'Requisito pendente':$vaga->requisito1}}
                                              </th>
                                              <th>
                                                 {{$vaga->requisito2=="0"?'Requisito pendente':$vaga->requisito2}}
                                              </th>
                                              <th>
                                                 {{$vaga->requisito3=="0"?'Requisito pendente':$vaga->requisito3}}
                                              </th>
                                              <th>
                                                 {{$vaga->requisito4=="0"?'Requisito pendente':$vaga->requisito4}}
                                              </th>
                                            <th>
                                                Estado
                                              </th>
                                            <th>
                                                Açções
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach ($candidatos as $candidato)
                                            <tr>
                                                <td>
                                                    <img src="{{ url("storage/{$candidato->profile_photo_path}") }}" alt=" {{$candidato->funcao}}"/>
                                                </td>

                                                <td>
                                                    {{$candidato->primeiro_nome}} {{$candidato->ultimo_nome}}
                                                </td>
                                                
                                                <td>
                                                    {{ $candidato->email }}
                                                </td>

                                                <td>
                                                    {{ $candidato->telefone }}
                                                </td>
                                              
                                                <td >
                                                    {{ $candidato->requisitoCandidato1?'Sim':'Não' }}
                                                </td>
                                                <td >
                                                    {{ $candidato->requisitoCandidato2?'Sim':'Não'  }}
                                                </td>
                                              
                                                <td >
                                                    {{ $candidato->requisitoCandidato3?'Sim':'Não'  }}
                                                </td>
                                              
                                                <td >
                                                     {{ $candidato->requisitoCandidato4?'Sim':'Não'  }}
                                                </td>
                                              
                                             
                                                <td>
                                                    @if ($candidato->estado==0)
                                                    <label class="badge badge-danger">Pendente</label>
                                                    @endif
                                                    @if($candidato->estado==1)
                                                    <label class="badge badge-info">Reprovado</label>
                                                    @endif
                                                    @if($candidato->estado==2)
                                                    <label class="badge badge-success">Aprovado </label>
                                                    @endif
                                                   
                                                
                                                </td>

                                                <td>
                                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown">Dropdown</button>
                                                            <div class="dropdown-menu">
                                                               
                                                                @if($candidato->estado!=1)
                                                                <a class="dropdown-item" href="{{ route('admin.vagas.candidatos.reprovar', ['slug_candidato' => $candidato->slug]) }}">Reprovar</a>
                                                              @endif
                                                                
                                                              @if($candidato->estado!=2)
                                                              <a class="dropdown-item" href="{{ route('admin.vagas.candidatos.aprovar', ['slug_candidato' => $candidato->slug]) }}">Aprovar</a> 
                                                              @endif
                                                              <a class="dropdown-item" target="_blanck" href="{{ url("storage/{$candidato->curriculo}") }}">Ver currículo</a> 
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:/admin/imagespartials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a
                        href="https://www.templatewatch.com/" target="_blank">Templatewatch</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                        class="ti-heart text-danger ml-1"></i></span>
            </div>

        </footer>
        @if (session('aprovado'))
        <script>
            Swal.fire(
                'Candidato aprovado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('reprovado'))
    <script>
        Swal.fire(
            'Candidato reprovado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
    

        @if (session('status'))
            <script>
                Swal.fire(
                    'Vaga cadastrada com sucesso!',
                    '',
                    'success'
                )
            </script>
        @endif
        

        @if (session('update'))
            <script>
                Swal.fire(
                    'Vaga editada com sucesso!',
                    '',
                    'success'
                )
            </script>
        @endif

        @if (session('delete'))
            <script>
                Swal.fire(
                    'Vaga eliminada com sucesso!',
                    '',
                    'success'
                )
            </script>
        @endif
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
