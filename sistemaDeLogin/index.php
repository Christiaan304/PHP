<?php
    //conexão
    require_once 'dbConnect.php';

    //sessão
    session_start();

    //btn entrar
    if(isset($_POST['btn-login']))
    {
        $errors = array();
        $login = mysqli_real_escape_string($conn, $_POST['login']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(empty($login) or empty($password))
        {
            $errors[] = "<p>O campo login e senha são obrigatórios</p>";
        }
        else
        {
            $sql = "SELECT login FROM users WHERE login = '$login'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                $password = sha1($password);
                $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) == 1)
                {
                    $data = mysqli_fetch_array($result);
                    mysqli_close($conn);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_user'] = $data['id'];

                    //redirecionar para pagina
                    header('Location: home.php');
                }
                else
                {
                    $errors[] = "Usuário ou senha não comferem";
                }
            }
            else
            {
                $errors[] = "Usuário inexistente";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5 pt-5 text-center">
            <div class="col-lg-4 offset-4 card">
                <?php
                    if(!empty($errors))
                    {
                        foreach($errors as $erro)
                        {
                            echo $erro;
                        }
                    }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="p-5">
                    <div class="mb-3">
                        <label class="form-label">Login</label>
                        <input type="text" class="form-control" name="login">
                    </div>

                    <div class="mb-3">
                        <label fo class="form-label">Senha</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <button type="submit" name="btn-login" class="btn btn-primary text-center mt-2">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>