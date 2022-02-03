<div class="form-group">
    <label for="exampleInputUsername1">Nome de usuário</label>
    <input type="text" class="form-control" id="exampleInputUsername1"
        placeholder="Digita o nome de usuário" name="nome" value="{{ isset($user->slug) ? $user->nome : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Primeiro nome:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o primeiro nome" name="primeiro_nome" value="{{ isset($user->slug) ? $user->primeiro_nome : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Ultimo nome:</label>
    <input type="text" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o ultimo nome" name="ultimo_nome" value="{{ isset($user->slug) ? $user->ultimo_nome : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">E-mail:</label>
    <input type="email" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o email" name="email" value="{{ isset($user->slug) ? $user->email : '' }}">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Telefone:</label>
    <input type="number" class="form-control" id="exampleInputEmail1"
        placeholder="Digita o número de telefone" name="telefone"  value="{{ isset($user->slug) ? $user->telefone : '' }}">
</div>
<div class="form-group">
    <label for="exampleSelectGender">Gênero:</label>
    <select class="form-control" name="genero" id="exampleSelectGender">
        <option value="{{ isset($user) ? $user->genero : '0' }}" select>
            {{ isset($user) ? $user->genero : 'Seleciona o gênero' }}
        </option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleSelectGender">Tipo de utilizador:</label>
    <select class="form-control" name="tipoUtilizador"
        id="exampleSelectGender">
        <option disabled></option>

        <option value="{{ isset($user) ? $user->tipoUtilizador : '0' }}" select>
            {{ isset($user) ? $user->tipoUtilizador : 'Seleciona o tipo de utilizador' }}
        </option>
        <option value="Administrador">Administrador</option>
        <option value="Empresario">Empresario</option>
        <option value="Aluno">Aluno</option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1"
        placeholder="Digita a palavra passe " name="password">
</div>
<div class="form-group">
    <label for="exampleInputConfirmPassword1">Confirm Password</label>
    <input type="password" class="form-control"
        id="exampleInputConfirmPassword1" name="palavra_passe_confirm"
        placeholder="Confirma a palavra passe">
</div>