<?php include 'header.php'; ?>

<h2><?php echo isset($filme) ? 'Editar Filme' : 'Novo Filme'; ?></h2>

<form action="<?php echo isset($filme) ? '/vitor/IMDB/filmes/atualizar' : '/vitor/IMDB/adicionar'; ?>" method="post">
    
    <input type="hidden" name="id" value="<?php echo $filme->id ?? '' ?>">
    
    <label>Titulo</label> 
    <input type="text" name="titulo" value="<?php echo $filme->titulo ?? '' ?>" required>
  
    <label>Diretor</label>
    <input type="text" name="diretor" value="<?php echo $filme->diretor ?? '' ?>" required>
  
    <label>Ano</label>
    <input type="number" name="ano" value="<?php echo $filme->ano ?? '' ?>" required>

    <label>URL da Imagem</label>
    <input type="text" name="imagem_filme" value="<?php echo $filme->imagem_filme ?? '' ?>" required>
  
    <label>Sinopse</label>
    <textarea name="sinopse" rows="2" required><?php echo $filme->sinopse ?? '' ?></textarea>
  
    <button type="submit" class="btn btn-primary">Salvar</button>
  
    <a href="/vitor/IMDB/filmes" class="btn btn-secondary">Cancelar</a>
</form>