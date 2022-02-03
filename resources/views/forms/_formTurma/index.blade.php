<div class="form-group col-md-3">
    <label class="form-label" for="vc_nomedaTurma">Nome da turma:</label>
    <input class="form-control border-secondary" name="vc_nomedaTurma" id="vc_nomedaTurma" type="text"
        value="{{ isset($turma) ? $turma->vc_nomedaTurma : '' }}" autocomplete="off"
        placeholder="Digita o nome da turma">
</div>


<div class="form-group col-md-3">
    <label class="form-label" for="vc_classeTurma">Classe da Turma</label>
    <select class="form-control buscarClasse" name="vc_classeTurma" id="vc_classeTurma" required>

        <option value="{{ isset($turma) ? $turma->it_idClasse : '' }}" selected>
            {{ isset($turma) ? $turma->vc_classeTurma : 'Selecione a classe:' }}</option>
        @foreach ($dados['classes'] as $classe)
            <option value="{{ $classe->id }}">{{ $classe->vc_classe }}ªclasse </option>
            </option>
        @endforeach
    </select>
</div>
<div class="form-group col-md-3">
    <label class="form-label" for="vc_turnoTurma">Turno da Turma</label>
    <select class="form-control " name="vc_turnoTurma" id="vc_turnoTurma" required>
        @if (isset($turma))
            <option selected class="text-primary" value="{{ $turma->vc_turnoTurma }}">{{ $turma->vc_turnoTurma }}
            </option>
        @else
            <option selected disabled value="">Selecione o turno da turma</option>
        @endif

        <option value="DIURNO">Diurno(manhã e tarde)</option>
        <option value="NOITE">Noite</option>
        <option value="MANHÃ">Manhã</option>
        <option value="TARDE">Tarde</option>
        <option value="Sabática">Sabática</option>
    </select>
</div>




<div class="form-group col-md-3">
    <label class="form-label">Curso:</label>
    <select class="form-control buscarCurso" name="vc_cursoTurma" required>
        <option value="{{ isset($turma) ? $turma->vc_cursoTurma : '' }}" selected>
            {{ isset($turma) ? $turma->vc_cursoTurma : 'Selecione o curso:' }}</option>
        @foreach ($dados['cursos'] as $curso)
            <option value="{{ $curso->id }}">{{ $curso->vc_nomeCurso }} </option>
            </option>
        @endforeach
    </select>
</div>


<div class="form-group col-md-3">
    <label class="form-label" for="label_anoLetivo_da_turma">Ano Lectivo: </label>
    @if (isset($ano_lectivo_publicado))
   
        <input type="text" name="vc_anoLectivo" value="{{ $ano_lectivo_publicado }}"
            class="form-control border-secondary" readonly required>
             <p class="text-danger  " > Atenção: Ano lectivo publicado</p>
    @else
    
        <input type="text" name="vc_anoLectivo" value="{{ isset($turma) ? $turma->vc_anoLectivo : $dados['ano'] }}"
            class="form-control border-secondary" readonly required>
    @endif
</div>


<div class="form-group col-md-3">
    <label class="form-label" for="totaldealunos"> Quantidades de alunos:</label>
    <input class="form-control border-secondary" name="it_qtdeAlunos" type="number"
        value="{{ isset($turma) ? $turma->it_qtdeAlunos : '' }}" placeholder="Digita a quantidade de alunos"
        required>
</div>
