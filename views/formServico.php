<?php
require_once '../classes/tipo.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
$tipos = $_SESSION['tipos'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Cadastro de Serviço</h2>
    <p>
    <form action="../controlers/controlerServico.php" method="post" enctype="multipart/form-data">
        Nome: <input type="text" size="50" name="pNome">
        <p>Valor: <input type="number" min="0" name="pValor">
        <p>Descrição: <input type="text" size="250" name="pDescricao">
        <p>Tipo:
            <select name="pTipo">
                <option value="()">-</option>>
                <?php
                foreach ($tipos as $tipo) {
                    echo "<option value='" . $tipo->get_id_tipo() . "'>" . $tipo->get_id_tipo() . " - " . $tipo->get_nome() . "</option>";
                }
                ?>
            </select>
        <p>Datas:
            <input type="date" name="pData1">
            <input type="date" name="pData2">
            <input type="date" name="pData3">
            <input type="date" name="pData4">
            <input type="date" name="pData5">
            <input type="date" name="pData6">
            <input type="date" name="pData7">
        <p>Foto: <input type="file" name="imagem" />
        <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
            <input type="hidden" name="opcao" value="1">
    </form><br>
    <p>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>