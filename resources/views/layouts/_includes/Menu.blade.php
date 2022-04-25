<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <a class="navbar-brand brand-logo mr-5" href="{{ route('sie') }}"><img src="/site/assets/images/logo-v1.png"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="/admin/images/logo-mini.svg"
                alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            {{-- <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="ti-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Pesquisar agora..."
                        aria-label="search" aria-describedby="search">
                </div>
            </li> --}}
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown mr-1">
                {{-- <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                    id="messageDropdown" href="#" data-toggle="dropdown">
                    <i class="ti-email mx-0"></i>
                </a> --}}
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                    <a class="dropdown-item">
                        <div class="item-thumbnail">
                            <img src="/admin/images/faces/face4.jpg" alt="image" class="profile-pic">
                        </div>
                        <div class="item-content flex-grow">
                            <h6 class="ellipsis font-weight-normal">David Grey
                            </h6>
                            <p class="font-weight-light small-text text-muted mb-0">
                                The meeting is cancelled
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item">
                        <div class="item-thumbnail">
                            <img src="/admin/images/faces/face2.jpg" alt="image" class="profile-pic">
                        </div>
                        <div class="item-content flex-grow">
                            <h6 class="ellipsis font-weight-normal">Tim Cook
                            </h6>
                            <p class="font-weight-light small-text text-muted mb-0">
                                New product launch
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item">
                        <div class="item-thumbnail">
                            <img src="/admin/images/faces/face3.jpg" alt="image" class="profile-pic">
                        </div>
                        <div class="item-content flex-grow">
                            <h6 class="ellipsis font-weight-normal"> Johnson
                            </h6>
                            <p class="font-weight-light small-text text-muted mb-0">
                                Upcoming board meeting
                            </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="ti-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notificações</p>
                        @foreach (notificacoes() as $notificacao)
                        @if($notificacao->tipo=='nova_vaga')
                    <a class="dropdown-item" href="{{url($notificacao->url)}}">
                        <div class="item-thumbnail">
                            <div class="item-icon bg-success">
                                <i class="ti-control-shuffle mx-0 "></i>
                            </div>
                        </div>
                    
                        
                            <div class="item-content">
                            <h6 class="font-weight-normal"> <?php echo $notificacao->notificacao?></h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                             {{ quantos_dias($notificacao->created_at) }}
                            </p>
                        
                        </div> 
                 

                       
                    </a>
                    @endif
                    @if($notificacao->id_destinatario==Auth::User()->id)
                    <a class="dropdown-item" href="{{url($notificacao->url)}}">
                        <div class="item-thumbnail">
                            @if ($notificacao->tipo=='CandidatoAceite')
                            <div class="item-icon bg-warning">
                                <i class="ti-face-smile mx-0"></i>
                            </div>
                         @elseif($notificacao->tipo=='nova_vaga')
                         <div class="item-icon bg-success">
                            <i class="ti-new-window  mx-0"></i>
                        </div>
                        @elseif($notificacao->tipo=='InscricaoVaga')
                        <div class="item-icon bg-success">
                            <i class="ti-info-alt mx-0 "></i>
                        </div>
                            @endif
                          
                        </div>
                    
                        
                            <div class="item-content">
                            <h6 class="font-weight-normal"> <?php echo $notificacao->notificacao?></h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                             {{ quantos_dias($notificacao->created_at) }}
                            </p>
                        
                        </div> 
                 

                       
                    </a>
                    @endif
                           @endforeach
              
                </div>
            </li>
            <li class="nav-item nav-profile dropdown"> @php
                $img = Auth::User()->profile_photo_path?Auth::User()->profile_photo_path:'';
            @endphp

                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  
                        <img src="{{ url("storage/{$img}") }}" alt="Imagem de Perfil" class="avatar">
                  
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-lg1">
                        <i class="ti-settings text-primary"></i>
                        Configuração
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" id="sessao"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        Sair
                    </a>


                </div>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
    </div>
    </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="ti-view-list"></span>
    </button>
    </div>
    <style>




.user-card-full {
    overflow: hidden
}


.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
    </style>

    <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                    <div class="w-100">




                        <div class="card-body">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">Perfil</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab" aria-controls="profile" aria-selected="false">Editar</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                        role="tab" aria-controls="contact" aria-selected="false">Palavra passe</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="page-content page-container" id="page-content">
                                        <div class="padding">
                                            <div class="row container d-flex justify-content-center">
                                                <div class="col-xl-12 col-md-12">
                                                    <div class=" user-card-full">
                                                        <div class="row m-l-0 m-r-0">
                                                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                                                <div class="card-block text-center text-white">
                                                                    <div class="m-b-25"> <img src="{{ url("storage/{$img}") }}"  width="100" height="100" class="img-radius" alt="User-Profile-Image"> </div>
                                                                    <h6 class="f-w-600">{{ Auth::User()->primeiro_nome.' '.Auth::User()->ultimo_nome }}</h6>
                                                                    <p>{{Auth::User()->tipoUtilizador   }}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informações</h6>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Nome de usuário</p>
                                                                            <h6 class="text-muted f-w-400">{{Auth::User()->nome   }}</h6>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Email</p>
                                                                            <h6 class="text-muted f-w-400">{{Auth::User()->email   }}</h6>
                                                                        </div>
                                                                     
                                                                        <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Telefone</p>
                                                                            <h6 class="text-muted f-w-400">{{Auth::User()->telefone   }}</h6>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Gênero</p>
                                                                            <h6 class="text-muted f-w-400">{{Auth::User()->genero   }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6> --}}
                                                                    <div class="row">
                                                                        {{-- <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Perfil</p>
                                                                            <h6 class="text-muted f-w-400">{{Auth::User()->tipoUtilizador   }}</h6>
                                                                        </div> --}}
                                                                        {{-- <div class="col-sm-6">
                                                                            <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                            <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                                                        </div> --}}
                                                                    </div>
                                                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form class="pt-3" action="{{ route('admin.utilizadores.atualizarPerfil') }}" method="POST"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')
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
                                          <label for="exampleInputName1">Nome de usuário:</label>
                                            <input required type="text" class="form-control form-control-lg"
                                                id="exampleInputUsername1" placeholder="Nome de usuário" name="nome"
                                                value="{{ Auth::User()->nome }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Primeiro nome:</label>
                                            <input required type="text" class="form-control form-control-lg"
                                                id="exampleInputUsername1" placeholder="Digita aqui o primeiro nome"
                                                name="primeiro_nome" value="{{ Auth::User()->primeiro_nome }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Útimo nome:</label>
                                            <input required type="text" class="form-control form-control-lg"
                                                id="exampleInputUsername1" placeholder=" Digita aqui último nome"
                                                name="ultimo_nome" value="{{ Auth::User()->ultimo_nome }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">E-mail:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">@</span>
                                                </div>
                                                <input type="text" class="form-control"
                                                    placeholder=" Digita aqui o E-mail" name="email"
                                                    value="{{ Auth::User()->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Telefone:</label>
                                            <input required type="number" class="form-control form-control-lg"
                                                id="exampleInputEmail1" placeholder=" Digita aqui o telefone"
                                                name="telefone" maxlength="9" value="{{ Auth::User()->telefone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Gênero:</label>
                                            <select required class="form-control form-control-lg"
                                                id="exampleFormControlSelect2" name="genero">

                                                <option value="{{ Auth::User()->genero }}">
                                                    {{ Auth::User()->genero }}</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Feminino">Feminino</option>
                                            </select>
                                        </div>


                                        <div class="mt-3">
                                            <button type="submit"
                                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text">Efectuar
                                                edição</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <form class="pt-3" action="{{ route('admin.utilizadores.atualizar.passe') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                          <label for="exampleInputName1">Palavra passe actual:</label>
                                            <input required type="password" name="password_actual"
                                                class="form-control form-control-lg" id="exampleInputPassword1"
                                                placeholder="Digita aqui a palavra passe actual">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputName1">Nova palavra passe :</label>
                                            <input required type="password" name="password_nova"
                                                class="form-control form-control-lg" id="exampleInputPassword1"
                                                placeholder="Digita aqui a nova palavra passe ">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputName1">Confirmar palavra passe :</label>
                                            <input required type="password" name="password_confirm"
                                                class="form-control form-control-lg" id="exampleInputPassword1"
                                                placeholder="Digita aqui a confirmação da nova palavra passe">
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit"
                                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text">Efectuar
                                                edição</button>
                                        </div>

                                    </form>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@if (session('passe_editada'))
<script>
    Swal.fire(
        'Perfil editado com sucesso',
        '',
        'success'
    )
</script>
@endif
@if (session('perfil-editato'))
<script>
    Swal.fire(
        'Perfil editado com sucesso',
        '',
        'success'
    )
</script>
@endif

@if (session('passe_nao_existe'))
<script>
    Swal.fire(
        'Palavra passe actual errada!',
        '',
        'error'
    )
</script>

@endif
    
    @if (session('passe_nao_bate'))
    <script>
        Swal.fire(
            'A senha não bate com a confimação!',
            '',
            'error'
        )
    </script>
@endif
