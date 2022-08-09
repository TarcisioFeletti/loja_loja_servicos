<?php
require_once 'includes/autenticarMenu.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Login do Cliente</h2>
    <p>

    <div class="login-page">
        <div class="form">
            <form class="login-form" action="../controlers/controlerCliente.php" method="get">
                <input type="email" placeholder="Login" size="20" name="pLogin" required/>
                <input type="password" placeholder="Senha" size="10" name="pSenha" required />
                <input class="input_btn_login" type="submit" value="Login">
                <p></p>
                <input class="input_btn_cancelar" type="reset" value="Cancelar">
                <input type="hidden" name="opcao" value="1">
            </form>
            <p>Ainda não é cliente? Cadastre <a href="formClienteCadastro.php">AQUI</a>!</p>
        </div>
    </div>

    <p>
        <?php
        if (isset($_REQUEST['erro'])) {
            if ((int)($_REQUEST['erro']) == "1")
                echo "<b><font face='Verdana' size='2' color='red'>Login Incorreto!</font></b>";
            else
            if ((int)($_REQUEST['erro']) == "2")
                echo "<b><font face='Verdana' size='2' color='blue'> Por favor, efetue seu login.</font></b>";
        }
        ?>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>