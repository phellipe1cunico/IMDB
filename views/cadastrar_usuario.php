<?php require_once 'header.php'; ?>

<h2>Cadastrar Novo Usuário</h2>

<form action="/vitor/IMDB/registrar" method="post">
    
    <label for="usuario">Nome de Usuário:</label><br>
    <input type="text" id="usuario" name="usuario" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="senha">Senha:</label><br>
    <input type="password" id="senha" name="senha" minlength="6" required><br><br>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>