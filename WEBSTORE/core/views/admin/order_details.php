<?php use core\classes\Functions; ?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <h4>
                Detalhe da encomenda -
                <small>
                    <?= $order_details->OrderCode ?> -

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                        <?= $order_details->Status ?>
                    </button>

                    <?php if ($order_details->Status == 'EM PROCESSO') : ?>
                        - <a href="?a=pdf_order&order_id=<?= Functions::aes_encrypt($order_details->OrderID) ?>" class="btn btn-primary">Ver PDF</a>
                        - <a href="?a=send_pdf&order_id=<?= Functions::aes_encrypt($order_details->OrderID) ?>" class="btn btn-primary">Enviar PDF</a>
                    <?php endif ?>
                </small>
            </h4>

            <!-- Modal -->
            <div class="modal fade" id="modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Alterar o status da encomenda</h1>
                        </div>
                        <div class="modal-body">
                            <?php foreach (STATUS as $status) : ?>
                                <?php if ($order_details->Status == $status) :  ?>
                                    <p><?= $status ?></p>
                                <?php else : ?>
                                    <p><a href="?a=alter_order_status&order_status=<?= $status ?>&order_id=<?= Functions::aes_encrypt($order_details->OrderID) ?>"><?= $status ?></a></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th>Nome do cliente</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Cidade</th>
                        <th>Endereço</th>
                        <th>Data da encomenda</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?= $order_details->Name ?></td>
                        <td><?= $order_details->Email ?></td>
                        <td><?= $order_details->Telephone ?></td>
                        <td><?= $order_details->City ?></td>
                        <td><?= $order_details->Address ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order_details->CreatedAt)) ?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($order_products as $products) : ?>
                        <tr>
                            <td><?= $products->ProductName ?></td>
                            <td>R$ <?= number_format($products->PriceUnit, 2, ',', '.') ?></td>
                            <td><?= $products->Quantity ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </div>
    </div>
</div>