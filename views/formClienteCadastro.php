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
        if (isset($_SESSION['logado']) && $_SESSION['tipousuario'] == 2) {
            if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 2) {
                echo "<p>Você já está logado! Deseja <a href='../controlers/controlerLogin.php?opcao=2'>sair</a>?";
            }
        } else {
        ?>

    <div class="login-page">
        <div class="form">
            <form action="../controlers/controlerCliente.php" method="post" enctype="multipart/form-data>">
                Nome: <input type="text" size="50" name="pNome" value="" minlength="1" required maxlength="50">
                <p>Endereço: <input type="text" size="100" name="pEndereco" minlength="1" required maxlength="50">
                <p>Telefone: <input type="text" size="12" name="pTelefone" minlength="1" required maxlength="20">
                <p>Data de Nascimento: <input type="date" name="pData" required>
                <p>CPF: <input type="text" size="12" name="pCpf" minlength="1" required maxlength="13">
                <p>E-mail: <input type="email" size="20" name="pLogin" minlength="1" required maxlength="20">
                <p>Senha: <input type="password" size="12" name="pSenha" minlength="1" required maxlength="8">
                <p></p>

                <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
                    <?php
                    if (isset($_SESSION['logado'])) {
                        if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 1) {
                            echo "<input type='hidden' name='opcao' value='8'>";
                        }
                    } else {
                        echo "<input type='hidden' name='opcao' value='2'>";
                    }
                    ?>
            </form>
        </div>
    </div>




    <?php
            if (isset($_SESSION['logado'])) {
                if (!($_SESSION['logado'] == true && $_SESSION['tipousuario'] == 1)) {
                    echo '<p>Já é cliente? Acesse o sistema <a href="formClienteLogin.php">AQUI</a>!</p>';
                }
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