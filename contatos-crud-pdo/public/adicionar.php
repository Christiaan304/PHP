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
    <title>Adicionar Contatos</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 mt-5 card p-5">
                <form action="../phpAction/adicionarContato.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="50" placeholder="digite o nome do contato" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" maxlength="50" placeholder="(99) 99999-9999" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                    <a class="btn btn-secondary mt-4" href="index.php" role="button">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>