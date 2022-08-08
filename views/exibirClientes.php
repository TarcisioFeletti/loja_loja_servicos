<?php
require_once '../classes/cliente.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
$clientes = $_SESSION['clientes'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h1>Clientes Cadastrados</h1>
    <p>
        <font face="Tahoma">
            <table border="1" cellspacing="2" cellpadding="1" width="50%">
                <tr>
                    <th witdh="10%">ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Data de Exclusão</th>
                    <th>E-mail</th>
                    <th>Operação</th>
                </tr>
                <?php
                foreach ($clientes as $cliente) {
                    //MONTAGEM DA TABELA
                    echo "<tr>";
                    echo "<td>" . $cliente->get_id_cliente() . "</td>";
                    echo "<td>" . $cliente->get_nome() . "</td>";
                    echo "<td>" . $cliente->get_endereco() . "</td>";
                    echo "<td>" . $cliente->get_telefone() . "</td>";
                    echo "<td>" . $cliente->get_cpf() . "</td>";
                    echo "<td>" . formatarData($cliente->get_dt_nascimento()) . "</td>";
                    if ($cliente->get_dt_exclusao() == null) {
                        echo "<td>Ativo</td>";
                    } else {
                        echo "<td>" . formatarData($cliente->get_dt_exclusao()) . "</td>";
                    }
                    echo "<td>" . $cliente->get_email() . "</td>";
                    // ultima célula da tabela
                    echo "<td><a href='../controlers/controlerCliente.php?opcao=10&id=" . $cliente->get_id_cliente() . "'>Alterar</a>&nbsp;";
                    echo "<a href='../controlers/controlerCliente.php?opcao=12&id=" . $cliente->get_id_cliente() . "'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </font>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>