<?php
    require_once '../phpAction/connectionDB.php';
    require_once '../phpAction/cypher.php';

    /*
    // alterar o tipo da coluna para varbinary

    $sql = "SELECT 
    AES_DECRYPT(nome, UNHEX(SHA2('" . AES_KEY . "', 512))) nome,
    AES_DECRYPT(telefone, UNHEX(SHA2('" . AES_KEY . "', 512))) telefone 
    FROM dados ORDER BY nome";
    */

    $sql = "SELECT * FROM dados ORDER BY nome";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Contatos</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mt-5">
                <h1 class="text-center">Contatos</h1>
                <div class="table-responsive-sm mt-5">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th><span class="material-icons">person</span>Nome</th>
                                <th><span class="material-icons">phone</span>Telefone</th>
                                <th>Editar/Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $dado) : ?>
                                <tr>
                                    <td><?= $dado['nome'] ?></td>
                                    <td><?= $dado['telefone'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href="editar.php?id=<?= aes_encrypt($dado['id']) ?>" role="button"><span class="material-icons">edit</span></a>
                                        <a class="btn btn-danger" href="../phpAction/removerContato.php?id=<?= aes_encrypt($dado['id']) ?>" role="button"><span class="material-icons">delete</span></a>
                                    </td>                                
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <p>Número de contatos: <strong><?= count($dados)?></strong></p>
                <a class="btn btn-primary mt-5" href="adicionar.php" role="button">Adicionar contato</a>
            </div>
        </div>
    </div>
</body>

</html>