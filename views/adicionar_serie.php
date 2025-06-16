<?php include 'header.php'; ?>

<h2>Nova Serie</h2>

<form action="criar" method="post">
    <input type="hidden" name="id" value="<?= $serie['id'] ?>">
    
    <label>Titulo</label> 
    <input type="text" name="titulo" value="<?= $serie['titulo'] ?? '' ?>" required>
  
    <label>Diretor</label>
    <input type="text" name="diretor" value="<?= $serie['diretor'] ?? '' ?>">
  
    <label>Ano</label>
    <input type="number" name="ano" value="<?= $f['ano'] ?? '' ?>">
  
    <label>Sinopse</label>
    <input type="text" name="sinopse" value="<?= $f['sinopse'] ?? '' ?>">
  
    <button type="submit" class="btn btn-primary">Salvar</button>
  
    <a href="catalogo_series.php" class="btn btn-series">Cancelar</a>
</form>

