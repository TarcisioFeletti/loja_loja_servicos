<?php
require_once '../classes/servico.inc.php';
require_once '../classes/tipo.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
require_once '../utils/dataUtil.inc.php';
$servico = $_SESSION['servico'];
$tipos = $_SESSION['tipos'];
$datas = $_SESSION['datas'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Alteração de Serviço</h2>
    <p>
    <form action="../controlers/controlerServico.php" method="post">
        <p>ID: <input type="text" size="20%" name="pId" value="<?php echo $servico->get_id_servico() ?>" readonly>
        <p>Nome: <input type="text" size="50%" name="pNome" value="<?php echo $servico->get_nome() ?>">
        <p>Preço: <input type="number" min="0" name="pValor" value="<?php echo $servico->get_valor() ?>">
        <p>Descrição: <input type="text" size="90%" name="pDescricao" value="<?php echo $servico->get_descricao() ?>">
        <p>Tipo:
            <select name="pTipo">
                <?php
                foreach ($tipos as $tipo) {
                    if ($tipo->get_id_tipo() != $servico->get_id_tipo()) {
                        echo "<option value='" . $tipo->get_id_tipo() . "'>" . $tipo->get_id_tipo() . " - " . $tipo->get_nome() . "</option>";
                    } else {
                        echo "<option value='" . $tipo->get_id_tipo() . "' selected>" . $tipo->get_id_tipo() . " - " . $tipo->get_nome() . "</option>";
                    }
                }
                ?>
            </select>
        <p>Datas:
            <?php
            $count = 1;
            foreach ($datas as $data) {
                echo "<input type='date' name='pData" . $count . "' value='" . conversorData(strtotime($data->data_servico)) . "'>";
                $count++;
            }
            for ($i = $count; $i <= 7; $i++) {
                echo "<input type='date' name='pData" . $count . "'>";
                $count++;
            }
            ?>
        <p><input type="submit" value="Atualizar"> <input type="reset" value="Limpar">
            <input type="hidden" name="opcao" value="5">
    </form>
    <p>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>