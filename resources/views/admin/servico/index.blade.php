@extends('layouts._includes.Header')
@section('titulo', 'Servicos')
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
                                    
                                        <form class="forms-sample" id="ajaxform" action="{{ route('admin.servicos.cadastrar') }}" method="POST" enctype="multipart/form-data"> 
                                          @csrf
                                          
                                          @include('forms._form-servico.index')
                                        
                                        
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
                            <h4 class="card-title">Serviços</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                          
                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                            
                                            <th>
                                                Id
                                            </th>
                                        <th>
                                            Serviço
                                        </th>
                                        <th>
                                            Empresa
                                        </th>
                                     
                                       
                                      
                                        
                                        <th>
                                            Açções
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($servicos as $servico)
                                        <tr>
                                            <td > 
                                                {{$servico->id}}
                                            </td>
                                         
                                           
                                            <td > 
                                                {{$servico->servico}}
                                            </td>
                                           
                                            <td > 
                                                {{$servico->nome}}
                                            </td>
                                           
                                       
                                        
                                           <td>
                                                <div class="btn-group-vertical" role="group" aria-label="Basic example">

                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">Dropdown</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item " href="{{ route('admin.servicos.editar',['slug'=>$servico->slug]) }}">Editar</a>
                                                            <a class="dropdown-item" data-confirm="Tem certeza que deseja eliminar?" href="{{ route('admin.servicos.eliminar',['slug'=>$servico->slug]) }}">Eliminar</a>
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
                'Servico cadastrada com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('update'))
    <script>
        Swal.fire(
            'Servico editada com sucesso!',
            '',
            'success'
        )
    </script>
@endif

@if (session('delete'))
<script>
    Swal.fire(
        'Servico eliminada com sucesso!',
        '',
        'success'
    )
</script>
@endif
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
