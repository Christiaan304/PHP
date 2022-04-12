<?php 
    require_once './php-action/db-connect.php';
    require_once './includes/header.php';

    //select
    if(isset($_GET['id']))
    {
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM client WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);
        $data = mysqli_fetch_array($result);
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="text-center my-5">Editar Cliente</h2>
            <form action="./php-action/update.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $data['surname']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Idade</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $data['age']; ?>">
                </div>

                <button type="submit" class="btn btn-primary mt-3" name="btn-edit">Atualizar</button>
                <a class="btn btn-secondary mt-3" href="./index.php" role="button">Lista de Clientes</a>
            </form>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php' ?>