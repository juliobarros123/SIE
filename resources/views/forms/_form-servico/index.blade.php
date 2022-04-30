<div class="form-group">
    <label for="exampleInputUsername1">Nome:</label>
    <input type="text" class="form-control" id="exampleInputUsername1"
        placeholder="Digita o nome do servico" name="servico" value="{{ isset($servico->servico) ? $servico->servico : '' }}">
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


