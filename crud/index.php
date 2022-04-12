<?php require_once './includes/header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center my-5">Clientes</h2>
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
                        <tr>
                            <td scope="row">John</td>
                            <td>Doe</td>
                            <td>jd@mail.com</td>
                            <td>22</td>
                            <td><a class="btn btn-success" href="#" role="button"><span class="material-icons">edit</span></a></td>
                            <td><a class="btn btn-danger" href="#" role="button"><span class="material-icons">delete</span></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-primary mt-5" href="./adicionar.php" role="button">Adicionar Cliente</a>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php' ?>