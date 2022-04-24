<?php  
    if (!isset($_GET['id']))
    {
        die(':(');
    }

    require_once '../phpAction/connectionDB.php';
    require_once '../phpAction/cypher.php';

    $id = $_GET['id'];
    $id = aes_decrypt($id);
    if($id == -1 || $id == false)
    {
        die(':(');
    }

    $sql = "SELECT * FROM dados WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
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
    <title>Editar Contato</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 card mt-5 p-5">
                <form action="../phpAction/editarContato.php" method="POST">

                    <input type="hidden" name="id" value="<?= aes_encrypt($dados['id']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Nome </label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $dados['nome'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $dados['telefone'] ?>">
                    </div>     

                    <button name="editar" type="submit" class="btn btn-primary">Editar</button>
                    <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>