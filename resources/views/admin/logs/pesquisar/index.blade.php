

@extends('layouts._includes.Header')
@section('titulo', 'Pesquisar Logs')
@section('conteudo')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pesquisar Logs</h4>
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end">
                                <i class="ti-plus" data-toggle="modal" data-target=".bd-example-modal-lg"></i>
                            </div>
                            <form action="{{ route('admin.logs.visualizar') }}" method="post" 
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
            
            
            
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectGender">Utilizador:</label>
                                    <select class="form-control" id="exampleSelectGender" name="id_utilizador">
                                        <option selected disabled>Seleciona o utilizador:</option>
                                        <option value="Todos">Todos:</option>
                                    @foreach ($utilizadores as $utilizador)
                                        <option value="{{ $utilizador->id }}">
                                            {{ $utilizador->primeiro_nome . ' ' . $utilizador->ultimo_nome }}
                                        </option>
                                    @endforeach
                                    </select>
            
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleSelectGender">Ano:</label>
                                    <select class="form-control" id="exampleSelectGender" name="ano">
                                        <option selected disabled>Seleciona o ano:</option>
                                        <option value="Todos">Todos:</option>
                                        <?php foreach(anos() as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
            
                                </div>
            
            
            
                            </div>
            
                            <input class="btn btn-primary mr-2 "  type="submit"
                            value="Pesquisar">
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
