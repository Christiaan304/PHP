<div class="container">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Codigo</th>
                            <th>Status</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $order_data->Address ?></td>
                            <td><?= $order_data->City ?></td>
                            <td><?= $order_data->Email ?></td>
                            <td><?= $order_data->Telephone  ?></td>
                            <td><?= $order_data->OrderCode  ?></td>
                            <td><?= $order_data->Status  ?></td>
                            <td><?= $order_data->CreatedAt ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <caption>
                        <h5><strong>Total: R$ <?= $total ?></strong></h5>
                    </caption>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_products as $order_product) : ?>
                            <tr>
                                <td><?= $order_product->ProductName ?></td>
                                <td><?= $order_product->Quantity ?></td>
                                <td>R$ <?= $order_product->PriceUnit ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>