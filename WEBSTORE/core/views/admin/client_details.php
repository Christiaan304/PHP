<?php use core\classes\Functions; ?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <h3>Detalhe cliente</h3>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome completo</th>
                        <th>Cidade</th>
                        <th>Endereço</th>
                        <th>Número</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ativo</th>
                        <th>Cliente desde</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?= $client_details->Name ?></td>
                        <td><?= $client_details->City ?></td>
                        <td><?= $client_details->Address ?></td>
                        <td><?= $client_details->AddressNumber ?></td>
                        <td><?= $client_details->Phone ?></td>
                        <td><?= $client_details->Email ?></td>
                        <td><?= $client_details->Active == 1 ? '<i class="text-success fa-solid fa-check-circle"></i>' : '<i class="text-danger fa-solid fa-times-circle"></i>' ?></td>
                        <td><?= date('d/m/Y',  strtotime($client_details->CreatedAt)) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mt-3 text-center">
            <div class="col">
                <?php if ($total_orders == 0) : ?>
                    <p class="text-muted">Esse cliente não possui encomendas</p>
                <?php else : ?>
                    <a href="?a=client_order_history&id=<?= Functions::aes_encrypt($client_details->UUID) ?>" class="btn btn-primary">Ver historico de encomendas</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>