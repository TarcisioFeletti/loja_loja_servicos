<?php
require_once '../classes/venda.inc.php';
require_once '../dao/vendaDAO.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../classes/cliente.inc.php';

$opcao = $_REQUEST['opcao'];

if ($opcao == 1) {
    session_start();
    $cliente = $_SESSION['cliente'];
    $carrinho = $_SESSION['carrinho'];
    $total = $_SESSION['total'];
    $venda = new Venda($cliente->get_id_cliente(), $total);
    $vendaDao = new VendaDAO();
    $vendaDao->incluirVenda($venda, $carrinho);
    $tipo = $_REQUEST['pMetodo'];
    if ($tipo == 'boleto') {
        unset($_SESSION['carrinho']);
        header('Location:../views/boleto/meuBoleto.php');
    } else if ($tipo == 'cartao') {
        unset($_SESSION['carrinho']);
        header('Location:../views/meuCartao.php');
    }
}
