<div class="form-group">
    <label for="exampleInputUsername1">Nome:</label>
    <input type="text" class="form-control" id="exampleInputUsername1" required
        placeholder="Digita o nome do servico" name="servico" value="{{ isset($servico->servico) ? $servico->servico : '' }}">
</div>

<div class="form-group">
    <label for="exampleInputUsername1">Preço:</label>
    <input type="number" class="form-control" id="exampleInputUsername1"
        placeholder="Digita o preço do serviço" name="preco" value="{{ isset($servico->preco) ? $servico->preco : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputUsername1">Descricão:</label>
    <textarea name="descricao" id=""  class="form-control"  cols="30" rows="10" placeholder="Descrição do serviço">
        {{ isset($servico->descricao) ? $servico->descricao : '' }}
    </textarea>
   
</div>




<div class="form-group">
    <label for="exampleSelectGender">Empresa:</label>
    <select class="form-control" id="exampleSelectGender" name="id_empresa">
        {{-- <option selected disabled>Seleciona a empresa:</option> --}}

        <option selected value="{{ isset($servico) ? $servico->id_empresa : '' }}">
            {{ isset($servico) ? $servico->nome : 'Seleciona a empresa:' }}
        </option>
        @foreach ($empresas as $item)
        <option value="{{$item->id}}">{{ $item->nome }}</option>
        @endforeach
        
    </select>
</div>


