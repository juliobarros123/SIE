<div class="form-group col-md-4">
    <label>Disciplinas</label>
    <select name="id_disciplina" class="form-control buscarDisciplina" id="selectT" >
        @isset($disciplinas)
            <option value=""> </option>
        @else
            <option>Seleciona a disciplina</option>
        @endisset
       
    </select>
</div>


<div class="form-group col-md-4">
    <label>Classes</label>
    <select name="id_classe" class="form-control buscarClasse " id="selectTw" >
        @isset($classes)
            <option value=""> </option>
        @else
            <option>Seleciona a classe</option>
        @endisset
       
    </select>
</div>


