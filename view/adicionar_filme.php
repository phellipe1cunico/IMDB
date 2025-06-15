<?php include 'header.php'; ?>

<h2>Novo Filme</h2>

<form action="adicionar" method="post">
    <input type="hidden" name="id" value="<?= $filme['id'] ?>">
    
    <label>Titulo</label> 
    <input type="text" name="titulo" value="<?= $filme['titulo'] ?? '' ?>" required>
  
    <label>Diretor</label>
    <input type="text" name="diretor" value="<?= $filme['diretor'] ?? '' ?>">
  
    <label>Ano</label>
    <input type="number" name="ano" value="<?= $f['ano'] ?? '' ?>">
  
    <label>Sinopse</label>
    <input type="text" name="sinopse" value="<?= $f['sinopse'] ?? '' ?>">
  
    <button type="submit" class="btn btn-primary">Salvar</button>
  
    <a href="catalogo_filmes.php" class="btn btn-secondary">Cancelar</a>
</form>

