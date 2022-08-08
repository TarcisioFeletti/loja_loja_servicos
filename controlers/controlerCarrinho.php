<?php
require_once '../classes/servico.inc.php';
require_once '../dao/servicoDAO.inc.php';
require_once '../dao/diasDisponiveisDAO.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../utils/dataUtil.inc.php';

$opcao = (int)$_REQUEST['opcao'];

if ($opcao == 1) { //incluir do carrinho
    $id = (int)$_REQUEST['id'];
    if (!isset($_REQUEST['pData'])) {
        header("Location:../views/escolhaDiasDisponiveis.php?id=$id&erro=1");
    } else {
        $index = $_REQUEST['pData'];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $datas = $_SESSION['dias'];
        $data = $datas[$index];
        $data->set_disponivel(0);
        $servicoDao = new ServicoDAO();
        $servico = $servicoDao->getServico($id);
        $servicoCarrinho = new ServicoCarrinho($servico, $data);
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
    }
} else if ($opcao == 2) { //remover do carrinho
    $index = (int)$_REQUEST['id'];
    session_start();
    $carrinho = $_SESSION['carrinho'];
    $diasDao = new DiasDisponiveisDAO();
    //$diasDao->setDisponivel(conversorData($carrinho[$index]->get_data()), $carrinho[$index]->get_id_servico());
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
        //erro de carrinho vazio
    } else {
        $total = $_REQUEST['total'];
        $_SESSION['total'] = $total;
        header('Location:../controlers/controlerClienteLogin.php?opcao=7');
    }
} else if ($opcao == 5) { //Esvaziar Carrinho
    session_start();
    if (isset($_SESSION['carrinho'])) {
        unset($_SESSION['carrinho']);
    }
    header("Location:controlerCarrinho.php?opcao=3");
}
