
@extends('layouts._includes.Header')
@section('titulo', 'Logs de Actividade')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


            


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Logs de Actividade</h4>
                         
                          
                            <div class="table-responsive ">
                                <table class="table table-striped " id="myTable">
                                    <thead>
                                        <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Data 
                                        </th>
                                        <th>
                                           Utilizador
                                         </th>
                                        <th>
                                            Actividade
                                        </th>
                                       
                                       
                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                        <tr>
                                           
                                            <td > 
                                                {{$log->id}}
                                            </td>
                                         
                                           
                                      
                                            <td >
                                                {{  date('d-m-Y h:i:s', strtotime($log->created_at)) }}
                                             
                                            </td>
                                            <td >
                                                {{$log->primeiro_nome}}  {{$log->ultimo_nome}}
                                            </td>
                                            <td >
                                                {{$log->vc_descricao}}
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
