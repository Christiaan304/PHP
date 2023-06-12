<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-2">
            <?php require_once __DIR__ . '/layouts/admin_menu.php'; ?>
        </div>
        <div class="col-md-10">
            <div class="col-md-3">
                <h3>Encomendas pendentes</h3>
                <?php if ($get_orders_pending > 0) : ?>
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fa-solid fa-circle-info"></i> Existem <strong><?= $get_orders_pending ?></strong> encomendas pendentes</strong>, <a href="?a=order_list&status=pending">Ver</a>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fa-solid fa-check"></i> Não existem encomendas pendentes
                    </div>
                <?php endif; ?>
                <hr>                
                <h3>Encomendas em processo</h3>
                <?php if ($get_orders_processing > 0) : ?>
                    <div class="alert alert-info text-center" role="alert">
                        <i class="fa-solid fa-circle-info"></i> Existem <strong><?= $get_orders_processing ?></strong> encomendas em processo</strong>, <a href="?a=order_list&status=processing">Ver</a>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fa-solid fa-check"></i> Não existem encomendas em processo
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>