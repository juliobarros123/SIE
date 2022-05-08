  







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
                                        <h2>Servicos disponíveis</h2>
                                        <p>O S.I.E está aqui para lhe proporcionar vagas de empregos de diversas empresas e
                                            lhe oferecer os serviços das mais diversas empresas.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        
                                            <form  action="{{ route('site.servicos.pesquisar') }}" method="post">
                                                @csrf
                                                <div class="d-flex flex-row">
                                                    <div class="form-outline w-75">
                                                      <input type="search"  placeholder="Pesquisar serviço " name="servico" class="form-control" />
                                                     
                                                    </div>
                                                    <button type="submit" class="btn btn-primary h-100 w-25">
                                                      <i class="fas fa-search"></i>
                                                    </button>
                                                  </div>
                                            </form>
                                        
                                    </div>
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
                            
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                   {{-- <input type="search" class="form-control" > --}}
                                </div>
                              
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <section id="blog" class="our-portfolio section"> --}}
<div class="container">
       <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading wow fadeInLeft animated" data-wow-duration="1s" data-wow-delay="0.3s"
                        style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s;">
@if (isset($pesquisa))
<h4>Resultado da pesquisa</h4>
@else
<h4>Servicos</h4>
@endif
                      
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn animated" data-wow-duration="1s" data-wow-delay="0.7s"
            style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.7s; -moz-animation-delay: 0.7s; animation-delay: 0.7s;">
            <div class="row">
                @foreach ($servicos as $item)
                <div class="col-lg-4 ">
       
                                    <div class="owl-item cloned" style="width:100%">
                                        <div class="item">

                                            <div class="portfolio-item" data-toggle="modal"
                                                data-target="#exampleModal{{ $item->id }}">
                                                <div class="thumb">
                                                    {{-- <img src="assets/images/portfolio-01.jpg" alt=""> --}}
                                                </div>
                                                <div class="down-content ">
                                                    <h4 class="w-100">{{ Str::limit($item->servico, 70) }}</h4>
                                                    <span >Empresa: <strong>{{ $item->nome }}</strong> </span>  /
                                                       <span>Preço: <strong>{{$item->preco  }} akz</strong></span>     
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                           


                    </div>
                         @endforeach
                </div>
            </div>
        </div>
    </div>
    @foreach ($servicos as $item)
        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Servicos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $item->descricao }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
            
        </div>
    {{-- </section> --}}
   
   


@endsection
