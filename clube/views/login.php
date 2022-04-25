<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/bootstrap.min.css">
    <title>login</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 card mt-5 p-5">
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <?php if(isset($error)): ?>
                        <p class="alert alert-danger text-center">
                            <?= $error ?>
                        </p>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>