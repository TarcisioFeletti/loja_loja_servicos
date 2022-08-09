<?php
require_once '../classes/tipo.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
$tipo = $_SESSION['tipo'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Alteração de Tipo</h2>

    <div class="login-page">
        <div class="form">
            <form action="../controlers/controlerTipo.php" method="post">
                ID: <input type="text" size="20" name="pId" value="<?php echo $tipo->get_id_tipo() ?>" readonly>
                <p>Nome: <input type="text" size="30" name="pNome" value="<?php echo $tipo->get_nome() ?>">
                <p>Valor: <input type="number" min="0" name="pValor" value="<?php echo $tipo->get_valor() ?>">
                <p><input type="submit" value="Atualizar"> <input type="reset" value="Cancelar">
                    <input type="hidden" name="opcao" value="4">
            </form>
        </div>
    </div>

</div>
<?php
require_once 'includes/rodape.inc.php';
?>