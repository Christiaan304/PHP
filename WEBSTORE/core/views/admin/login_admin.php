<div class="container">
    <div class="row">
        <div class="col-md-5 my-5 mx-auto">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>

            <h4 class="text-center my-3">Admin Login</h4>

            <form class="row" action="?a=login_submit_admin" method="post">
                <div>
                    <label for="inputAdmin"><i class="fa-solid fa-user"></i> Usuário</label>
                    <input type="email" name="inputAdmin" class="form-control" id="inputAdmin" required>
                </div>

                <div class="mt-3">
                    <label for="inputPasswordAdmin"><i class="fa-solid fa-lock"></i> Senha</label>
                    <input type="password" name="inputPasswordAdmin" class="form-control" id="inputPasswordAdmin" required>
                </div>

                <div class="mt-3 col-3 mx-auto">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>