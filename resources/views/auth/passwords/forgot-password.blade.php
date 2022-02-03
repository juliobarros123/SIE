







<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('titulo')</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="/admin/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="/admin/vendors/base/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="/admin/css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="/admin/images/favicon.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
      </head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="/admin/images/logo.svg" alt="logo">
              </div>
              <h4>Verificar o Email</h4>
              <h6 class="font-weight-light">Insere o teu Email para verificação da sua conta.</h6>
              <form method="POST" action="{{ route('palavra_passe.redefinir') }}">
                @csrf
                <div class="form-group">
                    <label class="label texto-azul col-md-12 " for="email ">Endereço de Email</label>
                    <input type="email" class=" form-control border-azul shadow-custom" name="email" id="email" required placeholder="Coloca aqui o teu Email">
                </div>
            
                <div class="col-md-12 col-md-offset-0 col-sm-4 col-sm-offset-4 text-center">
                    {{-- <input  class="btn btn-primary " value=""> --}}
                    <input type="submit" class="btn btn-primary btn-filled" value="Buscar">
                </div>
                
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  
<script src="/js/datatables/jquery-3.5.1.js"></script>
<script src="/js/sweetalert2.all.min.js"></script>

    @if (session('email_nao_encontrado'))
        <script>
            Swal.fire(
                'Não econtramos uma conta associada á este Email!',
                '',
                'error'
            )
        </script>
    @endif

  @include('layouts._includes.Footer')
</body>

</html>
