<?php
require_once '../classes/servico.inc.php';
require_once '../dao/tipoDAO.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
$servicos = $_SESSION['servicos'];
$tipoDao = new TipoDAO();
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h1>Serviços Cadastrados</h1>
    <p>
        <font face="Tahoma">
            <table border="1" cellspacing="2" cellpadding="1" width="50%">
                <tr>
                    <th witdh="10%">ID</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Operação</th>
                </tr>
                <?php
                foreach ($servicos as $servico) {
                    //MONTAGEM DA TABELA
                    echo "<tr>";
                    echo "<td>" . $servico->get_id_servico() . "</td>";
                    echo "<td>" . $servico->get_nome() . "</td>";
                    echo "<td> R$ " . $servico->get_valor() . "</td>";
                    echo "<td>" . $servico->get_descricao() . "</td>";
                    echo "<td>" . $tipoDao->getTipo($servico->get_id_tipo())->get_nome() . "</td>";
                    // ultima célula da tabela
                    echo "<td><a href='../controlers/controlerServico.php?opcao=3&id=" . $servico->get_id_servico() . "'>Alterar</a>&nbsp;";
                    echo "<a href='../controlers/controlerProduto.php?opcao=4&id=" . $servico->get_id_servico() . "'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </font>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>