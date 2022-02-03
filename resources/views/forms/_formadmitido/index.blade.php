<div class="panel panel-default active">
    <div class="panel-heading" id="headingOne">
        <h3>
            <a href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                Dados
            </a>
        </h3>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">

            <div>
                <input type="file" name="foto">
            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group col-md-4">
                        <label for="vc_primeiroNome" class="form-label">Processo*</label>
                        <input type="number" class="border-secondary" name="it_processo" class="border-secondary"
                            id="it_processo" autocomplete="off" placeholder="Processo" required />
                    </div><br>
                </div>

                <div class="form-group col-md-4">
                    <label for="vc_primeiroNome" class="form-label">Primeiro Nome *</label>
                    <input type="text" class="border-secondary" name="vc_primeiroNome" class="border-secondary"
                        id="vc_primeiroNome" autocomplete="off" placeholder="Primeiro Nome" required />
                </div>
                <div class="form-group col-md-4">
                    <label for="vc_nomedoMeio" class="form-label">Nomes do Meio</label>
                    <input type="text" class="border-secondary" name="vc_nomedoMeio" class="border-secondary"
                        id="vc_nomedoMeio" autocomplete="off" placeholder="Nomes do Meio" />
                </div>
                <div class="form-group col-md-4">
                    <label for="vc_apelido" class="form-label">Apelido *</label>
                    <input type="text" class="border-secondary" name="vc_ultimoaNome" id="vc_apelido"
                        class="border-secondary" autocomplete="off" placeholder="Apelido" required />
                </div>


            </div>

            <fieldset>


                <div class="form-row">


                    <div class="form-group col-md-6">
                        <label for="vc_nomePai" class="form-label">Nome do Pai <small>(deixar em
                                branco se não tiver)</small></label>
                        <input type="text" class="border-secondary" name="vc_namePai" class="border-secondary"
                            id="vc_nomePai" autocomplete="off" placeholder="Nome do Pai" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="vc_nomeMae" class="form-label">Nome da Mãe <small>(deixar em
                                branco se não tiver)</small></label>
                        <input type="text" class="border-secondary" name="vc_nameMae" class="border-secondary"
                            id="vc_nomeMae" autocomplete="off" placeholder="Nome da Mãe" />
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group-flex">
                        <div class="form-radio">
                            <label for="gender">Sexo *</label>
                            <div class="form-flex">
                                <input type="radio" class="border-secondary" name="vc_genero" class="border-secondary"
                                    value="Masculino" id="male" checked="checked" />
                                <label for="male">
                                    <img src="/images/icon-male.png" alt="Male">
                                </label>
                                <input type="radio" class="border-secondary" name="vc_genero" class="border-secondary"
                                    value="Feminino" id="female" />
                                <label for="female">
                                    <img src="/images/icon-female.png" alt="Female">
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="dt_dataNascimento" class="form-label">Data de Nascimento *</label>
                            <input type="date" class="border-secondary" class="border-secondary"
                                name="dt_dataNascimento" id="dt_dataNascimento" max="<?php echo date('Y-m-d'); ?>" required />
                        </div>

                    </div>


                    <div class="form-select col-md-3">
                        <label for="vc_estadoCivil" class="form-label">Estado Civil *</label>
                        <div class="select-group" class="border-secondary" id="vc_estadoCivil">
                            <select class="border-secondary" name="vc_estadoCivil" required>
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Viuvo(a)">Viuvo(a)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-select col-md-3">
                        <label for="vc_dificiencia" class="form-label">Portador de Deficiêcia Física? *</label>
                        <div class="select-group">
                            <select class="border-secondary" name="vc_dificiencia" class="border-secondary" required>
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="Não">Não</option>
                                <option value="Sim">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="vc_bi" class="form-label">Bilhete de Identidade *</label>
                        <input type="text" class="border-secondary" class="border-secondary" name="vc_bi" id="vc_bi"
                            minlength="14" maxlength="14" placeholder="Nº do Bilhete de Identidade"
                            autocomplete="off" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dt_emissao" class="form-label">Data de Emissão do Bilhete de
                            Identidade *</label>
                        <input type="date" class="border-secondary" class="border-secondary" name="dt_emissao"
                            id="dt_emissao" max="<?php echo date('Y-m-d'); ?>" required />
                    </div>
                    <div class="form-select col-md-4">
                        <label for="vc_localEmissao" class="form-label">Local Emissão do Bilhete de Identidade *</label>
                        <div class="select-group">
                            <select class="border-secondary" name="vc_localEmissao" class="border-secondary"
                                id="vc_localEmissao" required>
                                <option value="" selected disabled>Selecione uma provincia</option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia['nome'] }}">{{ $provincia['nome'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="vc_residencia" class="form-label">Residência *</label>
                        <input type="text" class="border-secondary" class="border-secondary" name="vc_residencia"
                            id="vc_residencia" placeholder="Residência" autocomplete="off" required />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="vc_naturalidade" class="form-label">Natural de *</label>
                        <input type="text" class="border-secondary" class="border-secondary" name="vc_naturalidade"
                            id="vc_naturalidade" placeholder="Natural de" autocomplete="off" required />
                    </div>

                    <div class="form-select col-md-4">
                        <label for="vc_provincia" class="form-label">Provincia de *</label>
                        <div class="select-group">
                            <select class="border-secondary" name="vc_provincia" class="border-secondary"
                                id="vc_provincia" required>
                                <option value="" selected disabled>Selecione uma provincia</option>
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia['nome'] }}">{{ $provincia['nome'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="el_email" class="form-label">E-mail</label>
                        <input type="email" class="border-secondary" class="border-secondary" name="vc_email"
                            id="vc_email" placeholder="E-mail" autocomplete="off" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="it_telefone" class="form-label">Telefone *</label>
                        <input type="number" class="border-secondary" name="it_telefone" id="it_telefone"
                            placeholder="Telefone" min="900000000" max="1000000000" maxlength="9" autocomplete="off"
                            required />
                    </div>

                    <div class="form-group col-md-2">
                        <label for="it_classe" class="form-label">Classe *</label>
                        <input type="number" class="border-secondary" name="it_classe" id="it_classe"
                            placeholder="Classe" min="10" max="13" maxlength="2" autocomplete="off" required />
                    </div>

                    <div class="form-select col-md-5">
                        <label for="vc_provincia" class="form-label">Curso *</label>
                        <div class="select-group">
                            <select class="border-secondary" name="vc_nomeCurso" class="border-secondary"
                                id="vc_provincia" required>
                                <option value="" selected disabled>Selecione um curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->vc_nomeCurso }}">{{ $curso->vc_nomeCurso }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="el_email" class="form-label">Ano Lectivo</label>
                        <input type="email" class="border-secondary" class="border-secondary" name="vc_anoLectivo" id=""
                            value="{{ $ano_lectivo->ya_inicio }}-{{ $ano_lectivo->ya_fim }}" readonly />
                    </div>
                </div>
            </fieldset>

        </div>
    </div>
</div>
