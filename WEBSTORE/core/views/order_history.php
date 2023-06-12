<?php use core\classes\Functions; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
            if (!empty($order_history)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Código encomenda</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_history as $order) :  ?>
                            <tr>
                                <td><?= $order->OrderCode ?></td>
                                <td><?= $order->Status ?></td>
                                <td><?= $order->CreatedAt  ?></td>
                                <td>
                                    <a href="?a=order_details&order_id=<?= Functions::aes_encrypt($order->OrderID) ?>" type="button" class="btn btn-primary">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <p>Total encomendas: <strong><?= count($order_history) ?></strong></p>
            <?php else : ?>
                <p class="text-center">Não há encomenda registada</p>
            <?php endif ?>
        </div>
    </div>
</div>