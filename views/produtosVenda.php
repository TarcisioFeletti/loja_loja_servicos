<?php
require_once 'includes/autenticarMenu.inc.php';
require_once '../classes/servico.inc.php';
require_once '../dao/tipoDAO.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servicos = $_SESSION['servicos'];
$tipoDao = new TipoDAO();
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h1>Relação de Serviços</h1>
    <p>
    <div class='carrinho' align='right'>
        <a href="../controlers/controlerCarrinho.php?opcao=3"><img src="imagens/meu-carrinho.png"></a>
    </div>
    <?php
    foreach ($servicos as $servico) {
    ?>
        <table border="0" width="30%" cellspacing="10">
            <tr>
                <td rowspan="5" align="center">
                    <img src="imagens/produtos/<?php echo $servico->get_id_servico(); ?>.jpg" width="200" height="200" border="0">
                </td>
            </tr>
            <tr align="left">
                <font face="Verdana" size="3">
                    <td colspan="2"><b><?php echo $servico->get_nome(); ?></b></td>
                </font>
            </tr>
            <tr>
                <td style="text-align:justify" colspan="2">
                    <font face="Verdana" size="2"><?php echo $servico->get_descricao(); ?></font>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <font face="Verdana" size="2">
                        <?php
                        echo $tipoDao->getTipo($servico->get_id_tipo())->get_nome();
                        ?>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Verdana" size="3" color="red"><b>
                            <font color="black">Valor: </font><?php echo $servico->get_preco(); ?>
                        </b></font>
                </td>
                <td colspan="2"><?php echo '<a href="../controlers/controlerDiasDisponiveis.php?opcao=1&id=' . $servico->get_id_servico() . '"><img src="imagens/botao_comprar2.png" border="0"></a>' ?></td>
            </tr>
        </table>
        <p>
            <hr width="30%">
        <p>
        <?php
    }
        ?>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>