<?php
require_once '../classes/servico.inc.php';
require_once '../dao/servicoDAO.inc.php';
require_once '../dao/diasDisponiveisDAO.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../utils/dataUtil.inc.php';

$opcao = (int)$_REQUEST['opcao'];

if ($opcao == 1) { //incluir do carrinho
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = (int)$_REQUEST['id'];
    if (!isset($_REQUEST['pData'])) {
        header("Location:../views/escolhaDiasDisponiveis.php?id=$id&erro=1");
    } else if (isset($_SESSION['carrinho']) && sizeof($_SESSION['carrinho']) >= 5) {
        header('Location:../views/exibirCarrinho.php?erro=2');
    } else {
        $index = $_REQUEST['pData'];
        $datas = $_SESSION['dias'];
        $data = $datas[$index];
        $data->set_disponivel(0);
        $servicoDao = new ServicoDAO();
        $servico = $servicoDao->getServico($id);
        $servicoCarrinho = new ServicoCarrinho($servico, $data);
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
        header('Location:../views/exibirCarrinho.php');
    }
} else if ($opcao == 2) { //remover do carrinho
    $index = (int)$_REQUEST['id'];
    session_start();
    $carrinho = $_SESSION['carrinho'];
    $diasDao = new DiasDisponiveisDAO();
    unset($carrinho[$index]);
    if (sizeof($carrinho) == 0) {
        unset($carrinho);
    } else {
        sort($carrinho);
    }
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
        header("Location:../views/exibirCarrinho.php?status=1");
    } else {
        $total = $_REQUEST['total'];
        $_SESSION['total'] = $total;
        header('Location:../controlers/controlerCliente.php?opcao=7');
    }
} else if ($opcao == 5) { //Esvaziar Carrinho
    session_start();
    if (isset($_SESSION['carrinho'])) {
        unset($_SESSION['carrinho']);
    }
    header("Location:controlerCarrinho.php?opcao=3");
}
