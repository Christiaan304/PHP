<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12 offset-1">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>

            <form action="?a=change_password_submit" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Senha atual</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Nova senha</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    
                    <div class=" mb-3">
                        <label for="email" class="form-label">Confirme a senha</label>
                        <input type="password" class="form-control" name="new_password_confirm" required>
                    </div>

                <div class=" text-center">
                    <input type="submit" value="Salvar" class="btn btn-success">
                    <a href="?a=profile" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>