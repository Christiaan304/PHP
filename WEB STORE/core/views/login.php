<div class="container">
    <div class="row">
        <div class="col-md-5 my-5 mx-auto">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-check fa-xl"></i>
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['success']) ?>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>

            <h4 class="text-center my-3">Login</h4>

            <form class="row" action="?a=login_submit" method="post">
                <div>
                    <label for="inputEmail"><i class="fa-solid fa-envelope"></i> Email</label>
                    <input type="email" name="inputEmail" class="form-control" id="inputEmail" required>
                </div>

                <div class="mt-3">
                    <label for="inputPassword"><i class="fa-solid fa-lock"></i> Senha</label>
                    <input type="password" name="inputPassword" class="form-control" id="inputPassword" required>
                </div>

                <div class="mt-3 col-3">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>