<div class="container-fluid p-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h4 class="mb-4"><i class="fa-solid fa-user-plus"></i> Novo cadastro:</h4>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-check fa-xl"></i>
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['success']) ?>
                </div>
            <?php endif ?>

            <form class="row" action="?a=cadastro_submit" method="post">
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <label for="inputName" class="form-label"><i class="fa-solid fa-signature"></i> Nome:</label>
                        <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Nome completo" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputUserName" class="form-label"><i class="fa-solid fa-circle-user"></i> Nome de usuário:</label>
                        <input type="text" class="form-control" name="inputUserName" id="inputUserName" placeholder="Nome de usuário" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputEmail" class="form-label"><i class="fa-solid fa-envelope"></i> Email:</label>
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="example@mail.com" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-3">
                        <label for="inputPhone" class="form-label"><i class="fa-solid fa-phone"></i> Telefone/Celular:</label>
                        <input type="text" class="form-control" name="inputPhone" id="inputPhone" placeholder="(XX) XXXXX-XXXX" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputPassword" class="form-label">
                            <i class="fa-solid fa-lock"></i> Senha:
                        </label>
                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputPassword" class="form-label">
                            <i class="fa-solid fa-lock"></i> Confirmar senha:
                        </label>
                        <input type="password" class="form-control" name="inputPasswordConfirm" id="inputPassword" required>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 mt-3">
                        <label for="inputAddress" class="form-label"><i class="fa-solid fa-location-dot"></i> Endereço:</label>
                        <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Endereço completo" required>
                    </div>

                    <div class="col-md-2 mt-3">
                        <label for="inputAddressNumber" class="form-label"><i class="fa-solid fa-hashtag"></i> Número:</label>
                        <input type="number" class="form-control" name="inputAddressNumber" id="inputAddressNumber" placeholder="Numero" min="1" step="1" required>
                    </div>

                    <div class="col-md-4 mt-3">
                        <label for="inputCity" class="form-label"><i class="fa-solid fa-city"></i> Cidade:</label>
                        <input type="text" class="form-control" name="inputCity" id="inputCity" placeholder="Cidade" required>
                    </div>
                </div>

                <input type="submit" value="Cadastrar" class="btn btn-success mt-5 col-2">
            </form>
        </div>
    </div>
</div>