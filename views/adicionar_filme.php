<?php include 'header.php'; ?>

<h2>Novo Filme</h2>

<form action="/vitor/IMDB/adicionar" method="post">
    
    <label>Titulo</label> 
    <input type="text" name="titulo" value="" required>
  
    <label>Diretor</label>
    <input type="text" name="diretor" value="" required>
  
    <label>Ano</label>
    <input type="number" name="ano" value="" required>

    <label>URL da Imagem</label>
    <input type="text" name="imagem_filme" value="" required>
  
    <label>Sinopse</label>
    <textarea name="sinopse" rows="2" required></textarea>
  
    <button type="submit" class="btn btn-primary">Salvar</button>
  
    <a href="/vitor/IMDB/filmes" class="btn btn-secondary">Cancelar</a>
</form>