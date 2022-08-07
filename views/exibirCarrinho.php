<?php
require_once 'includes/autenticarMenu.inc.php';
require_once 'includes/iniciarSessao.inc.php';
if(!isset($_REQUEST['carrinho'])){
    echo "<div class='corpo' align='center' style='line-height: 3cm;''>";
    echo "<h2><b>Carrinho vazio!</b></h2></div>";
}else{
require_once '../dao/tipoDAO.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3cm;">
    <h1>Carrinho de Compras</h1>
    <p>
        <?php
        if (isset($_REQUEST['status'])) {
            echo "<h2><b>Carrinho vazio!</b></h2>";
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $carrinho = $_SESSION['carrinho'];
            $contador = 0;
            $total = 0;
            $tipoDao = new TipoDAO();
            if (isset($_REQUEST['erro'])) {
                if ((int)($_REQUEST['erro']) == "1") {
                    echo "<b><font face='Verdana' size='2' color='red'>O serviço já existe no carrinho!</font></b>";
                }
            }
        ?>
            <font face="Tahoma">
                <table border="1" cellspacing="2" cellpadding="1" width="50%">
                    <tr>
                        <th witdh="10%">Nro</th>
                        <th width="10%">Foto</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Valor do Serviço</th>
                        <th>Valor do Tipo</th>
                        <th>Valor Total do Serviço</th>
                        <th>Data</th>
                        <th width="10%">Remover?</th>
                    </tr>
                    <?php
                    foreach ($carrinho as $servicoCarrinho) {
                        //MONTAGEM DA TABELA
                        $contador++;
                        $tipo = $tipoDao->getTipo($servicoCarrinho->get_id_tipo());
                        $total += $servicoCarrinho->get_valor() + $tipo->get_valor();
                        echo "<tr align='center'>";
                        echo "<td>" . $contador . "</td>";
                        echo "<td><img src='imagens/produtos/" . $servicoCarrinho->get_id_servico() . ".jpg' width='70%'></td>";
                        echo "<td>" . $servicoCarrinho->get_nome() . "</td>";
                        echo "<td>" . $tipo->get_nome() . "</td>";
                        echo "<td> R$ " . $servicoCarrinho->get_valor() . "</td>";
                        echo "<td> R$ " . $tipo->get_valor() . "</td>";
                        echo "<td> R$ " . $servicoCarrinho->get_valor() + $tipo->get_valor() . "</td>";
                        echo "<td>". formatarData($servicoCarrinho->get_data())."</td>"; //data aqui!
                        echo "<td><a href='../controlers/controlerCarrinho.php?opcao=2&id=" . ($contador - 1) . "'><img src='imagens/rem3.jpg'></a></td>";
                        echo "</tr>";
                    }
                    echo "<tr align='center'>";
                    echo "<td><font color='black'><b>Total<b></font></td>";
                    echo "<td colspan='4' align='right'><font color='red'><b> R$ " . $total . "</b></font></td>";
                    echo "</tr>";
                    ?>
                </table>
            </font>
        <?php
            echo "<a href='produtosVenda.php'><img src='imagens/botao_continuar_comprando.png'></a>";
            echo "<a href='../controlers/controlerCarrinho.php?opcao=4&total=" . $total . "'><img src='imagens/finalizarCompra.png'></a>";
        }
        ?>
</div>
<?php
}
require_once '../views/includes/rodape.inc.php';
?>