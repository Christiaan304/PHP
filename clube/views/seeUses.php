<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../public/script/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="../public/style/bootstrap.min.css">
    <link rel="shortcut icon" href="../public/images/favicon.ico" type="image/x-icon">
    <title>Usuários</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 mt-5 p-5">

            <div class="row">
                <div>
                    <h1>Usuários</h1>
                </div>

                <div class="col text-end">
                    <a href="logout.php">Logout</a>
                </div>
            </div>

            <?php if(count($users) == 0): ?>
                <p>Não foram encontrados usuários.</p>
            <?php else: ?>

                <div class="table table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Nome Completo</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['fullName'] ?></td>
                                </tr>                    
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>