<?php
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarRestrito.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Cadastro de Tipo</h2>

    <div class="login-page">
        <div class="form">
            <form action="../controlers/controlerTipo.php" method="post">
                Nome: <input type="text" size="30" name="pNome" minlength="1" required maxlength="50">
                <p>Valor: <input type="number" min="0" name="pValor" minlength="1" required>
                <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
                    <input type="hidden" name="opcao" value="1">
            </form>
        </div>
    </div>

</div>
<?php
require_once 'includes/rodape.inc.php';
?>