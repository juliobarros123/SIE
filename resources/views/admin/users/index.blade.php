@extends('layouts._includes.Header')
@section('titulo', 'Lista de utilizadores')
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
                                        {{-- <h4 class="card-title">Default form</h4> --}}
                                        {{-- <p class="card-description">
                                            Basic form layout
                                        </p> --}}
                                        <form class="forms-sample" id="ajaxform">

                                            @include('forms._formUser.index')
                                            {{-- <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                    Remember me
                                                    <i class="input-helper"></i></label>
                                            </div> --}}
                                            <input class="btn btn-primary mr-2 " onclick="cadastrar()" type="button"
                                                value="Efectuar cadastro">
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
                            <h4 class="card-title">Utilizadores</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                            <form id="form_tr_editar" >
                                @method('PUT')
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable-1">
                                    <thead>

                                        <th>
                                            Usuário
                                        </th>
                                        <th>
                                          Nome de usuário
                                        </th>
                                        <th>
                                            Primeiro nome
                                         </th>
                                        <th>
                                          Ultimo nome
                                        </th>
                                        <th>
                                            E-mail
                                        </th>
                                        <th>
                                            Telefone
                                        </th>
                                        <th>Gênero</th>
                                        <th>
                                            Tipo de utilizador
                                          </th>
                                        {{-- <th>
                                          Utilização
                                        </th> --}}
                                       
                                        <th>
                                            Açções
                                        </th>

                                    </thead>
                                    <tbody>
                                        @foreach($utilizadores as $utilizador)
                                        <tr id="tr{{$utilizador->id}}" >
                                            <td class="py-1" id="profile_photo_path{{$utilizador->id}}">
                                                <img src="/admin/images/faces/face1.jpg" alt="image" />
                                            </td>
                                            <td class="customerIDCell" id="nome{{$utilizador->id}}" > 
                                                {{$utilizador->nome}}
                                            </td>
                                         
                                            <td id="primeiro_nome{{$utilizador->id}}">
                                                {{$utilizador->primeiro_nome}}
                                            </td>
                                            <td id="ultimo_nome{{$utilizador->id}}">
                                                {{$utilizador->ultimo_nome}}
                                            </td>
                                            <td id="email{{$utilizador->id}}">
                                                {{$utilizador->email}}
                                            </td>
                                            <td id="telefone{{$utilizador->id}}">
                                                {{$utilizador->telefone}}
                                            </td>
                                            <td id="genero{{$utilizador->id}}">
                                                {{ $utilizador->genero }}
                                            </td>
                                            <td>
                                                {{$utilizador->tipoUtilizador}}
                                            </td>
                                            {{-- <td>
                                                May 15, 2015
                                            </td> --}}
                                            <td>
                                                <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">Dropdown</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item " href="{{ route('admin.utilizadores.editar',['slug'=>$utilizador->slug]) }}">Editar</a>
                                                            <a class="dropdown-item" data-confirm="Tem certeza que deseja eliminar?" href="{{ route('admin.utilizadores.eliminar',['slug'=>$utilizador->slug]) }}">Eliminar</a>
                                                     
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </form>
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
        <script>
          

        </script>
        @if (session('update'))
        <script>
            Swal.fire(
                'Utilizador editado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('delete'))
    <script>
        Swal.fire(
            'Utilizador eliminado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
    
{{--         
        <script>
            function cadastrar() {
                var form = $('#ajaxform').serialize();
                event.preventDefault();


                $.ajax({
                    url: "{{ route('admin.utilizadores.salvar') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: form,
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                'Utilizador cadastrado com sucesso',
                '',
                'success'
            );  
          
                        $('#utilizadoresTable').append($('<tr id="tr'+response.id+'">')
                            .append($('<td  class="py-1">').append(
                                ' <img src="/admin/images/faces/face7.jpg" alt="image" />'))
                            .append($('<td id="nome'+response.id+'" onclick="pegarTexto('+response.nome+')">').append(''+response.nome))
                                .append($('<td id="primeiro_nome'+response.id+'">').append(''+response.primeiro_nome))
                                    .append($('<td id="nome'+response.ultimo_nome+'">').append(''+response.ultimo_nome))
                                        .append($('<td>').append(''+response.email))
                                            .append($('<td>').append(''+response.telefone))
                                                .append($('<td>').append(''+response.genero))
                                                .append($('<td>').append(''+response.tipoUtilizador))
                        
                        
                                .append($('<td>').append('<div class="btn-group-vertical"role="group" aria-label="Basic example"><div class="btn-group"><button type="button"class="btn btn-outline-secondary btn-sm dropdown-toggle"data-toggle="dropdown">Dropdown</button><div class="dropdown-menu"><a class="dropdown-item">Go back</a><a class="dropdown-item">Delete</a><a class="dropdown-item">Swap</a></div></div> </div>'))
                        );

                     

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
 



        </script> --}}

     
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
