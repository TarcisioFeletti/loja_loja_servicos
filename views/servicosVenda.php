<?php
require_once '../classes/servico.inc.php';
require_once '../dao/tipoDAO.inc.php';
require_once 'includes/autenticarMenu.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servicos = $_SESSION['servicos'];
$tipoDao = new TipoDAO();
?>

<h1>Relação de Serviços</h1>
<p>
<div class='carrinho' align='right'>
    <a href="../controlers/controlerCarrinho.php?opcao=3"><img src="imagens/meu-carrinho.png"></a>
</div>
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <?php
        foreach ($servicos as $servico) {
        ?>
            <a href="../controlers/controlerDiasDisponiveis.php?opcao=1&id=<?php echo $servico->get_id_servico()?>">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img src="imagens/produtos/<?php echo $servico->get_id_servico(); ?>.jpg" width="200" height="200" border="0">
                    </div>
                    <div class="text-center py-4">
                        <p class="h6 text-decoration-none text-truncate"> <?php echo $servico->get_nome(); ?>
                        <p class="h6 text-decoration-none text-truncate"> <?php echo $servico->get_descricao(); ?>
                        <p class="h6 text-decoration-none text-truncate"> <?php echo $tipoDao->getTipo($servico->get_id_tipo())->get_nome(); ?>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5> R$ <?php echo $servico->get_valor(); ?> </h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <?php
        }
        ?>
    </div>
</div>

<?php
require_once 'includes/rodape.inc.php';
?>