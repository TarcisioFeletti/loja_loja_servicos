<HTML>

<HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

        <meta charset="utf-8">
        <title>TLD Serviços</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

        <!-- Favicon -->
        <link href="../img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="../lib/animate/animate.min.css" rel="stylesheet">
        <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">


</HEAD>

<BODY>
        <div class="topo">
                <img src="imagens/banner_principal_capa.jpg">
        </div>

        <div class="barra">
                <nav>
                        <ul class="menu">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="../controlers/controlerCliente.php?opcao=4">Area do Cliente</a>
                                        <ul>
                                                <li><a href="../controlers/controlerCliente.php?opcao=4">Dados Cadastrais</a></li>
                                                <li><a href="../views/formClienteAtualizar.php">Alterar Dados Cadastrais</a></li>
                                        </ul>
                                </li>
                                <li><a href="../controlers/controlerServico.php?opcao=7&pagina=1">Vendas</a>
                                        <ul>
                                                <li><a href="../controlers/controlerServico.php?opcao=6">Relação de produtos</a></li>
                                                <li><a href="../controlers/controlerCarrinho.php?opcao=3">Ver carrinho</a></li>
                                                <li><a href="../controlers/controlerCarrinho.php?opcao=5">Esvaziar carrinho</a></li>
                                        </ul>
                                </li>
                                <li><a href="contato.php">Contato</a></li>
                                <?php
                                if (isset($_SESSION['logado']) && $_SESSION == true) {
                                        echo '<li><a href="../controlers/controlerLogin.php?opcao=2">Logout</a></li>';
                                } else {
                                        echo '<li><a href="formLogin.php">Login</a></li>';
                                }
                                ?>
                        </ul>
                </nav>
        </div>
        <p>&nbsp;