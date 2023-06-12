<div class="container">
    <div class="row">
        <div class="col">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show col-6 mx-auto" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']) ?>
                </div>
            <?php endif ?>
            
            <form action="?a=change_personal_data_submit" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $personal_data->Name ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $personal_data->Email ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $personal_data->Address ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address_number" class="form-label">Número</label>
                            <input type="text" class="form-control" id="address_number" name="address_number" value="<?= $personal_data->AddressNumber ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?= $personal_data->City ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $personal_data->Phone ?>">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <input type="submit" value="Salvar" class="btn btn-success">
                    <a href="?a=profile" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>