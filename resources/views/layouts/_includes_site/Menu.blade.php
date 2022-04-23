  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav" style="margin-top: -25px">
            <!-- ***** Logo Start ***** -->
            <a href="{{ url('bem-vindo') }}" class="logo">
              <img src="/site/assets/images/logo-v1.png" alt="">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="{{ url('/') }}" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#about">Sobre</a></li>
              {{-- <li class="scroll-to-section"><a href="#services">Serviços</a></li> --}}
              <li class="scroll-to-section"><a href="{{ route('site.vagas') }}">Vagas</a></li>
              @if (Auth::check())
              <li class="scroll-to-section"><a href="{{ route('admin.vagas.candidatos.minhas.vagas',['slug_candidato'=>Auth::User()->slug]) }}">Minhas Vagas</a></li>
                   @endif
              {{-- <li class="scroll-to-section"><a href="#noticia">Notícias</a></li> --}}
              <li class="scroll-to-section"><a href="#contact">Contacto</a></li> 
              @if (!Auth::check())
              <li class="scroll-to-section"><div class="border-first-button"><a href="{{ route('login') }}">Entrar</a></div></li> 
              @else
              <li class="scroll-to-section"><div class="border-first-button"><a href="{{ url('painel') }}">Painel</a></div></li> 
              @endif
             
              {{-- <li class="scroll-to-section"><div class=""><a href="{{ route('register') }}">Inscrever-se</a></div></li>  --}}
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
