<?php use core\classes\Functions; ?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <h3>Lista de encomendas <?= $filter != '' ? $filter : '' ?></h3>

            <hr>
            <div class="d-inline-flex">
                <div class="me-5">
                    <a href="?a=order_list" class="btn btn-primary">Ver todas as encomendas</a>
                </div>

                <div>
                    <select id="select_status" class="form-select" onchange="filter_status()">
                        <option selected>Selecione o status da encomenda</option>
                        <option value="pending">PENDENTE</option>
                        <option value="processing">EM PROCESSO</option>
                        <option value="cancelled">CANCELADA</option>
                        <option value="sent">ENVIADA</option>
                        <option value="completed">CONCLUÍDA</option>
                    </select>
                </div>
            </div>
            <hr>

            <?php if (count($order_list) == 0) : ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="fa-solid fa-circle-info"></i> Não existem encomendas registradas
                </div>
            <?php else : ?>
                <table id="order_list" class="table table-striped">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-calendar-days"></i> Data</th>
                            <th><i class="fa-solid fa-truck-fast"></i> Codigo encomenda</th>
                            <th><i class="fa-solid fa-signature"></i> Nome</th>
                            <th><i class="fa-solid fa-envelope"></i> Email</th>
                            <th><i class="fa-solid fa-phone"></i> Telefone</th>
                            <th><i class="fa-solid fa-spinner"></i> Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($order_list as $order) : ?>
                            <tr>
                                <td><?= date('d/m/Y H:i:s', strtotime($order->CreatedAt)) ?></td>
                                <td><?= $order->OrderCode  ?></td>
                                <td><?= $order->Name ?></td>
                                <td><?= $order->Email ?></td>
                                <td><?= $order->Telephone ?></td>
                                <td><a href="?a=order_details&order_id=<?= Functions::aes_encrypt($order->OrderID) ?>"><?= $order->Status ?></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#order_list').DataTable({
            language: {
                decimal: ",",
                emptyTable: "Não existem encomendas registradas",
                info: "Mostrando página _START_",
                infoFiltered: "(filtrado de _MAX_ encomendas)",
                infoPostFix: "",
                thousands: ".",
                lengthMenu: "Mostrar _MENU_ encomedas por página",
                loadingRecords: "Carregando...",
                processing: "",
                search: "Buscar <i class=\"fa-solid fa-magnifying-glass\"></i>:",
                zeroRecords: "Nenhuma encomenda encontrada para a busca",
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

    function filter_status() {
        var status = $('#select_status').val();
        //faz o reload da pagina com o status selecionado
        window.location.href = '?a=order_list&status=' + status;
    }
</script>