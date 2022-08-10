<?php
require_once '../dao/tipoDAO.inc.php';
require_once '../classes/tipo.inc.php';

$opcao = (int)$_REQUEST['opcao'];
if ($opcao == 1) { //Incluir
    $novo = new Tipo();
    $novo->setAll(
        $_REQUEST['pNome'],
        $_REQUEST['pValor']
    );
    $tipoDao = new TipoDAO();
    $tipoDao->incluir($novo);
    header('Location:controlerTipo.php?opcao=2');
} else if ($opcao == 2 || $opcao == 6) { //Visualizar
    $tipoDao = new TipoDAO();
    session_start();
    $_SESSION['tipos'] = $tipoDao->getTipos();
    if ($opcao == 2) {
        header('Location:../views/exibirTipos.php');
    } else if ($opcao == 6) {
        header('Location:../views/formServico.php');
    }
} else if ($opcao == 3) { //Ir para view de Atualizar
    $id = (int)$_REQUEST['id'];
    $tipoDao = new TipoDAO();
    $tipo = $tipoDao->getTipo($id);
    session_start();
    $_SESSION['tipo'] = $tipo;
    header("Location:../views/formTipoAtualizar.php");
} else if ($opcao == 4) { //Atualizar
    $tipo = new Tipo();
    $tipo->setAll(
        $_REQUEST['pNome'],
        $_REQUEST['pValor']
    );
    $tipo->set_id_tipo($_REQUEST['pId']);
    $tipoDao = new TipoDAO();
    $tipoDao->atualizar($tipo);
    header('Location:controlerTipo.php?opcao=2');
} else if ($opcao == 5) { //Remover
    $id = (int)$_REQUEST['id'];
    $tipoDao = new TipoDAO();
    $tipoDao->excluir($id);
    header('Location:controlerTipo.php?opcao=2');
}
