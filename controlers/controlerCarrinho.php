<?php
require_once '../classes/servico.inc.php';
require_once '../dao/servicoDAO.inc.php';
require_once '../classes/servicoCarrinho.inc.php';

$opcao = (int)$_REQUEST['opcao'];

if ($opcao == 1) { //incluir do carrinho
    $id = (int)$_REQUEST['id'];
    $data = $_REQUEST['pData'];
    $servicoDao = new ServicoDAO();
    $servico = $servicoDao->getServico($id);
    $servicoCarrinho = new servicoCarrinho($servico, $data);
    session_start();
    if (!isset($_SESSION['carrinho'])) {
        $carrinho = array();
    } else {
        $carrinho = $_SESSION['carrinho'];
        foreach ($carrinho as $itemCarrinho) {
            if ($servico->get_id_servico() == $itemCarrinho->get_id_servico()) {
                header('Location:../views/exibirCarrinho.php?erro=1');
            }
        }
    }
    $carrinho[] = $servicoCarrinho;
    sort($carrinho);
    $_SESSION['carrinho'] = $carrinho;
    header('Location:../views/exibirCarrinho.php'); //adiciona no carrinho
} else if ($opcao == 2) { //remover do carrinho
    $index = (int)$_REQUEST['index'];
    session_start();
    $carrinho = $_SESSION['carrinho'];
    unset($carrinho[$index]);
    sort($carrinho);
    $_SESSION['carrinho'] = $carrinho;
    header("Location:controlerCarrinho.php?opcao=3");
} else if ($opcao == 3) { //verifica se o carrinho existe
    session_start();
    if (!isset($_SESSION['carrinho']) || sizeof($_SESSION['carrinho']) == 0) {
        header("Location:../views/exibirCarrinho.php?status=1");
    } else {
        header("Location:../views/exibirCarrinho.php");
    }
} else if ($opcao == 4) {
    session_start();
    if (!isset($_SESSION['carrinho'])) {
        //erro de carrinho vazio
    } else {
        $total = $_REQUEST['total'];
        $_SESSION['total'] = $total;
        //header('Location:../controlers/controlerClienteLogin.php');
        header('Location:../views/formClienteLogin.php?erro=2');
    }
}
