<?php
require_once 'includes/autenticarMenu.inc.php';
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Login do Sistema</h2>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="../controlers/controlerLogin.php" method="get">
                <input type="text" placeholder="Login" size="20" name="pLogin" />
                <input type="password" placeholder="Senha" size="10" name="pSenha" />
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

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<!-- Libraries Stylesheet -->
<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="../css/style.css" rel="stylesheet">

<?php
require_once 'includes/rodape.inc.php';
?>