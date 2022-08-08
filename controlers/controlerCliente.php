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
} else if ($opcao == 2 || $opcao == 8) { //Cadastro
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
    if ($opcao == 2) {
        header('Location:../views/formLogin.php');
    } else if ($opcao == 8) {
        header('Location:controlerCliente.php?opcao=9');
    }
} else if ($opcao == 3 || $opcao == 11) { //Atualizar
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
    if ($opcao == 3) {
        header('Location:controlerCliente.php?opcao=4');
    } else if ($opcao == 11) {
        header('Location:controlerCliente.php?opcao=9');
    }
} else if ($opcao == 4 || $opcao == 10) { //Exibir Um
    if ($opcao == 4) {
        session_start();
        if (isset($_SESSION['cliente'])) {
            header('Location:../views/exibirClienteDadosCadastral.php');
        } else {
            header('Location:../views/formLogin.php?erro=2');
        }
    } else if ($opcao == 10) {
        $id = $_REQUEST['id'];
        $clienteDao = new ClienteDAO();
        session_start();
        $_SESSION['cliente'] = $clienteDao->getCliente($id);
        header('Location:../views/formClienteAtualizar.php');
    }
} else if ($opcao == 5 || $opcao == 12) { //Excluir
    if ($opcao == 5) {
        session_start();
        if (isset($_SESSION['cliente'])) {
            $cliente = $_SESSION['cliente'];
            $clienteDao->excluirCliente($cliente->get_id_cliente());
            header('Location:../controlers/controlerLogin.php?opcao=2');
        } else {
            header('Location:../views/formLogin.php?erro=2');
        }
    } else if ($opcao == 12) {
        $id = $_REQUEST['id'];
        $clienteDao = new ClienteDAO();
        $clienteDao->excluirCliente($id);
        session_start();
        if (isset($_SESSION['cliente'])) {
            unset($_SESSION['cliente']);
        }
        header('Location:controlerCliente.php?opcao=9');
    }
} else if ($opcao == 7) { //Redirecionamento
    session_start();
    if ($_SESSION['logado'] == true && $_SESSION['tipousuario'] == '2') {
        header('Location:../views/dadosCompra.php');
    } else {
        header('Location:../views/formClienteLogin.php?erro=2');
    }
} else if ($opcao == 9) { //Visualizar Todos
    $clienteDao = new ClienteDAO();
    session_start();
    $_SESSION['clientes'] = $clienteDao->getClientes();
    header('Location:../views/exibirClientes.php');
}
