<?php
require_once '../classes/tipo.inc.php';
require_once '../dao/tipoDAO.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
$tipos = $_SESSION['tipos'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h1>Tipos Cadastrados</h1>
    <p>
        <font face="Tahoma">
            <div class="container">
                <table class="table" border="1" cellspacing="2" cellpadding="1" width="50%">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Operação</th>
                    </tr>
                    <?php
                    foreach ($tipos as $tipo) {
                        //MONTAGEM DA TABELA
                        echo "<tr>";
                        echo "<td>" . $tipo->get_id_tipo() . "</td>";
                        echo "<td>" . $tipo->get_nome() . "</td>";
                        echo "<td>" . $tipo->get_valor() . "</td>";
                        // ultima célula da tabela
                        echo "<td><a href='../controlers/controlerTipo.php?opcao=3&id=" . $tipo->get_id_tipo() . "'>Alterar</a>&nbsp;";
                        echo "<a href='../controlers/controlerTipo.php?opcao=5&id=" . $tipo->get_id_tipo() . "'>Excluir</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </font>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>