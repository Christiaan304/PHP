<?php require_once './includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">

            <h2 class="text-center my-5">Novo Usuário</h2>

            <form action="./php-action/create.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary mt-3" name="btn-register">Cadastrar</button>
            </form>
            
        </div>
    </div>
</div>

<?php require_once './includes/footer.php' ?>