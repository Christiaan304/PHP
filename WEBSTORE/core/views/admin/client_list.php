<?php use core\classes\Functions; ?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <h3>Lista de clientes</h3>
            <hr>
            <?php if (count($client_list) == 0) : ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="fa-solid fa-circle-info"></i> Não existem clientes cadastrados
                </div>
            <?php else : ?>
                <table id="client_list" class="table table-striped">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-signature"></i> Nome</th>
                            <th><i class="fa-solid fa-envelope"></i> Email</th>
                            <th><i class="fa-solid fa-phone"></i> Telefone</th>
                            <th><i class="fa-solid fa-box"></i> Encomendas</th>
                            <th>Ativo</th>
                            <th><i class="fa-solid fa-calendar-days"></i> Deletado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client_list as $client) : ?>
                            <tr>
                                <td>
                                    <a href="?a=client_details&id=<?= Functions::aes_encrypt($client->UUID) ?>">
                                        <?= $client->Name ?>
                                    </a>
                                </td>
                                <td><?= $client->Email ?></td>
                                <td><?= $client->Phone ?></td>
                                <td>
                                    <?php if ($client->Total_Orders == 0) : ?>
                                        -
                                    <?php else : ?>
                                        <a href="?a=order_list&id=<?= Functions::aes_encrypt($client->UUID) ?>"><?= $client->Total_Orders ?></a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $client->Active == 1 ? '<i class="text-success fa-solid fa-check-circle"></i>' : '<i class="text-danger fa-solid fa-times-circle"></i>' ?></td>
                                <td><?= $client->DeletedAt == null ? '-' : date('d/m/Y H:i:s', strtotime($client->DeletedAt)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#client_list').DataTable({
            language: {
                decimal: ",",
                emptyTable: "Não existem clientes registradas",
                info: "Mostrando página _START_",
                infoFiltered: "(filtrado de _MAX_ clientes)",
                infoPostFix: "",
                thousands: ".",
                lengthMenu: "Mostrar _MENU_ clientes por página",
                loadingRecords: "Carregando...",
                processing: "",
                search: "Buscar <i class=\"fa-solid fa-magnifying-glass\"></i>:",
                zeroRecords: "Nenhuma cliente encontrado para a busca",
                paginate: {
                    "first": "Primeiro",
                    "last": "Ultimo",
                    "next": "Proximo",
                    "previous": "Anterior"
                },
                aria: {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });
    });
</script>