












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
              <h4>Redifinir palavra passe</h4>
              <h6 class="font-weight-light">Insira a palavra passe nova e confirma no campo de confirmação de
                palavra passe</h6>
              <form method="POST" action="{{ route('palavra_passe.registar_palavra_passe') }}">
                @csrf


                <div class="row">


                    <div class="col-md-12 justify-content-center d-flex">
                        <div class="form-group col-md-12">
                            <label class="label texto-azul col-md-12 text-left" for="password" id="span-senha" > Nova
                                palavra passe</label>
                            <div class="div_input_password ">
                                <input class="form-password  border-azul col-md-12 form-control" id="password"
                                    type="password" name="password" id="password"
                                    placeholder="Coloca aqui a nova palavra passe" minlength="8" required
                                    autocomplete="off">
                                <span class="lnr lnr-eye"></span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 justify-content-center d-flex">
                        <div class="form-group col-md-12">
                            <label class="label texto-azul col-md-12 text-left " for="email">Confirmar
                                palavra passe</label>
                            <div class="div_input_password">
                                <input id="password_confirm" type="password"
                                    class="form-password border-azul form-control" name="confirmed" required
                                    placeholder="Confirma aqui a nova palavra passe" minlength="8">
                            </div>
                            <span class="lnr lnr-eye view-pass-confirm"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-md-offset-0 col-sm-4 col-sm-offset-4 text-center">
                        {{-- <input  class="btn btn-primary " value=""> --}}
                        <input type="submit" class="btn btn-primary btn-filled" value="Confirmar">
                    </div>

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
  @if (session('senha_nao_confirmada'))
      <script>
          Swal.fire(
              'A senha não bate com a confimação!',
              '',
              'error'
          )
      </script>
  @endif
  @include('layouts._includes.Footer')
</body>

</html>






