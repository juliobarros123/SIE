

@extends('layouts._includes.Header')
@section('titulo', 'Relatório de vagas por empresa')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Relatório de vagas por empresa</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                            <form  action="{{ route('admin.utilizadores.atualizar', $user->slug) }}" method="post"
                                >
                           
                                 @method('post')
                                 @csrf
                               
                                
                                 <div class="form-group">
                                    <label for="exampleSelectGender">Empresa:</label>
                                    <select class="form-control" id="exampleSelectGender" name="id_empresa">
                                        <option selected disabled>Seleciona a empresa:</option>
                                
                                      
                                        @foreach ($empresas as $item)
                                        <option value="{{$item->id}}">{{ $item->nome }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Remuneração:</label>
                                    <select class="form-control" id="exampleSelectGender" name="remuneracao">
                                       
                                        <option selected value="{{ isset($vaga) ? $vaga->remuneracao : '' }}">
                                            {{ isset($vaga) ? $vaga->remuneracao : 'Seleciona um opção:' }}
                                        </option>
                                        <option value="Remunerado">Remunerado</option>
                                        <option value="Nao-remunerado">Não remunerado</option>
                                
                                        
                                       
                                    </select>
                                </div>
                           
                                
                        
                      
                          
                               
                                <input class="btn btn-primary mr-2 "  type="submit"
                                    value="Gerar">
                                {{-- <button class="btn btn-light">Cancel</button> --}}
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
        <script src="/js/sweetalert2.all.min.js"></script>

  


        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
