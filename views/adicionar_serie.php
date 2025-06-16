<?php include 'header.php'; ?>

<h2 class="mb-4"><?php echo isset($serie) ? 'Editar Série' : 'Nova Série'; ?></h2>

<form action="<?php echo isset($serie) ? '/vitor/IMDB/series/atualizar' : '/vitor/IMDB/adicionar_serie'; ?>" method="post" class="needs-validation" novalidate>
    
    <?php if (isset($serie)): ?>
        <input type="hidden" name="id" value="<?php echo $serie->id ?? ''; ?>">
    <?php endif; ?>
    
    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label> 
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($serie->titulo ?? ''); ?>" required>
        <div class="invalid-feedback">
            Por favor, insira o título da série.
        </div>
    </div>
  
    <div class="mb-3">
        <label for="diretor" class="form-label">Diretor</label>
        <input type="text" class="form-control" id="diretor" name="diretor" value="<?php echo htmlspecialchars($serie->diretor ?? ''); ?>" required>
        <div class="invalid-feedback">
            Por favor, insira o diretor da série.
        </div>
    </div>
  
    <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano" value="<?php echo htmlspecialchars($serie->ano ?? ''); ?>" required min="1888" max="<?php echo date('Y') + 5; ?>">
        <div class="invalid-feedback">
            Por favor, insira um ano válido para a série.
        </div>
    </div>

    <div class="mb-3">
        <label for="imagem_serie" class="form-label">URL da Imagem</label>
        <input type="url" class="form-control" id="imagem_serie" name="imagem_serie" value="<?php echo htmlspecialchars($serie->imagem_serie ?? ''); ?>" required>
        <div class="invalid-feedback">
            Por favor, insira a URL da imagem da série.
        </div>
    </div>
  
    <div class="mb-3">
        <label for="sinopse" class="form-label">Sinopse</label>
        <textarea class="form-control" id="sinopse" name="sinopse" rows="4" required><?php echo htmlspecialchars($serie->sinopse ?? ''); ?></textarea>
        <div class="invalid-feedback">
            Por favor, insira a sinopse da série.
        </div>
    </div>
  
    <button type="submit" class="btn btn-primary me-2">Salvar</button>
  
    <a href="/vitor/IMDB/series" class="btn btn-secondary">Cancelar</a>
</form>

<script>
// Exemplo de JavaScript para desativar o envio de formulários se houver campos inválidos
(function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; <?php echo date("Y"); ?> IMDB Clone. Todos os direitos reservados.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>