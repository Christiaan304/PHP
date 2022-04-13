<?php
    require_once './php-action/db-connection.php';
    require_once './includes/header.php';

    //sessão
    session_start();

    //menssagem de cadastro
    if (isset($_SESSION['menssage'])) :
        ?>
    
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert">
                            <span class="material-icons">info</span> <?php echo $_SESSION['menssage']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
    
        <?php
         session_unset();
    endif;

    //btn entrar
    if(isset($_POST['btn-login']))
    {
        $errors = array();
        $login = mysqli_real_escape_string($connect, $_POST['login']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        if(empty($login) or empty($password))
        {
            $errors[] = "<p>O campo login e senha são obrigatórios</p>";
        }
        else
        {
            $sql = "SELECT login FROM users WHERE login = '$login'";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                $password = sha1($password);
                $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
                $result = mysqli_query($connect, $sql);

                if(mysqli_num_rows($result) == 1)
                {
                    $data = mysqli_fetch_array($result);
                    mysqli_close($connect);
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

<div class="container">
    <div class="row mt-3 pt-5 text-center">
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
        <p class="mt-3">Não tem cadastro? Clique <a href="./register.php">aqui</a>.</p>
    </div>
</div>

<?php require_once './includes/footer.php'; ?>