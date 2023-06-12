<?php

use core\classes\Store;

$quantity = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $quantity += $item;
    }
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="?a=inicio">
            <img src="assets/images/icons/store.png" alt="Logo" width="32" class="d-inline-block align-text-top">
            WEBSTORE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?a=inicio">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?a=loja">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-5">
                    <a href="?a=carrinho"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
                    <span class="badge rounded-pill text-bg-warning" id="quantityCart"><?= $quantity > 0 ? $quantity : '' ?></span>  
                </li>

                <?php if (Store::LoggedClient()) : /*verifica se existe um cliente na sessão*/ ?>
                    <li class="nav-item me-3">
                        <a href="?a=profile" class="linknav"><i class="fa-solid fa-user fa-xl"></i> <?= $_SESSION['client_UserName'] ?></a>
                    </li>

                    <li class="nav-item me-3">
                        <a href="?a=logout" class="linknav"><i class="fa-solid fa-right-from-bracket fa-xl"></i> Sair</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item me-3">
                        <a href="?a=cadastro" class="linknav"><i class="fa-solid fa-user-plus fa-xl"></i> Criar conta</a>
                    </li>

                    <li class="nav-item me-3">
                        <a href="?a=login" class="linknav"><i class="fa-solid fa-right-to-bracket fa-xl"></i> Login</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>