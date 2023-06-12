<div class="container p-3">
    <div class="row my-5">
        <div class="col-md-12">
            <?php if ($cart != null) :  ?>
                <div class="table-reponsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Produto</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Excluir produto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            $total_rows = count($cart);
                            ?>
                            <?php foreach ($cart as $value) : ?>
                                <?php if ($index < $total_rows - 1) :  ?>
                                    <!-- lista dos produtos no carrinho -->
                                    <tr>
                                        <th class="align-middle" scope="row">
                                            <img class="img-fluid" src="assets/images/products/<?= $value['image'] ?>" width="60px">
                                        </th>
                                        <td class="align-middle"><?= $value['title'] ?></td>
                                        <td class="align-middle">R$ <?= number_format($value['price'], 2, ',', '.') ?></td>
                                        <td class="align-middle"><?= $value['quantity'] ?></td>
                                        <td class="align-middle">
                                            <a class="btn btn-danger" href="?a=remove_product&id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php else : ?>
                                    <!-- total -->
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="text-end"><strong>Subtotal:</strong></td>
                                        <td><strong>R$ <?= number_format($cart[array_key_last($cart)], 2, ',', '.') ?></strong></td>
                                        <td></td>
                                    </tr>
                                <?php endif ?>
                                <?php $index++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col">
                        <a class="btn btn-danger mb-5" data-bs-toggle="modal" data-bs-target="#clearcart">Limpar Carrinho</a>
                        <!-- modal clear cart -->
                        <div class="modal fade" id="clearcart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Atenção!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja limpar o carrinho?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-danger" href="?a=clear_cart">Limpar</a>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="?a=checkout" class="btn btn-success mb-5 float-end">Ir para o resumo</a>
                    </div>
                </div>
            <?php else : ?>
                <!-- carrinho vazio -->
                <h5 class="text-center">O carrinho está vazio <i class="fa-regular fa-face-frown"></i></h5>
                <div class="text-center mt-3">
                    <a href="?a=loja" class="btn btn-primary mx-auto">Ir para a loja</a>
                </div>
        </div>
    <?php endif ?>
    </div>
</div>
</div>