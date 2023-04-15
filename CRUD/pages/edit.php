<?php
if (!isset($_GET['id'])) {
    header("Location: pagina.php");
    exit;
}

require_once("../scripts/EasyPDO.php");
require_once("../scripts/functions.php");
require_once("../scripts/config.php");
use EasyPDO\EasyPDO;
$bd = new EasyPDO();

$userID = aes_decrypt($_GET['id']);

if ($userID == -1 || $userID == false) {
    header("Location: Restrict.php");
    exit;
}

$params = [
    ':id' => $userID
];

$contact = $bd->select("SELECT 
                        UserID,
                        AES_DECRYPT(UserName, UNHEX(SHA2('". KEY ."', 512))) AS UserName,
                        AES_DECRYPT(UserEmail, UNHEX(SHA2('". KEY ."', 512))) AS UserEmail
                        FROM users WHERE UserID = :id", 
                        $params)[0];
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Editar contato</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-6 mx-auto">
                <form class="row" action="../scripts/edit_submit.php" method="POST">
                    <input type="hidden" name="UserID" value="<?= aes_encrypt($userID) ?>">

                    <div class="col-md-12">
                        <label class="form-label" for="inputUser">Usuário:</label>
                        <input class="form-control" type="text" name="inputUser" id="inputUser" maxlength="60" value="<?= $contact['UserName'] ?>" required>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label" for="inputEmail">Email:</label>
                        <input class="form-control" type="email" name="inputEmail" id="inputEmail" value="<?= $contact['UserEmail'] ?>" maxlength="100" required>
                    </div>

                    <div class="col-md-3 mt-4">
                        <button class="btn btn-success" type="submit">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- what do you want here? -->