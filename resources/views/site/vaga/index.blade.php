@extends('layouts._includes_site.Header')
@section('titulo', 'Vagas')
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
                                        <h2>Vagas disponíveis</h2>
                                        <p>O S.I.E está aqui para lhe proporcionar vagas de empregos de diversas empresas e
                                            lhe oferecer os serviços das mais diversas empresas.</p>
                                    </div>
                                    {{-- <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="#contact">Cadastrar-se</a>
                                        </div>
                                    </div> --}}
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



    {{-- <section id="blog" class="our-portfolio section"> --}}
        <div class="container">
            {{-- <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <p class="sub-title"></p>
                        <h2 class="title"></h2>
                    </div>
                </div>
            </div> --}}
            <div class="blog-wrapper">
                <div class="container-fluid wow fadeIn ">

                    <div class="row">
                        @foreach ($vagas as $vaga)
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
                                      @if (is_null($vaga->estado))
                                      <a href="{{ route('site.vagas.candidatos.inscrever-se', ['slug_vaga' => $vaga->slug]) }}"
                                        class="main-btn main-btn-2 w-100">Candidatar-se</a>
                                
                                        @elseif ($vaga->estado==0)
                                   
                                        <button href=""
                                            class="main-btn main-btn-2 w-100">Pendente</button>
                                    @elseif($vaga->estado==1)
                                       
                                        <button href=""
                                            class="main-btn main-btn-2 w-100">Reprovado</button>
                                            @elseif($vaga->estado==2)
                                       
                                        <button href=""
                                            class="main-btn main-btn-2 w-100">Aprovado</button>
                                        @endif
                                       

                                
                                    

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    {{-- </section> --}}
   
   


@endsection
