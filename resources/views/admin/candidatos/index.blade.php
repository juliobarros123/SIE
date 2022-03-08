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
                            <h4 class="card-title">Candidatos da vaga <strong>{{ $vaga->funcao }}</strong> </h4>
                            {{-- <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div> --}}

                            <div class="table-responsive ">
                                <table class="table table-striped ">
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
                                              


                                                <td>
                                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown">Dropdown</button>
                                                            <div class="dropdown-menu">
                                                               
                                                                {{-- <a class="dropdown-item"
                                                                    data-confirm="Tem certeza que deseja eliminar?"
                                                                    href="{{ route('admin.candidatos.eliminar', ['slug' => $vaga->slug]) }}">Eliminar</a> --}}
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
