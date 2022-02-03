<div class="form-group">
    <label for="exampleInputempresaname1">Logotipo:</label>
    <input type="file" class="form-control" id="exampleInputempresaname1"
        placeholder="Digita o nome de usuário" name="logotipo" >
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Nome:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o nome da empresa" name="nome" value="{{ isset($empresa->slug) ? $empresa->nome : '' }}">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o email da empresa" name="email" value="{{ isset($empresa->slug) ? $empresa->email : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Telefone:</label>
    <input type="number" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o número de telefone da empresa" name="telefone" maxlength="8" value="{{ isset($empresa->slug) ? $empresa->telefone : '' }}"> 
</div>

<div class="form-group">
    <label for="exampleInputEmail1">NIF:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o NIF da empresa" name="nif" maxlength="14" value="{{ isset($empresa->slug) ? $empresa->nif : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Endereço:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o endereço da empresa" name="endereco"  value="{{ isset($empresa->slug) ? $empresa->endereco : '' }}">
</div>
