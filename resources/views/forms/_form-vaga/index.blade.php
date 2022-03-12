<div class="form-group">
    <label for="exampleInputUsername1">Função:</label>
    <input type="text" class="form-control" id="exampleInputUsername1"
        placeholder="Digita a função" name="funcao" value="{{ isset($vaga->funcao) ? $vaga->funcao : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Quantidade:</label>
    <input type="number" class="form-control" id="exampleInputEmail1"
        placeholder="Digita a quantidade" name="quantidade" value="{{ isset($vaga->quantidade) ? $vaga->quantidade : '' }}">
</div>


<div class="form-group">
    <label for="exampleSelectGender">Remuneração:</label>
    <select class="form-control" id="exampleSelectGender" name="remuneracao">
       
        <option selected value="{{ isset($vaga) ? $vaga->remuneracao : '' }}">
            {{ isset($vaga) ? $vaga->remuneracao : 'Seleciona um opção:' }}
        </option>
        <option value="Remunerado">Remunerado</option>
        <option value="Nao-remunerado">Não remunerado</option>

        
       
    </select>
</div>
<div class="form-group">
    <label for="exampleSelectGender">Tipo de vaga:</label>
    <select class="form-control" id="exampleSelectGender" name="tipo_vaga">
        
        <option selected value="{{ isset($vaga) ? $vaga->tipo_vaga : '' }}">
            {{ isset($vaga) ? $vaga->tipo_vaga : 'Seleciona um tipo de vaga:' }}
        </option>
        <option value="efetiva">Efetiva</option>
        <option value="estagio">Estágio</option>
        <option value="empresario">Empresário</option>
        <option value="freelancer">Freelancer</option>

        <option value="voluntaria">Voluntária</option>

       
    </select>
</div>

<div class="form-group">
    <label>Capa:</label>
    {{-- <input type="file" name="caminho_discricao" class="file-upload-default"> --}}
    <div class="input-group col-xs-12">
        <input type="file" class="form-control file-upload-info"
            placeholder="Upload Image" id="capa" name="capa" >
        {{-- <span class="input-group-append">
            <button class="file-upload-browse btn btn-primary" type="button"
                onclick="escolher_file()">Upload</button>
        </span> --}}
    </div>
</div>
<div class="form-group">
    <label>Requisito:</label>
    {{-- <input type="file" name="caminho_discricao" class="file-upload-default"> --}}
    <div class="input-group col-xs-12">
        <input type="file" class="form-control file-upload-info"
            placeholder="Upload Image" id="caminho_discricao" name="caminho_discricao" >
        {{-- <span class="input-group-append">
            <button class="file-upload-browse btn btn-primary" type="button"
                onclick="escolher_file()">Upload</button>
        </span> --}}
    </div>
</div>
{{-- <script>
    function escolher_file() {
        $('#caminho_discricao').click();
    }
</script> --}}
<div class="form-group">
    <label for="exampleInputEmail1">Data limite:</label>
    <input type="date" class="form-control" id="exampleInputEmail1" required
        name="datalimite" value="{{ isset($vaga->datalimite) ? $vaga->datalimite : '' }}">
</div>

<div class="form-group">
    <label for="exampleSelectGender">Empresa:</label>
    <select class="form-control" id="exampleSelectGender" name="id_empresa">
        {{-- <option selected disabled>Seleciona a empresa:</option> --}}

        <option selected value="{{ isset($vaga) ? $vaga->id_empresa : '' }}">
            {{ isset($vaga) ? $vaga->nome : 'Seleciona a empresa:' }}
        </option>
        @foreach ($empresas as $item)
        <option value="{{$item->id}}">{{ $item->nome }}</option>
        @endforeach
        
    </select>
</div>