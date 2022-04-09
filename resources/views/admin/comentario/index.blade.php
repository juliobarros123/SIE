@extends('layouts._includes.Header')
@section('titulo', 'FeedBacks')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">





                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">FeedBacks</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                          
                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                   
                                        <th>
                                          Nome 
                                        </th>
                                        <th>
                                             E-mail
                                         </th>
                                        <th>
                                          Assunto
                                        </th>
                                       
                                    
                                        <th>
                                            Mensagem
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
                                        @foreach($comentarios as $comentario)
                                        <tr>
                                           
                                            <td > 
                                                {{$comentario->nome}}
                                            </td>
                                         
                                           
                                            <td >
                                                {{$comentario->email}}  
                                            </td>
                                            <td >
                                                {{$comentario->assunto}}
                                            </td>
                                            <td >
                                                {{$comentario->mensagem}}
                                            </td>
                                            <td>
                                                @if ($comentario->estado==0)
                                                <label class="badge badge-danger">Pendente</label>
                                                @endif
                                                @if($comentario->estado==1)
                                                <label class="badge badge-info">Reprovado</label>
                                                @endif
                                                @if($comentario->estado==2)
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
                                                           
                                                            @if($comentario->estado!=1)
                                                            <a class="dropdown-item" href="{{ route('admin.comentarios.reprovar', ['slug_comentario' => $comentario->slug]) }}">Reprovar</a>
                                                          @endif
                                                            
                                                          @if($comentario->estado!=2)
                                                          <a class="dropdown-item" href="{{ route('admin.comentarios.aprovar', ['slug_comentario' => $comentario->slug]) }}">Aprovar</a> 
                                                          @endif
                                                       
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
                'FeedBack aprovado com sucesso!',
                '',
                'success'
            )
        </script>
    @endif

    @if (session('reprovado'))
    <script>
        Swal.fire(
            'FeedBack reprovado com sucesso!',
            '',
            'success'
        )
    </script>
@endif
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
