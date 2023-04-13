<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}

require_once('../scripts/functions.php');
require_once('../scripts/EasyPDO.php');
require_once('../scripts/config.php');

use EasyPDO\EasyPDO;

$_bd = new EasyPDO();

$_users = $_bd->select("SELECT 
                        UserId,
                        AES_DECRYPT(UserName, UNHEX(SHA2('" . KEY . "', 512))) AS UserName,
                        AES_DECRYPT(UserEmail, UNHEX(SHA2('" . KEY . "', 512))) AS UserEmail
                        FROM users ORDER BY UserName");
?>

<!DOCTYPE html>
<html lang="pt">

<?php include_once('../includes/head.php') ?>

<body>
    <?php include_once('../includes/nav.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <?php if (isset($_GET['dlt'])) : ?>
                    <div class="alert alert-info alert-dismissible fade show col-6 mx-auto" role="alert">
                        Usuário apagado com sucesso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <?php if (isset($_GET['edt'])) : ?>
                    <div class="alert alert-info alert-dismissible fade show col-6 mx-auto" role="alert">
                        Usuário editado com sucesso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <?php if (!empty($_users)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered caption-top">
                            <caption>Quantidade de contatos: <strong><?= count($_users) ?></strong></caption>
                            <thead>
                                <tr>
                                    <th scope="row">Usuário</th>
                                    <th scope="row">Email</th>
                                    <th scope="row">Editar</th>
                                    <th scope="row">Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_users as $user) : ?>
                                    <tr>
                                        <td><?= $user['UserName'] ?></td>
                                        <td><?= $user['UserEmail'] ?></td>
                                        <td scope="row">
                                            <a class="btn btn-success" href="edit.php?id=<?= aes_encrypt($user['UserId']) ?>">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                        </td>
                                        <td scope="row">
                                            <a class="btn btn-danger" href="../scripts/delete.php?id=<?= aes_encrypt($user['UserId']) ?>">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p>A tabela está vazia</p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>