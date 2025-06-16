<?php include 'header.php'; ?>

<h2><?php echo isset($serie) ? 'Editar Série' : 'Nova Série'; ?></h2>

<form action="<?php echo isset($serie) ? '/vitor/IMDB/series/atualizar' : '/vitor/IMDB/adicionar_serie'; ?>" method="post">
    
    <input type="hidden" name="id" value="<?php echo $serie->id ?? '' ?>">
    
    <label>Titulo</label> 
    <input type="text" name="titulo" value="<?php echo $serie->titulo ?? '' ?>" required>
  
    <label>Diretor</label>
    <input type="text" name="diretor" value="<?php echo $serie->diretor ?? '' ?>" required>
  
    <label>Ano</label>
    <input type="number" name="ano" value="<?php echo $serie->ano ?? '' ?>" required>

    <label>URL da Imagem</label>
    <input type="text" name="imagem_serie" value="<?php echo $serie->imagem_serie ?? '' ?>" required>
  
    <label>Sinopse</label>
    <textarea name="sinopse" rows="2" required><?php echo $serie->sinopse ?? '' ?></textarea>
  
    <button type="submit" class="btn btn-primary">Salvar</button>
  
    <a href="/vitor/IMDB/series" class="btn btn-secondary">Cancelar</a>
</form>