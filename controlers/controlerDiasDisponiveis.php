<?php
require_once '../dao/diasDisponiveisDAO.inc.php';
$idServico = $_REQUEST['id'];
$opcao = $_REQUEST['opcao'];
if($opcao == 1){
    $dao = new DiasDisponiveisDAO();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['dias'] = $dao->getAllDiasDisponiveisParaServicoComId($idServico);
    header("Location:../views/escolhaDiasDisponiveis.php?id=$idServico");
}

?>