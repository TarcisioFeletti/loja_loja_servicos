<?php
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Cadastro de Tipo</h2>
    <p>
    <form action="../controlers/controlerTipo.php" method="post">
        Nome: <input type="text" size="30" name="pNome">
        <p>Valor: <input type="number" min="0" name="pValor">
        <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
            <input type="hidden" name="opcao" value="1">
    </form>
    <p>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>