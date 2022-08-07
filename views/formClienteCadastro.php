<?php
require_once 'includes/autenticarMenu.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Cadastro do Cliente</h2>
    <p>
        <?php
        session_start();
        if (isset($_SESSION['cliente'])) {
            echo "<p>Você já está logado! Deseja <a href='../controlers/controlerClienteLogin.php?opcao=3'>sair</a>?";
        } else {
        ?>
    <form action="../controlers/controlerCliente.php" method="post" enctype="multipart/form-data>">
        Nome: <input type="text" size="50" name="pNome">
        <p>Endereço: <input type="text" size="100" name="pEndereco">
        <p>Telefone: <input type="text" size="12" name="pTelefone">
        <p>CPF: <input type=" text" size="12" name="pCpf">
        <p>Data de Nascimento: <input type="date" name="pData">
        <p>E-mail: <input type="text" size="20" name="pEmail">
        <p>Senha: <input type="text" size="12" name="pSenha">
        <p><input type="submit" value="Cadastrar"> <input type="reset" value="Cancelar">
            <input type="hidden" name='opcao' value='1'>
    </form>
    <p>Já é cliente? Acesse o sistema <a href="formClienteLogin.php">AQUI</a>!</p>
    <p>
    <?php
        }
    ?>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>