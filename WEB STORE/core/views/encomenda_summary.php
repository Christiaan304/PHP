<div class="container p-3">
    <div class="row my-5">
        <div class="col-md-12">
            <div class="table-reponsive">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
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
                                    <td class="align-middle"><?= $value['title'] ?></td>
                                    <td class="align-middle">R$ <?= number_format($value['price'], 2, ',', '.') ?></td>
                                    <td class="align-middle"><?= $value['quantity'] ?></td>
                                </tr>
                            <?php else : ?>
                                <!-- total -->
                                <tr>
                                    <td class="text-end"><strong>Subtotal:</strong></td>
                                    <td><strong>R$ <?= number_format($cart[array_key_last($cart)], 2, ',', '.') ?></strong></td>
                                </tr>
                            <?php endif ?>
                            <?php $index++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <h5 class="bg-dark text-white p-2 mt-5">Seus dados</h5>
            <div class="row">
                <div class="col">
                    <p>Nome: <?= $client->Name ?></p>
                    <p>Endereço: <?= $client->Address ?>, <?= $client->AddressNumber ?></p>
                    <p>Cidade: <?= $client->City ?></p>
                </div>
                <div class="col">
                    <p>Email: <?= $client->Email ?></p>
                    <p>Telefone: <?= $client->Phone ?></p>
                </div>
            </div>

            <h5 class="bg-dark text-white p-2 mt-3">Dados do pagamento</h5>
            <div class="row">
                <div class="col">
                    <p>Conta bancária: 152757</p>
                    <p>Codigo do pedido: <?= $_SESSION['codigo_encomenda']  ?></p>
                    <p>Total: R$ <?= number_format($cart[array_key_last($cart)], 2, ',', '.') ?></p>
                </div>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="other_address" id="check_other_address" onchange="toggleOtherAddress()">
                <label class="form-check-label" for="check_other_address">Usar outro endereço</label>
            </div>

            <div id="other_address" style="display: none">
                <div class="row mt-3">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmailOther" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="inputPhoneOther" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="inputAddressOther" placeholder="1234 Main St">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="inputCityOther" placeholder="New York">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <a href="?a=carrinho" type="button" class="btn btn-danger mb-5">Cancelar</a>
                </div>
                <div class="col">
                    <a href="?a=agradecimento" onclick="otherData()" type="button" class="btn btn-success mb-5 float-end">
                        <i class="fa-solid fa-money-bill"></i> Finalizar pedido
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>