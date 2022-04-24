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
                                    
                                        <form class="forms-sample" id="ajaxform" action="{{ route('admin.empresas.cadastrar') }}" method="POST" enctype="multipart/form-data"> 
                                          @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Logotipo:</label>
                                                <input type="file" class="form-control" id="exampleInputUsername1"
                                                    placeholder="Digita o nome de usuário" name="logotipo">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nome:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Digita o nome da empresa" name="nome">
                                            </div>
                                          
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">E-mail:</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Digita o email da empresa" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Telefone:</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Digita o número de telefone da empresa" name="telefone" maxlength="8"> 
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIF:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Digita o NIF da empresa" name="nif" maxlength="14">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Endereço:</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Digita o endereço da empresa" name="endereco">
                                            </div>
                                            
                                          

                                            {{-- <div class="form-check form-check-flat form-check-primary">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                    Remember me
                                                    <i class="input-helper"></i></label>
                                            </div> --}}
                                            <input class="btn btn-primary mr-2 "  type="submit"
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
                            <h4 class="card-title">Empresas</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                          
                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                        <th>
                                            Logotipo
                                        </th>
                                        <th>
                                          Nome 
                                        </th>
                                        <th>
                                             Propreitário
                                         </th>
                                        <th>
                                          NIF
                                        </th>
                                        <th>
                                            E-mail
                                        </th>
                                        <th>
                                            Telefone
                                        </th>
                                  
                                    
                                        <th>
                                            Endereço
                                        </th>
                                        <th>
                                            Açções
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empresas as $empresa)
                                        <tr>
                                            <td >
                                                {{-- {{$empresa->logotipo}} --}}
                                                <img src="{{ url("storage/{$empresa->logotipo}") }}" alt=" {{$empresa->nome}}"/>
                                            </td>
                                            <td > 
                                                {{$empresa->nome}}
                                            </td>
                                         
                                           
                                            <td >
                                                {{$empresa->primeiro_nome}}  {{$empresa->ultimo_nome}}
                                            </td>
                                            <td >
                                                {{$empresa->nif}}
                                            </td>
                                            <td >
                                                {{$empresa->email}}
                                            </td>
                                            <td >
                                                {{ $empresa->telefone }}
                                            </td>
                                            <td >
                                                {{ $empresa->endereco
                                                 }}
                                            </td>
                                        
                                      <td>
                                                <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">Dropdown</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item " href="{{ route('admin.empresas.editar',['slug'=>$empresa->slug]) }}">Editar</a>
                                                            <a class="dropdown-item" data-confirm="Tem certeza que deseja eliminar?" href="{{ route('admin.empresas.eliminar',['slug'=>$empresa->slug]) }}">Eliminar</a>
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
       
        @if (session('status'))
        <script>
            Swal.fire(
                'Empresa cadastrada com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('update'))
    <script>
        Swal.fire(
            'Empresa editada com sucesso!',
            '',
            'success'
        )
    </script>
@endif

@if (session('delete'))
<script>
    Swal.fire(
        'Empresa eliminada com sucesso!',
        '',
        'success'
    )
</script>
@endif
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
