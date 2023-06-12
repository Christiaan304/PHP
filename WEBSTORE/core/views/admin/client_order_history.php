<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <h3>Detalhe da encomenda</h3>
            <hr>
            <?php if (count($client_order_history) == 0) : ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="fa-solid fa-circle-info"></i> Não existem clientes cadastrados
                </div>
            <?php else : ?>
                <table id="client_order_history" class="table table-striped">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-envelope"></i> Email</th>
                            <th><i class="fa-solid fa-phone"></i> Telefone</th>
                            <th>Endereço</th>
                            <th><i class="fa-solid fa-box"></i> Código encomenda</th>
                            <th>Status</th>
                            <th><i class="fa-solid fa-calendar-days"></i> Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client_order_history as $client) : ?>
                            <tr>
                                <td><?= $client->Email ?></td>
                                <td><?= $client->Telephone ?></td>
                                <td><?= $client->Address ?></td>
                                <td><?= $client->OrderCode ?></td>
                                <td><?= $client->Status ?></td>
                                <td><?= $client->CreatedAt ?></td>
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
        $('#client_order_history').DataTable({
            language: {
                decimal: ",",
                emptyTable: "Não existem clientes registradas",
                info: "Mostrando página _START_",
                infoFiltered: "(filtrado de _MAX_ clientes)",
                infoPostFix: "",
                thousands: ".",
                lengthMenu: "Mostrar _MENU_ páginas",
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