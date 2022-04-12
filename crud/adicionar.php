<?php require_once './includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center my-5">Novo Cliente</h2>
            <form action="./php-action/create.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Idade</label>
                    <input type="number" class="form-control" id="age" name="age">
                </div>

                <button type="submit" class="btn btn-primary mt-3" name="btn-register">Cadastrar</button>
                <a class="btn btn-secondary mt-3" href="./index.php" role="button">Lista de Clientes</a>
            </form>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php' ?>