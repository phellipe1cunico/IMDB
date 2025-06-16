<?php
// Note que esta view não precisa mais do require, pois o Controller já busca os dados.
?>
<?php include 'header.php'; ?>
<h1>Catálogo de Séries</h1>
<a href="/vitor/IMDB/series/novo" class="btn btn-primary">Adicionar Nova Série</a>
<hr>

<?php foreach ($series as $serie): ?>
    <div>
        <h2><?php echo htmlspecialchars($serie->titulo); ?></h2>
        <p><strong>Diretor: </strong><?php echo htmlspecialchars($serie->diretor); ?></p>
        <p><strong>Ano: </strong><?php echo htmlspecialchars($serie->ano); ?></p>
        <p><strong>Sinopse: </strong><?php echo htmlspecialchars($serie->sinopse); ?></p>
        
        <a href="/vitor/IMDB/series/editar/<?php echo $serie->id; ?>" class="btn btn-warning">Editar</a>
        <a href="/vitor/IMDB/series/apagar/<?php echo $serie->id; ?>" 
           class="btn btn-danger" 
           onclick="return confirm('Tem certeza que deseja excluir esta série?');">
           Excluir
        </a>
        <hr>
    </div>
<?php endforeach; ?>