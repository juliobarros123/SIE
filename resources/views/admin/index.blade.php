@extends('layouts.admin')

@section('titulo', 'Página Principal')

@section('conteudo')

    <div class="card mt-3">
        <div class="card-body">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-8">
                        @isset($cabecalho->vc_escola)
                            <h3>
                                {{ $cabecalho->vc_escola . ' - ' . $cabecalho->vc_acronimo }}
                            </h3>
                        @endisset
                    </div>
                    <div class="col-md-4 text-right">
                        @isset($AnoLectivo)
                            <h3>
                                <b>{{ $AnoLectivo }}</b>
                            </h3>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->



    {{-- Estatisticas superior inicio --}}
    <div class="row">

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Selecionados à Matricula</span>
                    <span class="info-box-number">
                        @isset($selecionados){{ $selecionados }}
                        @endisset
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-user-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Candidaturas</span>

                    <span class="info-box-number">
                        @isset($candidaturas){{ $candidaturas }}
                        @endisset
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-calendar-day "></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Idades de Candidatura</span>
                    <span class="info-box-number">
                        @isset($idadedecandidatura)
                            <b>Minima:</b> {{ date('Y') - date('Y', strtotime($idadedecandidatura->dt_limiteaesquerda)) }} anos
                            <br>
                            <b>Máxima:</b> {{ date('Y') - date('Y', strtotime($idadedecandidatura->dt_limitemaxima)) }} anos

                        @endisset

                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Alunos Matriculados</span>
                    <span class="info-box-number">
                        @isset($matriculas){{ $matriculas }}
                        @endisset
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    {{-- Estatisticas superior fim --}}


    {{-- gráficos html --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="primeiroGrafico"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="text-center">Construindo...</h5> --}}
                    <canvas id="chart-area"></canvas>
                </div>
            </div>
        </div>

    </div>
    {{-- ./gráficos html --}}




    @include('admin.layouts.footer')

    {{-- Javascript e PHP dos graficos --}}
    @include('grafics.home')
    {{-- ./Javascript e PHP dos graficos --}}





    @if (session('aviso'))
        <script>
            Swal.fire(
                'Cadastre primeiro o Ano lectivo',
                '',
                'error'
            )

        </script>
    @endif
@endsection
