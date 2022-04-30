  <nav class="sidebar sidebar-offcanvas" id="sidebar">



      <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="{{ url('painel') }}">
                  <i class="ti-shield menu-icon"></i>
                  <span class="menu-title">Painel</span>
              </a>
          </li>
     
       
          @if (Auth::User()->tipoUtilizador == 'Administrador')
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.utilizadores') }}">
                      <i class="ti-pie-chart menu-icon"></i>
                      <span class="menu-title">Utilizadores</span>
                  </a>
              </li>
          @endif
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.empresas') }}">
                  <i class="ti-pie-chart menu-icon"></i>
                  <span class="menu-title">Empresas</span>
              </a>
          </li>
          @if (Auth::User()->tipoUtilizador == 'Administrador' || Auth::User()->tipoUtilizador == 'Empresario')
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.vagas') }}">
                      <i class="ti-pie-chart menu-icon"></i>
                      <span class="menu-title">Vagas</span>
                  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.servicos') }}">
                    <i class="ti-pie-chart menu-icon"></i>
                    <span class="menu-title">Servicos</span>
                </a>
            </li>
            @if (Auth::User()->tipoUtilizador == 'Administrador')

              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.comentarios') }}">
                      <i class="ti-pie-chart menu-icon"></i>
                      <span class="menu-title">Feedback</span>
                  </a>
              </li>
@endif


              <li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#relatorio" aria-expanded="false"
                      aria-controls="relatorio">
                      <i class="ti-user menu-icon"></i>
                      <span class="menu-title">Relatórios</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="relatorio">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link"
                                  href="{{ route('admin.retatorios.empresas.vagas.gerar') }}"> Vagas por empresa </a>
                          </li>

                          <li class="nav-item"> <a class="nav-link"
                                  href="{{ route('admin.retatorios.candidatos.vagas.gerar') }}"> Candidatos por vagas
                              </a></li>

                      </ul>
                  </div>
              </li>
          @endif

          @if (Auth::User()->tipoUtilizador == 'Administrador')
          <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/logs/pesquisar') }}">
                  <i class="ti-pie-chart menu-icon"></i>
                  <span class="menu-title">Logs de actividade</span>
              </a>
          </li>
      @endif
     
      </ul>


  </nav>
