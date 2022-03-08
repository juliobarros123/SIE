@extends('layouts._includes_site.Header')
@section('titulo', 'Lista de utilizadores')
@section('conteudo')
<div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading wow fadeIn animated" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible;-webkit-animation-duration: 1s; -moz-animation-duration: 1s; animation-duration: 1s;-webkit-animation-delay: 0.5s; -moz-animation-delay: 0.5s; animation-delay: 0.5s;">
            
            <h4>Inscrever-se a vaga <em>{{ $vaga->funcao }}</em></h4>
            <div class="line-dec"></div>
          </div>
        </div>
        <div class="col-lg-12 wow fadeInUp animated" data-wow-duration="0.5s" data-wow-delay="0.25s" style="visibility: visible;-webkit-animation-duration: 0.5s; -moz-animation-duration: 0.5s; animation-duration: 0.5s;-webkit-animation-delay: 0.25s; -moz-animation-delay: 0.25s; animation-delay: 0.25s;">
        
            <form id="contact" action="{{ route('site.vagas.candidatos.inscrever-se-agora',['slug_vaga'=>$slug_vaga]) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
          
              <div class="col-lg-12">
                <h5 class="mt-4">Meios para entrar em contacto com você </h5>
                <div class="fill-form">
                    
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/phone-icon.png" alt="">
                          <a href="#">{{ Auth::User()->telefone }}</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/email-icon.png" alt="">
                          <a href="#">{{ Auth::User()->email }}</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/location-icon.png" alt="">
                          <a href="#">Vagas sms</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                 
               
                      <fieldset>
                        <label  for="" class="text-left" >Currículo:</label>
                        <input type="file" name="curriculo" id="curriculo" class="form-control" placeholder="curriculo" autocomplete="on">
                      </fieldset>
                    </div>
                 
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button ">Inscrever agora</button>
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



  @if (session('inscrito'))
  <script>
      Swal.fire(
          'Inscrição efectuada com sucesso!',
          '',
          'success'
      )
  </script>
@endif
@if (session('erro'))
<script>
    Swal.fire(
        'Houve um erro!',
        'Verifica se selecionou o currículo no formato pdf',
        'error'
    )
</script>
@endif
 
  @endsection