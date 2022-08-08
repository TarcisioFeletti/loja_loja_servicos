<?php
require_once '../dao/clienteDAO.inc.php';
require_once '../classes/cliente.inc.php';

$opcao = (int)$_REQUEST['opcao'];
$clienteDao = new ClienteDAO();

if ($opcao == 1) { //Login
    $email = $_REQUEST['pLogin'];
    $senha = $_REQUEST['pSenha'];
    $cliente = $clienteDao->autenticar($email, $senha);
    if ($cliente != NULL) {
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['tipousuario'] = '2';
        $_SESSION['cliente'] = $cliente;
        header('Location:../views/dadosCompra.php');
    } else {
        header('Location:../views/formClienteLogin.php?erro=1');
    }
} else if ($opcao == 2) { //Cadastro
    $email = strtolower($_REQUEST['pLogin']);
    $senha = strtolower($_REQUEST['pSenha']);
    $cliente = new Cliente();
    $cliente->setAll(
        $_REQUEST['pNome'],
        $_REQUEST['pEndereco'],
        $_REQUEST['pTelefone'],
        $_REQUEST['pCpf'],
        $_REQUEST['pData'],
        $email,
        $senha
    );
    $clienteDao->incluirCliente($cliente);
    header('Location:../views/formLogin.php');
} else if ($opcao == 3) { //Atualizar
    $email = strtolower($_REQUEST['pEmail']);
    $senha = strtolower($_REQUEST['pSenha']);
    $cliente = new Cliente();
    $cliente->setAll(
        $_REQUEST['pNome'],
        $_REQUEST['pEndereco'],
        $_REQUEST['pTelefone'],
        $_REQUEST['pCpf'],
        $_REQUEST['pData'],
        $email,
        $senha
    );
    $cliente->set_id_cliente($_REQUEST['pId']);
    $clienteDao = new ClienteDAO();
    $clienteDao->atualizarCliente($cliente);
    session_start();
    $_SESSION['cliente'] = $cliente;
    header('Location:controlerCliente.php?opcao=4');
} else if ($opcao == 4) { //Exibir
    session_start();
    if (isset($_SESSION['cliente'])) {
        header('Location:../views/exibirClienteDadosCadastral.php');
    } else {
        header('Location:../views/formLogin.php?erro=2');
    }
} else if ($opcao == 5) { //Excluir
    session_start();
    if (isset($_SESSION['cliente'])) {
        $clienteDao->excluirCliente($_SESSION['cliente']);
        header('Location:controlerCliente.php?opcao=6');
    } else {
        header('Location:../views/formClienteLogin.php?erro=2');
    }
} else if ($opcao == 6) { //Deslogar
    session_start();
    if (isset($_SESSION['logado'])) {
        unset($_SESSION['logado']);
        unset($_SESSION['tipousuario']);
        if (isset($_SESSION['cliente'])) {
            unset($_SESSION['cliente']);
        }
    }
    header('Location:../views/formLogin.php');
} else if ($opcao == 7) { //Redirecionamento
    session_start();
    if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == '2') {
        header('Location:../views/dadosCompra.php');
    } else {
        header('Location:../views/formClienteLogin.php?erro=2');
    }
}
