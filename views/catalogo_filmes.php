<?php
require_once __DIR__ . '/../models/Filmes.php';
$filmes = Filme::buscarFilmes();

?>
<h1>Catálogo de Filmes</h1>
<a href="filmes/novo" class="btn btn-primary">Adicionar Novo Filme</a>
<hr>

<?php foreach ($filmes as $filme): ?>
    <div>
        <h2><?php echo htmlspecialchars($filme->titulo); ?></h2>
        <p><strong>Diretor: </strong><?php echo htmlspecialchars($filme->diretor); ?></p>
        <p><strong>Ano: </strong><?php echo htmlspecialchars($filme->ano); ?></p>
        <p><strong>Sinopse: </strong><?php echo htmlspecialchars($filme->sinopse); ?></p>
        
        <a href="filmes/apagar/<?php echo $filme->id; ?>" 
           class="btn btn-danger" 
           onclick="return confirm('Tem certeza que deseja excluir este filme?');">
           Excluir
        </a>
        <hr>
    </div>
<?php endforeach; ?>