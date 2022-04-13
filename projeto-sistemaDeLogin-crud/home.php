<?php
require_once './php-action/db-connection.php';
require_once './includes/header.php';

//sessão
session_start();

//verificação
if (!isset($_SESSION['logado'])) {
    header('Location: index.php');
}

//dados
$id = $_SESSION['id_user'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($result);
mysqli_close($connect);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>

        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>

            <a href="./php-action/logout.php">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-6 offset-3">
            <h1>Olá <?php echo $data['name']; ?></h1>
        </div>
    </div>
</div>