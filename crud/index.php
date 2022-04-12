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
                            <th>Editar</th>
                            <th>Excluir</th>
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

                                <!-- botao editar registro -->
                                    <td><a class="btn btn-success" href="edit.php?id=<?php echo $data['id']; ?>" role="button"><span class="material-icons">edit</span></a></td>
                                <!---->

                                <!-- botão deletar registro -->
                                    <td><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?php echo $data['id']; ?>" role="button"><span class="material-icons">delete</span></a></td>
                                <!---->

                                <!-- modal deletar registro -->
                                    <div class="modal fade" id="modal<?php echo $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title text-danger test-center" id="staticBackdropLabel">ATENÇÃO!</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <h5 class="text-danger">TEM CERTEZA QUE DESEJA EXCLUIR ESSE CLIENTE?</h5>
                                                </div>
                            
                                                <div class="modal-footer">                                                                        
                                                    <form action="./php-action/delete.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                        <button type="submit" name="btn-delete" class="btn btn-danger" data-bs-dismiss="modal">Sim</button>
                                                    </form>                                            
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <!---->
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