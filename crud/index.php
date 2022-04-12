<?php
    require_once './php-action/db-connect.php';
    require_once './includes/header.php';
    require_once './includes/menssage.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-4">Clientes</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Email</th>
                            <th>Idade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM client";
                        $result = mysqli_query($connect, $sql);
                        while ($data = mysqli_fetch_array($result)) :
                        ?>
                            <tr>
                                <td scope="row"><?php echo $data['name']; ?></td>
                                <td><?php echo $data['surname']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['age']; ?></td>
                                <td><a class="btn btn-success" href="#" role="button"><span class="material-icons">edit</span></a></td>
                                <td><a class="btn btn-danger" href="#" role="button"><span class="material-icons">delete</span></a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-primary mt-5" href="./adicionar.php" role="button">Adicionar Cliente</a>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php' ?>