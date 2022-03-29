@extends('layouts._includes.Header')
@section('titulo', 'Empresas')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Preencha os campos</h5>
                                <div class=" d-flex justify-content-end">
                                    <button type="button" class="close d-flex justify-content-start " data-dismiss="modal"
                                        aria-label="Fechar">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">




                                    <div class="card-body">

                                        <form class="forms-sample" id="ajaxform"
                                            action="{{ route('admin.vagas.cadastrar') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                      @include('forms._form-vaga.index')


                                            {{-- <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                    Remember me
                                                    <i class="input-helper"></i></label>
                                            </div> --}}
                                            <input class="btn btn-primary mr-2 " type="submit" value="Efectuar cadastro">
                                            {{-- <button class="btn btn-light">Cancel</button> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vagas</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>

                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                Capa
                                            </th>
                                            <th>
                                                Função
                                            </th>
                                            <th>
                                                Quantidade
                                            </th>
                                            <th>
                                                Tipo de vaga
                                            </th>
                                            <th>
                                                Remuneração
                                            </th>
                                            <th>
                                                Data de validade
                                            </th>

                                            <th>
                                                Açções
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vagas as $vaga)
                                            <tr>
                                                <td>
                                                    <img src="{{ url("storage/{$vaga->capa}") }}" alt=" {{$vaga->funcao}}"/>
                                                </td>

                                                <td>
                                                    {{ $vaga->funcao }}
                                                </td>
                                               
                                                <td>
                                                    {{ $vaga->quantidade }}
                                                </td>

                                                <td>
                                                    {{ $vaga->tipo_vaga }}
                                                </td>
                                                <td>
                                                    {{ $vaga->remuneracao }}
                                                </td>
                                                <td>
                                                    {{ $vaga->datalimite }}
                                                </td>


                                                <td>
                                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown">Dropdown</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item "
                                                                    href="{{ route('admin.vagas.editar', ['slug' => $vaga->slug]) }}">Editar</a>
                                                                <a class="dropdown-item"
                                                                    data-confirm="Tem certeza que deseja eliminar?"
                                                                    href="{{ route('admin.vagas.eliminar', ['slug' => $vaga->slug]) }}">Eliminar</a>
                                                                    <a class="dropdown-item"
                                                                   
                                                                    href="{{ route('admin.vagas.candidatos', ['slug_vaga' => $vaga->slug]) }}">Candidatos</a>
                                                                   
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
