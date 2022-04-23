




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
                <img src="/site/assets/images/logo-v1.png" alt="">
              </div>
              <h4>Olá! vamos começar</h4>
              <h6 class="font-weight-light">Faça login para continuar.</h6>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <input type="text"  name="vc_email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Nome de usuário">
                </div>
                <div class="form-group">
                  <input type="password" name="password"  class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Palavra passe">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Entrar</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Mantenha-me conectado
                    </label>
                  </div>
                  <a href="{{ route('palavra_passe.recuperar') }}" class="auth-link text-black">Esqueceu a senha?</a>
                </div>
                {{-- <div class="mb-2">
                  <button type="submit" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>
                    Conecte-se usando o facebook
                  </button>
                </div> --}}
                <div class="text-center mt-4 font-weight-light">
                    Não tem uma conta? <a href="{{ route('register') }}" class="text-primary">Criar</a>
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
  @include('layouts._includes.Footer')
</body>

</html>
