<?php
require_once 'includes/autenticarMenu.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Cadastro do Cliente</h2>
    <p>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 2) {
            echo "<p>Você já está logado! Deseja <a href='../controlers/controlerCliente.php?opcao=6'>sair</a>?";
        } else {
        ?>
    <form action="../controlers/controlerCliente.php" method="post" enctype="multipart/form-data>">
        Nome: <input type="text" size="50" name="pNome">
        <p>Endereço: <input type="text" size="50" name="pEndereco">
        <p>Telefone: <input type="text" size="20" name="pTelefone">
        <p>CPF: <input type=" text" size="13" name="pCpf">
        <p>Data de Nascimento: <input type="date" name="pData">
        <p>E-mail: <input type="text" size="20" name="pEmail">
        <p>Senha: <input type="password" size="8" name="pSenha">
        <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
            <?php
            if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 1) {
                echo "<input type='hidden' name='opcao' value='8'>";
            } else {
                echo "<input type='hidden' name='opcao' value='2'>";
            }
            ?>
    </form>
    <?php
            if (!($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 1)) {
                echo '<p>Já é cliente? Acesse o sistema <a href="formClienteLogin.php">AQUI</a>!</p>';
            }
    ?>
    <p>
    <?php
        }
    ?>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>