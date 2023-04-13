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
    <title>Cadastrar</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-6 mx-auto">
                <?php if (isset($_GET['emil'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        Email inválido.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <form class="row" action="../scripts/cadastro_submit.php" method="post">
                    <div class="col-md-12">
                        <label class="form-label" for="inputUser">Usuário:</label>
                        <input class="form-control" type="text" name="inputUser" id="inputUser" maxlength="60" required>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label" for="inputPassword">Senha:</label>
                        <input class="form-control" type="password" name="inputPassword" id="inputPassword" maxlength="60" required>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label" for="inputEmail">Email:</label>
                        <input class="form-control" type="email" name="inputEmail" id="inputEmail" placeholder="example@mail.com" maxlength="100" required>
                    </div>

                    <div class="form-check mt-4 ml-3">
                        <input class="form-check-input col-md-12" type="checkbox" name="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Li e concondo com os <a href="#">termos</a> do site.
                        </label>

                        <?php if (isset($_GET['err'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                Por favor, concorde com os termos do site.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="col-md-3 mt-4">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>

<!-- what do you want here? -->