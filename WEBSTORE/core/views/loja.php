<div class="container-fluid p-3">

    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja&c=todos" class="btn btn-primary mt-2">Todos</a>

            <?php foreach ($categories as $category) :  ?>
                <a href="?a=loja&c=<?= $category ?>" class="btn btn-primary mt-2"><?= ucfirst($category) ?></a>
            <?php endforeach  ?>
        </div>
    </div>

    <div class="row">

        <?php foreach ($products as $product) : ?>
            <div class="col-xl-3">
                <div class="card mx-auto my-3" style="width: 18rem;">
                    <img src="assets/images/products/<?= $product->Path ?>" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucfirst($product->ProductName) ?></h5>
                        <h5 class="card-text">R$ <?= number_format($product->Price, 2, ',', '.') ?></h5>
                        <p class="card-text"><?= $product->Description ?></p>

                        <?php if ($product->Quantity > 0) : ?>
                            <button class="btn btn-primary" onclick="addToCart('<?= $product->ProductUUID ?>')">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Adicionar ao carrinho
                            </button>
                        <?php else : ?>
                            <button class="btn btn-primary" disabled>Indisponível</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

</div>