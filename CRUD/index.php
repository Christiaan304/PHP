<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: pages/pagina.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icons/favicon.ico" type="image/x-icon">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-6 mx-auto">
                <?php if (isset($_GET['err'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        Usuário ou senha incorreto
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <?php if (isset($_GET['sccss'])) : ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Usuário cadastrado com sucesso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <form class="row" action="scripts/login_submit.php" method="post">
                    <div class="col-md-12">
                        <label class="form-label" for="inputUser">Usuário:</label>
                        <input class="form-control" type="text" name="inputUser" id="inputUser" required>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="form-label" for="inputPassword">Senha:</label>
                        <input class="form-control" type="password" name="inputPassword" id="inputPassword" required>
                    </div>

                    <div class="col-md-2 mt-4">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>

                <p class="mt-4">Clique <a href="pages/cadastro.php">aqui</a> para cadastrar-se.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>

<!-- what do you want here? -->