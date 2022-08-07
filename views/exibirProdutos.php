<?php
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
require_once '../classes/produto.inc.php';
require_once 'includes/autenticar.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once '../dao/fabricanteDAO.inc.php';
require_once 'includes/iniciarSessao.inc.php';
$produtos = $_SESSION['produtos'];
$fabricantes = $_SESSION['fabricantes'];
$fabricanteDao = new FabricanteDAO();

if(!isset($_REQUEST['id']) || !isset($_SESSION['dias'])){
    echo "<h1 color='red'> Fluxo quebrado </h1>";
    echo "<h3>Retorne para a página <a href='index.php'>principal</a> </h3>";
}else{
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h1>Produtos cadastrados</h1>
    <p>
        <font face="Tahoma">
            <table border="1" cellspacing="2" cellpadding="1" width="50%">
                <tr>
                    <th witdh="10%">ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data de Fabricação</th>
                    <th>Preço unitário</th>
                    <th>Em Estoque</th>
                    <th>Fabricante</th>
                    <th>Operação</th>
                </tr>
                <?php
                foreach ($produtos as $produto) {
                    //MONTAGEM DA TABELA
                    echo "<tr>";
                    echo "<td>" . $produto->get_produto_id() . "</td>";
                    echo "<td>" . $produto->get_nome() . "</td>";
                    echo "<td>" . $produto->get_descricao() . "</td>";
                    echo "<td>" . formatarData($produto->get_data_fabricacao()) . "</td>";
                    echo "<td> R$ " . $produto->get_preco() . "</td>";
                    echo "<td>" . $produto->get_estoque() . "</td>";
                    echo "<td>" . $fabricanteDao->getFabricante($produto->get_cod_fabricante()) . "</td>";
                    /*foreach($fabricantes as $fabricante){
                    if($produto->get_cod_fabricante() == $fabricante->codigo){
                        echo "<td>". $fabricante->codigo . " - " . $fabricante->nome ."</td>";
                    }
                }*/
                    // ultima célula da tabela
                    echo "<td><a href='../controlers/controlerProduto.php?opcao=3&id=" . $produto->get_produto_id() . "'>Alterar</a>&nbsp;";
                    echo "<a href='../controlers/controlerProduto.php?opcao=4&id=" . $produto->get_produto_id() . "'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </font>
</div>
<?php
}
require_once 'includes/rodape.inc.php';
?>