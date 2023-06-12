<?php

use core\classes\Store;
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="?a=inicio">
            <img src="../assets/images/icons/store.png" alt="Logo" width="32" class="d-inline-block align-text-top">
            WEBSTORE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (Store::LoggedAdmin()) : /*verifica se existe um cliente na sessão*/ ?>
                    <li class="nav-item me-3">
                        <a href="?a=admin_profile" class="linknav"><i class="fa-solid fa-user fa-xl"></i> <?= $_SESSION['admin'] ?></a>
                    </li>

                    <li class="nav-item me-3">
                        <a href="?a=admin_logout" class="linknav"><i class="fa-solid fa-right-from-bracket fa-xl"></i> Sair</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>