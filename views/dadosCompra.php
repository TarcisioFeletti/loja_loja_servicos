<?php
require_once '../classes/servico.inc.php';
require_once '../classes/cliente.inc.php';
require_once '../classes/data.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../dao/tipoDAO.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarMenu.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3cm;">
    <h1>Finalizar Compra</h1>
    <p>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cliente'])) {
            echo "<h2><b>Carrinho vazio!</b></h2>";
        } else {
            $cliente = $_SESSION['cliente'];
            $carrinho = $_SESSION['carrinho'];
            $total = $_SESSION['total'];
            $tipoDao = new TipoDAO();
        ?>
    <div class="container" style="line-height: 1cm;">
        <ul class="list-group">
            <li class="list-group-item">Nome: <?php echo $cliente->get_nome() ?></li>
            <li class="list-group-item">CPF: <?php echo $cliente->get_cpf() ?></li>
            <li class="list-group-item">Endereço: <?php echo $cliente->get_endereco() ?></li>
            <li class="list-group-item">Telefone: <?php echo $cliente->get_telefone() ?></li>
            <li class="list-group-item">E-mail: <?php echo $cliente->get_email() ?></li>
            <br>
        </ul>
    </div>
    <font face="Tahoma">
        <div class="container">
            <table class="table" border="1" cellspacing="2" cellpadding="1" width="50%">
                <tr>
                    <th width="10%">Foto</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Valor Total do Serviço</th>
                    <th>Data</th>
                </tr>
                <?php
                foreach ($carrinho as $servicoCarrinho) {
                    //MONTAGEM DA TABELA
                    $tipo = $tipoDao->getTipo($servicoCarrinho->get_id_tipo());
                    echo "<tr align='center'>";
                    echo "<td><img src='imagens/produtos/" . $servicoCarrinho->get_id_servico() . ".jpg' width='70%'></td>";
                    echo "<td>" . $servicoCarrinho->get_nome() . "</td>";
                    echo "<td>" . $tipo->get_nome() . "</td>";
                    echo "<td> R$ " . $servicoCarrinho->get_valor() + $tipo->get_valor() . "</td>";
                    echo "<td>" . formatarData($servicoCarrinho->get_data()->get_data_servico()) . "</td>";
                    echo "</tr>";
                }
                echo "<tr align='center'>";
                echo "<td><font color='black'><b>Total<b></font></td>";
                echo "<td colspan='4' align='right'><font color='red'><b> R$ " . $total . "</b></font></td>";
                echo "</tr>";
                ?>
            </table>
        </div>
    </font>
    <form action="dadosPagamento.php">
        <input class="btn btn-primary" type="submit" value="Proximo>>>">
    </form>
<?php
        }
?>
</div>
<?php
require_once '../views/includes/rodape.inc.php';
?>