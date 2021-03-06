@extends('layouts._includes_site.Header')
@section('titulo', 'Lista de utilizadores')
@section('conteudo')
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6 align-self-center">
            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
              <div class="row">
                <div class="col-lg-12">
                  <h6>Sistema Incubador de Empresa</h6>
                  <h2>Encontre uma Vaga ou um Serviço</h2>
                  <p>O S.I.E está aqui para lhe proporcionar vagas de empregos de diversas empresas e lhe oferecer os serviços das mais diversas empresas.</p>
                </div>
                <div class="col-lg-12">
                  <div class="border-first-button scroll-to-section">
                    <a href="#contact">Cadastrar-se</a>
                  </div>
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
            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
              <img src="/site/assets/images/about-dec.png" alt="">
            </div>
          </div>
          <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="about-right-content">
              <div class="section-heading">
                <h6>Sobre</h6>
                <h4>O que é o  <em>S.I.E</em></h4>
                <div class="line-dec"></div>
              </div>
              <p>O S.I.E é um Sitema Incubador de Empresas. Este tem como finalidade divulgar <a rel="nofollow" href="#portfolio" target="_blank">vagas</a> de emprego e estágios, assim comos os <a rel="nofollow" href="#services" target="_blank">serviços</a> das empresas alocadas neste sistema.</p>
              <div class="row">
                <div class="col-lg-4 col-sm-4">
                  <div class="skill-item first-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="progress" data-percentage="90">
                      <span class="progress-left">
                        <span class="progress-bar"></span>
                      </span>
                      <span class="progress-right">
                        <span class="progress-bar"></span>
                      </span>
                      <div class="progress-value">
                        <div>
                          90<br>
                          <span>Empresas</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                  <div class="skill-item second-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="progress" data-percentage="80">
                      <span class="progress-left">
                        <span class="progress-bar"></span>
                      </span>
                      <span class="progress-right">
                        <span class="progress-bar"></span>
                      </span>
                      <div class="progress-value">
                        <div>
                          800<br>
                          <span>Vagas</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                  <div class="skill-item third-skill-item wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="progress" data-percentage="80">
                      <span class="progress-left">
                        <span class="progress-bar"></span>
                      </span>
                      <span class="progress-right">
                        <span class="progress-bar"></span>
                      </span>
                      <div class="progress-value">
                        <div>
                          80<br>
                          <span>Estágios</span>
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

<div id="services" class="services section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
          <h6>Empresas cadastradas</h6>
          <h4>Empresas cadastradas no sistemas</h4>
          <div class="line-dec"></div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="naccs">
          <div class="grid">
            <div class="row">
              <div class="col-lg-12">
                <div class="menu">
                  <div class="first-thumb active">
                    <div class="thumb">
                      <span class="icon"><img src="/site/assets/images/service-icon-01.png" alt=""></span>
                      Tecnologias de Informação
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="/site/assets/images/service-icon-02.png" alt=""></span>
                      Recursos Humanos 
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="/site/assets/images/service-icon-03.png" alt=""></span>
                      Ciências da Saúde
                    </div>
                  </div>
                  <div>
                    <div class="thumb">                 
                      <span class="icon"><img src="/site/assets/images/service-icon-04.png" alt=""></span>
                      Linguística
                      Letras e Artes
                    </div>
                  </div>
                  <div class="last-thumb">
                    <div class="thumb">                 
                      <span class="icon"><img src="/site/assets/images/service-icon-01.png" alt=""></span>
                      Ciências Sociais
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-12">
                <ul class="nacc">
                  <li class="active">
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>SEO Analysis &amp; Daily Reports</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                dover lipsum lorem and the others.</p>
                              <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="/site/assets/images/services-image.jpg" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Healthy Food &amp; Life</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                dover lipsum lorem and the others.</p>
                              <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="/site/assets/images/services-image-02.jpg" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Car Re-search &amp; Transport</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                dover lipsum lorem and the others.</p>
                              <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="/site/assets/images/services-image-03.jpg" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Online Shopping &amp; Tracking ID</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                dover lipsum lorem and the others.</p>
                              <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="/site/assets/images/services-image-04.jpg" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="thumb">
                        <div class="row">
                          <div class="col-lg-6 align-self-center">
                            <div class="left-text">
                              <h4>Enjoy &amp; Travel</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt ut labore et dolore kengan darwin doerski token.
                                dover lipsum lorem and the others.</p>
                              <div class="ticks-list"><span><i class="fa fa-check"></i> Optimized Template</span> <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span>
                                <span><i class="fa fa-check"></i> Data Info</span> <span><i class="fa fa-check"></i> SEO Analysis</span> <span><i class="fa fa-check"></i> Optimized Template</span></div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sedr do eiusmod deis tempor incididunt.</p>
                            </div>
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <div class="right-image">
                              <img src="/site/assets/images/services-image.jpg" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="free-quote" class="free-quote">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4">
        <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
          <h6>Contacta-te nos Agora</h6>
          <h4>Preencha os campos abaixo</h4>
          <div class="line-dec"></div>
        </div>
      </div>
      <div class="col-lg-8 offset-lg-2  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
        <form id="search" action="#" method="GET">
          <div class="row">
            <div class="col-lg-4 col-sm-4">
              <fieldset>
                <input type="web" name="web" class="website" placeholder="Your website URL..." autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-4 col-sm-4">
              <fieldset>
                <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
              </fieldset>
            </div>
            <div class="col-lg-4 col-sm-4">
              <fieldset>
                <button type="submit" class="main-button">Enviar</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<section id="blog" class="blog-area">
  

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
          <div class="row">

            {{-- @foreach (vagas_disponiveis() as $vaga)
                
        
            <div class="col-lg-4 blog-col">
                <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
                    <div class="blog-image">
                        <a href="{{ url("storage/{$vaga->capa}") }}"><img src="{{ url("storage/{$vaga->capa}") }}" alt=" {{$vaga->funcao}}" ></a>
                        <span class="date">{{$vaga->created_at  }} até {{$vaga->datalimite  }} </span>
                    </div>
                    <div class="blog-content">
                        <ul class="meta">
                            <li><a href="{{ route('site.vagas.candidatos.inscrever-se',['slug_vaga'=>$vaga->slug]) }}">{{$vaga->nome  }}</a></li>
                            <li><a href="#">{{$vaga->quantidade  }} Funcinários</a></li>
                        </ul>
                        <h4 class="blog-title"><a href="vagas-details.html">{{$vaga->funcao  }}</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
                    </div>
                </div>
            </div>
            @endforeach --}}
         
            @foreach (vagas_disponiveis() as $vaga)
              <div class="col-lg-4 blog-col pt-4">
                  <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
                      <div class="blog-image">
                          <a href="{{ url("storage/{$vaga->capa}") }}"><img src="{{ url("storage/{$vaga->capa}") }}" alt="{{$vaga->funcao}}"></a>
                          <span class="date">{{$vaga->created_at  }} disponível até {{$vaga->datalimite  }}</span>
                      </div>
                      <div class="blog-content ">
                          <ul class="meta">
                              <li class="d-inline"><a href="#">{{$vaga->nome  }}</a></li>
                              <li class="d-inline"><a href="#">{{$vaga->quantidade  }} Funcinários</a></li>
                              <li class="d-inline"><a href="{{ url("storage/{$vaga->caminho_discricao}") }}" class="text-primary" download><i class="fa-solid fa-download"></i> Baixar requisitos</a></li>
                          </ul>
                          <h4 class="blog-title"><a href="vagas-details.html">{{$vaga->funcao  }}</a></h4>

                          <a href="{{ route('site.vagas.candidatos.inscrever-se',['slug_vaga'=>$vaga->slug]) }}" class="main-btn main-btn-2 w-100" >Candidatar-se</a>
                          
                          <!-- <div class="down-content">
                            <div class="border-first-button" ><a href="#">Discover More</a></div>
                          </div> -->

                      </div>
                  </div>
              </div>
              @endforeach
              {{-- <div class="col-lg-4 blog-col pt-4">
                <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
                    <div class="blog-image">
                        <a href="vagas-details.html"><img src="assets/images/blog/blog-1.jpg" alt=""></a>
                        <span class="date">30 Ago, 2021</span>
                    </div>
                    <div class="blog-content">
                        <ul class="meta">
                            <li><a href="#">Nosso Super</a></li>
                            <li><a href="#">2 Funcinários</a></li>
                        </ul>
                        <h4 class="blog-title"><a href="vagas-details.html">Desenvolvedor de Sistemas</a></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 blog-col  pt-4">
              <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
                  <div class="blog-image">
                      <a href="vagas-details.html"><img src="assets/images/blog/blog-1.jpg" alt=""></a>
                      <span class="date">30 Ago, 2021</span>
                  </div>
                  <div class="blog-content">
                      <ul class="meta">
                          <li><a href="#">Nosso Super</a></li>
                          <li><a href="#">2 Funcinários</a></li>
                      </ul>
                      <h4 class="blog-title"><a href="vagas-details.html">Desenvolvedor de Sistemas</a></h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 blog-col  pt-4">
            <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
                <div class="blog-image">
                    <a href="vagas-details.html"><img src="assets/images/blog/blog-1.jpg" alt=""></a>
                    <span class="date">30 Ago, 2021</span>
                </div>
                <div class="blog-content">
                    <ul class="meta">
                        <li><a href="#">Nosso Super</a></li>
                        <li><a href="#">2 Funcinários</a></li>
                    </ul>
                    <h4 class="blog-title"><a href="vagas-details.html">Desenvolvedor de Sistemas</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-lg-4 blog-col  pt-4">
          <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
              <div class="blog-image">
                  <a href="vagas-details.html"><img src="assets/images/blog/blog-1.jpg" alt=""></a>
                  <span class="date">30 Ago, 2021</span>
              </div>
              <div class="blog-content">
                  <ul class="meta">
                      <li><a href="#">Nosso Super</a></li>
                      <li><a href="#">2 Funcinários</a></li>
                  </ul>
                  <h4 class="blog-title"><a href="vagas-details.html">Desenvolvedor de Sistemas</a></h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
              </div>
          </div>
      </div>
      <div class="col-lg-4 blog-col">
        <div class="single-blog mt-55 wow fadeInLeftBig" data-wow-duration="1.3s" data-wow-delay="0.4s">
            <div class="blog-image">
                <a href="vagas-details.html"><img src="assets/images/blog/blog-1.jpg" alt=""></a>
                <span class="date">30 Ago, 2021</span>
            </div>
            <div class="blog-content">
                <ul class="meta">
                    <li><a href="#">Nosso Super</a></li>
                    <li><a href="#">2 Funcinários</a></li>
                </ul>
                <h4 class="blog-title"><a href="vagas-details.html">Desenvolvedor de Sistemas</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra, augue eget tempor auctors.</p>
            </div>
        </div>
    </div> --}}
          </div>
      </div>
  </div>
</section>
<div   id="noticia">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="section-heading">
          <h6>Notíocias Novas</h6>
          <h4>Fique actualizado <em>Posts</em></h4>
          <div class="line-dec"></div>
        </div>
      </div>
      <div class="col-lg-6 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="blog-post">
          <div class="thumb">
            <a href="#"><img src="/site/assets/images/blog-post-01.jpg" alt=""></a>
          </div>
          <div class="down-content">
            <span class="category">SEO Analysis</span>
            <span class="date">03 August 2021</span>
            <a href="#"><h4>Lorem Ipsum Dolor Sit Amet, Consectetur Adelore
              Eiusmod Tempor Incididunt</h4></a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doers itii eiumod deis tempor incididunt ut labore.</p>
            <span class="author"><img src="/site/assets/images/author-post.jpg" alt="">By: Andrea Mentuzi</span>
            <div class="border-first-button"><a href="#">Discover More</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="blog-posts">
          <div class="row">
            <div class="col-lg-12">
              <div class="post-item">
                <div class="thumb">
                  <a href="#"><img src="/site/assets/images/blog-post-02.jpg" alt=""></a>
                </div>
                <div class="right-content">
                  <span class="category">SIE</span>
                  <span class="date">24 Setembro 2021</span>
                  <a href="#"><h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4></a>
                  <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="post-item">
                <div class="thumb">
                  <a href="#"><img src="/site/assets/images/blog-post-03.jpg" alt=""></a>
                </div>
                <div class="right-content">
                  <span class="category">SIE</span>
                  <span class="date">24 Setembro 2021</span>
                  <a href="#"><h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4></a>
                  <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="post-item last-post-item">
                <div class="thumb">
                  <a href="#"><img src="/site/assets/images/blog-post-04.jpg" alt=""></a>
                </div>
                <div class="right-content">
                  <span class="category">SIE</span>
                  <span class="date">24 Setembro 2021</span>
                  <a href="#"><h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4></a>
                  <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  

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
        <form id="contact" action="" method="post">
          <div class="row">
            <div class="col-lg-12">
              <div class="contact-dec">
                <img src="/site/assets/images/contact-dec.png" alt="">
              </div>
            </div>
            <div class="col-lg-5">
              <div id="map">
                <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="636px" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-lg-7">
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
                      <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                    </fieldset>
                    <fieldset>
                      <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                    </fieldset>
                    <fieldset>
                      <input type="subject" name="subject" id="subject" placeholder="Subject" autocomplete="on">
                    </fieldset>
                  </div>
                  <div class="col-lg-6">
                    <fieldset>
                      <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button ">Enviar mensagem Agora</button>
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

 
  @endsection