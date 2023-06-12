<div class="container">
    <div class="row my-5">
        <div class="col">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success  alert-dismissible fade show col-3 mx-auto" role="alert">
                    <i class="fa-solid fa-circle-check fa-xl"></i>
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['success']) ?>
                </div>
            <?php endif ?>
            <table class="table table-borderless">
                <?php foreach ($client_profile as $key => $value) : ?>
                    <tr>
                        <td class="text-end" width="40%"><?= $key ?>:</td>
                        <td width="60%"><strong><?= $value ?></strong></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>