

<div class="container p-5">
    <div class="row">
        <div class="col-md mx-auto text-center">
            <p>Pedido confirmado, obrigado por comprar conosco.</p>

            <div class="my-5">
                <h4>Dados do pagamento</h4>
                <p>Conta bancária: 152757</p>
                <p>Código do pedido: <?= $codigo_encomenda ?></p>
                <p>Total: R$ <?= number_format($total, 2, ',', '.') ?></p>
            </div>

            <p>
                Foi enviado um email com os detalhes do seu pedido e os dados de pagamento. <br>
                Por favor verifique sua caixa de entrada ou spam.
            </p>
            <div class="my-5">
                <a href="?a=inicio" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</div>