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
                                <a href="{{ url('/') }}"> <img src="/site/assets/images/logo-v1.png"
                                        alt="logo"></a>

                            </div>


                            <h4>Novo aqui?</h4>
                            <h6 class="font-weight-light">
                                A inscrição é fácil. Leva apenas alguns passos</h6>
                            <form class="pt-3" action="{{ route('users.salvar') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="profile_photo_path" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" id="btn-upload"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input required type="text" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Nome de usuário"
                                        alert="Precho este campo 1" name="nome">
                                </div>

                                <div class="form-group">
                                    <input required type="text" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Primeiro nome"
                                        alert="Precho este campo 2" name="primeiro_nome">
                                </div>

                                <div class="form-group">
                                    <input required type="text" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Ultimo nome"
                                        alert="O último nome deve ser preenchido" name="ultimo_nome">
                                </div>
                                <div class="form-group">
                                    <input required type="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email" name="email"
                                        alert="Precho este campo 3">
                                </div>

                                <div class="form-group">
                                    <input required type="number" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Telefone" name="telefone" maxlength="9"
                                        alert="Precho este campo 4">
                                </div>
                                <div class="form-group">
                                    <select required class="form-control form-control-lg" id="exampleFormControlSelect2"
                                        valueExcept="Gênero:" alert="Precho este campo 5" name="genero">
                                        <option disabled selected> Gênero: </option>

                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control form-control-lg"
                                        alert="Precho este campo 6" id="exampleInputPassword1" placeholder="Senha">
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password_confirm" alert="Precho este campo 7"
                                        class="form-control form-control-lg" id="exampleInputPassword1"
                                        placeholder="Confirmar senha">
                                </div>
                                <div class="mb-4">
                                    {{-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Eu concordo com todos os Termos e Condições
                                        </label>
                                    </div> --}}
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text"
                                        id="btn-escrever">INSCREVER-SE</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">

                                    já tem uma conta? <a href="{{ route('login') }}"
                                        class="text-primary">Conecte-se</a>
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
    <!-- container-scroller -->

    <!-- endinject -->

    <script src="/js/datatables/jquery-3.5.1.js"></script>
    <script src="/js/sweetalert2.all.min.js"></script>

    @if (session('senha'))
        <script>
            Swal.fire(
                'Erro',
                'A senha não bate com a confimação!',
                'error'
            )
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire(
                'Falha ao cadastrar usuário!',
                'Email ou nome de usuário já existe ',
                'error'
            )
        </script>
    @endif
    <script></script>
    <script>
        var camposEmpty = [];

        function insertInputsEmpty(camposEmpty, value) {
            console.log(camposEmpty);
            if (!elementoExiste(camposEmpty, value)) {
                camposEmpty.push(value);
            } else {

            }


        }

        function elementoExiste(array, value) {
            for (let index = 0; index < array.length; index++) {
                if (array[index] == value) {
                    return 1
                }

            }


            return 0;
        }
        $("#btn-escrever").attr('disabled', true);
        $("form div input").on('keyup', function() {
            checkValueInput();

        });


        $("form div select").on('change', function() {
            checkValueSelect();


        });

        function campoEmpty(campo) {
            if (campo.value == "") {

                mudarEstadoBtn(true);
                return 0
            } else {
                return 1;
            }

        }
        // function selectEmpty(select) {
        //     if (input.value == "") {


        //         mudarEstadoBtn(true);
        //         return 0
        //     }else{
        //         return 1;
        //     }

        // }

        function mudarEstadoBtn(estado) {
            if (estado == true) {

                $("#btn-escrever").attr('disabled', estado);
            } else {
                $("#btn-escrever").attr('disabled', estado);


            }

        }

        function checkValueSelect() {
            console.log("chegou");
            var selects = $("form div select");
            for (let index = 0; index < selects.length; index++) {
                const element = selects[index];
                controlSelectVazio = campoEmpty(element);

                var name = element.getAttribute('name');

                var alert = element.getAttribute('alert');

                if (controlSelectVazio == 0) {
                    $("label[for=" + name + "]").empty();

                    $("select[name=" + name + "]").before("<label for=" + name + " >" + alert + "</label>");

                } else {

                }

            }

        }

        function checkValueInput() {
            var controlInputVazio = 0;
            var inputs = $("form div input");
            for (let index = 0; index < inputs.length; index++) {
                const element = inputs[index];
                controlInputVazio = campoEmpty(element);
                var name = element.getAttribute('name');
                var alert = element.getAttribute('alert');
                if (controlInputVazio == 0) {



                    $("label[for=" + name + "]").empty();

                    $("input[name=" + name + "]").before("<label for=" + name + " >" + alert + "</label>");
                       insertInputsEmpty(camposEmpty,name);

                } else {
                    $("label[for=" + name + "]").empty();

                }

            }

            if (controlInputVazio == 1) {
                mudarEstadoBtn(false);
            }



        }
        // function campoEmpty(campo) {

        //     valueExcept=campo.getAttribute('valueExcept');

        //     if ( campo.value==valueExcept ) {


        //         mudarEstadoBtn(true);
        //         return 0
        //     }else{
        //         return 1;
        //     }

        // }
    </script>
    @include('layouts._includes.Footer')
</body>


</html>
