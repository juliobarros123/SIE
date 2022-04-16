
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