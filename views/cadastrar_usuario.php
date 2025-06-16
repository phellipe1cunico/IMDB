<?php require_once 'header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm mt-5">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Cadastrar Novo Usuário</h2>

                <form action="/vitor/IMDB/registrar" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nome de Usuário:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                        <div class="invalid-feedback">
                            Por favor, insira um nome de usuário.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Por favor, insira um e-mail válido.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" minlength="6" required>
                        <div class="invalid-feedback">
                            A senha deve ter pelo menos 6 caracteres.
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

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