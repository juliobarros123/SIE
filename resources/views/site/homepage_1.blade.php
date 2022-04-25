@extends('layouts._includes_site.Header')
@section('titulo', 'Lista de utilizadores')
@section('conteudo')
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>Sistema Incubador de Empresa</h6>
                                        <h2>Encontre uma Vaga ou um Serviço</h2>
                                        <p>O S.I.E está aqui para lhe proporcionar vagas de empregos de diversas empresas e
                                            lhe oferecer os serviços das mais diversas empresas.</p>
                                    </div>
                                    @if(!Auth::check())
                                    <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="{{ route('register') }}">Cadastrar-se</a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="/site/assets/images/slider-dec.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="/site/assets/images/about-dec.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>Sobre</h6>
                                    <h4>O QUE É O <em>S.I.E</em></h4>
                                    <div class="line-dec"></div>
                                </div>
                                <p>O S.I.E é um Sitema Incubador de Empresas. Este tem como finalidade divulgar <a
                                        rel="nofollow" href="#portfolio" target="_blank">vagas</a> de emprego e estágios,
                                    assim comos os <a rel="nofollow" href="#services" target="_blank">serviços</a> das
                                    empresas alocadas neste sistema.</p>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item third-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="{{ ttl_utilizadores() }}">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        {{ ttl_utilizadores() }}<br>
                                                        <span>Utilizadores</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item first-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="{{ ttl_empresas() }}">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        {{ ttl_empresas() }}<br>
                                                        <span>Empresas</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item second-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="{{ ttl_vagas() }}">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        {{ ttl_vagas() }}<br>
                                                        <span>Vagas</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="0.3s"
                        style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
                 
                        <h4>Empresas cadastradas no <em>Siistema</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn animated" data-wow-duration="1s" data-wow-delay="0.7s"
            style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.7s; -moz-animation-delay: 0.7s; animation-delay: 0.7s;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loop owl-carousel owl-loaded owl-drag">





                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transition: all 0.25s ease 0s; width: 3795px; transform: translate3d(-1380px, 0px, 0px);">
                                @foreach ($empresas as $item)
                                <div class="owl-item cloned  " >
                                    <div class="itemy m-4 ">
                                      
                                            <div class="" style="    box-shadow: 0px 0px 15px rgb(0 0 0 / 10%);color: #2a2a2a;
    margin: 0px;
    width: 100%;
    font-size: 20px;
    font-weight: 700;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    position: relative;
    border-radius: 15px;
}

">
                                                <div class="thumb ">
                                                    <img src="{{ url("storage/{$item->logotipo}") }}" height="200" width="20"  alt="">
                                                </div>
                                                <div class="down-content">
                                                    <h4>{{ $item->nome }}</h4>
                                                    <p>{{ $item->foco }}</p>
                                                </div>
                                            </div>
                                       
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                class="owl-next"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots"><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot active"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

  




    <!-- <section id="blog" class="our-portfolio section">


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <p class="sub-title">Vagas Disponíveis</p>
                        <h2 class="title">Novas Vagas</h2>
                    </div>
                </div>
            </div>
            <div class="blog-wrapper">
                <div class="container-fluid wow fadeIn ">

                    <div class="row">


                        @foreach (vagas_disponiveis()->limit(6)->get()
        as $vaga)
                            <div class="col-lg-4 blog-col pt-4 ">
                                <div class="single-blog mt-55 wow fadeInLeftBig blog-post h-100" data-wow-duration="1.3s"
                                    data-wow-delay="0.4s">
                                    <div class="blog-image">
                                        <a href="{{ url("storage/{$vaga->capa}") }}"><img
                                                src="{{ url("storage/{$vaga->capa}") }}" alt="{{ $vaga->funcao }}"></a>
                                        <span class="date">{{ $vaga->created_at }} disponível até
                                            {{ $vaga->datalimite }}</span>
                                    </div>
                                    <div class="blog-content m-2 ">
                                        <ul class="meta">
                                            <li class="d-inline item-vaga">{{ $vaga->nome }}</a></li>
                                            <li class="d-inline item-vaga ">{{ $vaga->tipo_vaga }}</a></li>
                                            <li class="d-inline item-vaga">{{ $vaga->quantidade }}
                                                Candidatos</a></li>

                                        </ul>
                                        <ul class="meta">

                                            <li class="d-inline"><a
                                                    href="{{ url("storage/{$vaga->caminho_discricao}") }}"
                                                    class="text-primary" download><i class="fas fa-download"></i>
                                                    Baixar requisitos</a></li>
                                        </ul>
                                        <h4 class="blog-title"><a href="vagas-details.html">{{ $vaga->funcao }}</a>
                                        </h4>

                                        <a href="{{ route('site.vagas.candidatos.inscrever-se', ['slug_vaga' => $vaga->slug]) }}"
                                            class="main-btn main-btn-2 w-100">Candidatar-se</a>

                                     

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="0.3s"
                        style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">

                        <h4>FeedBacks</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn animated" data-wow-duration="1s" data-wow-delay="0.7s"
            style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.7s; -moz-animation-delay: 0.7s; animation-delay: 0.7s;">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="loop owl-carousel owl-loaded owl-drag ">





                        <div class="owl-stage-outer ">
                            <div class="owl-stage"
                                style="transition: all 0.25s ease 0s; width: 3750px; transform: translate3d(-1500px, 0px, 0px);">
                                @foreach ($comentarios as $item)
                                    <div class="owl-item cloned" style="width:30%">
                                        <div class="item">

                                            <div class="portfolio-item" data-toggle="modal"
                                                data-target="#exampleModal{{ $item->id }}">
                                                <div class="thumb">
                                                    <img src="assets/images/portfolio-01.jpg" alt="">
                                                </div>
                                                <div class="down-content ">
                                                    <h4>{{ Str::limit($item->mensagem, 70) }}</h4>
                                                    <span>{{ $item->nome }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        </div>
                        <div class="owl-nav disabled"><button type="button" role="presentation"
                                class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button"
                                role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots disabled"><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button><button role="button"
                                class="owl-dot active"><span></span></button><button role="button"
                                class="owl-dot"><span></span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($comentarios as $item)
        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">FeedBack</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $item->mensagem }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Nosso Contacto</h6>
                        <h4>Contacte-nos <em>Agora</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="{{ route('site.comentarios.cadastrar') }}" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="/site/assets/images/contact-dec.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div id="map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.650263070718!2d13.264887615139505!3d-8.818888493666758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51f18003d4bac3%3A0x2568aa7432e71445!2sInstituto%20de%20Telecomunica%C3%A7%C3%B5es!5e0!3m2!1spt-PT!2sao!4v1647694446838!5m2!1spt-PT!2sao"
                                        width="100%" height="636px" style="border:0;" allowfullscreen=""
                                        loading="lazy"></iframe>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <form action="{{ route('site.comentarios.cadastrar') }}" method="post">
                                    @csrf
                                    <div class="fill-form">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="info-post">
                                                    <div class="icon">
                                                        <img src="/site/assets/images/phone-icon.png" alt="">
                                                        <a href="#">912-918-091</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="info-post">
                                                    <div class="icon">
                                                        <img src="/site/assets/images/email-icon.png" alt="">
                                                        <a href="#">sie@gmail.com</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="info-post">
                                                    <div class="icon">
                                                        <img src="/site/assets/images/location-icon.png" alt="">
                                                        <a href="#">Angola Luanda</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <input type="name" name="nome" id="name" placeholder="Nome"
                                                        autocomplete="on" required>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                                        placeholder="Email" required="">
                                                </fieldset>
                                                <fieldset>
                                                    <input type="assunto" name="assunto" id="subject" placeholder="Assunto"
                                                        autocomplete="on">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6">
                                                <fieldset>
                                                    <textarea name="mensagem" type="text" class="form-control" id="message" placeholder="Mensagem"
                                                        required=""></textarea>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <button type="submit" id="form-submit" class="main-button ">Enviar
                                                        mensagem Agora</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session('comentario_salvo'))
        <script>
            Swal.fire(
                'Obrigado por dar o seu parecer!',
                '',
                'success'
            )
        </script>
    @endif

@endsection
